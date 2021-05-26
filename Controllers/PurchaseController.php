<?php

    namespace Controllers;

    
    include('vendor/autoload.php'); //Llamare el autoload de la clase que genera el QR
    use Endroid\QrCode\QrCode;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    use DAO\TheaterDAO as TheaterDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\ProjectionDAO as ProjectionDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use DAO\TicketDAO as TicketDAO;

    use API\MovieAPI as MovieAPI;

    use Models\Theater as Theater;
    use Models\Room as Room;
    use Models\Projection as Projection;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;

    class PurchaseController
    {
        private $theaterDAO;
        private $roomDAO;
        private $projectionDAO;
        private $movieAPI;
        private $purchaseDAO;
        private $ticketDAO;

        public function __construct() {
            $this->theaterDAO = new TheaterDAO();
            $this->roomDAO = new RoomDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->movieAPI = new MovieAPI();
            $this->purchaseDAO = new PurchaseDAO();
            $this->ticketDAO = new TicketDAO();


        }

        public function buyTickets($projectionId) 
        {
            $_SESSION["projection_id"] = $projectionId;
            
            $projection = $this->projectionDAO->getProjection($projectionId);
            
            $movie = $this->movieAPI->getById($projection->getMovie());
            
            $room = $this->roomDAO->getRoom($projection->getRoom());
            
            $theater = $this->theaterDAO->getTheater($room->getTheaterId());

            if($projection->getAvailableSeats() > 0) 
            {
                if($_SESSION["logged_user"]) 
                {
                    if($_SESSION["logged_user"]->getRole() == 1)
                    {
                        require_once(ADMIN_VIEWS . "comprarEntradas.php");
                    }
                    else
                    {
                        require_once(CLIENT_VIEWS . "comprarEntradas.php");
                    }
                }
                else
                {
                    require_once(VIEWS_PATH."login.php");
                }
            }
            else
            {
                echo '<script language="javascript">alert("No hay entradas disponibles para esta función.");</script>';
                
                $date = getdate();
                $newDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];

                $projectionList = $this->projectionDAO->getFromDateAndMovie($newDate, $movie->getId());

                $trailer = $this->movieAPI->getTrailer($movie->getId());
                
                if($_SESSION["logged_user"]) 
                {
                    if($_SESSION["logged_user"]->getRole() == 1)
                    {
                        require_once(ADMIN_VIEWS . "detallesPelicula.php");
                    }
                    else
                    {
                        require_once(CLIENT_VIEWS . "detallesPelicula.php");
                    }
                }
                else
                {
                    require_once(VIEWS_PATH."detallesPelicula.php");
                }
            }
        }

        public function confirmPurchase($tickets)
        {
            $projection = $this->projectionDAO->getProjection($_SESSION["projection_id"]);
            
            $movie = $this->movieAPI->getById($projection->getMovie());
            
            $room = $this->roomDAO->getRoom($projection->getRoom());
            
            $theater = $this->theaterDAO->getTheater($room->getTheaterId());

            $total = $tickets * $room->getTicketValue();

            $_SESSION["tickets"] = $tickets;
            $_SESSION["total"] = $total;

            if($_SESSION["logged_user"]) 
            {
                if($_SESSION["logged_user"]->getRole() == 1)
                {
                    require_once(ADMIN_VIEWS . "confirmarCompra.php");
                }
                else
                {
                   require_once(CLIENT_VIEWS . "confirmarCompra.php");
                }
            }
            else
            {
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function completePurchase() 
        {
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $date = date("Y-m-d", time());

            $newPurchase = new Purchase();
            $newPurchase->setTickets($_SESSION["tickets"]);
            $newPurchase->setTotal($_SESSION["total"]);
            $newPurchase->setDate($date);
            $newPurchase->setUser($_SESSION["logged_user"]->getId());
            $newPurchase->setProjection($_SESSION["projection_id"]);

            $this->purchaseDAO->add($newPurchase);

            $lastPurchase = $this->purchaseDAO->getLastId();
            $purchase_id = $lastPurchase[0]["purchase_id"];

            $this->updateSeats($_SESSION["projection_id"], $_SESSION["tickets"]);

            $qrList = array();

            for($i=0; $i<$_SESSION["tickets"]; $i++) {
                $ticket = new Ticket($purchase_id);
                $this->ticketDAO->add($ticket);
            }

            $qrList = $this->generateQr($purchase_id);

            $this->sendMail($qrList);

            $this->inicio();
        }

        public function updateSeats($projectionId, $seats)  {
            $projection = $this->projectionDAO->getProjection($projectionId);

            $projection->setAvailableSeats($projection->getAvailableSeats() - $seats);
            $projection->setSoldSeats($projection->getSoldSeats() + $seats);

            $this->projectionDAO->modify($projection->getId(), $projection);
        }

        public function generateQr($purchase_id) {

            $qrList = array();

            $tickets = $this->ticketDAO->getByPurchase($purchase_id);

            if($tickets) {
                foreach($tickets as $ticket) {
                    $qr = new QrCode($ticket->getId(), $ticket->getPurchase());

                    $path = ROOT . 'qr_codes/qrcode' . $ticket->getId() . '.png';
                    
                    $qr->writeFile($path);

                    array_push($qrList, $path);
                }
            }

            return $qrList;
    
        }

        public function sendMail($qrList) {
            $mail = new PHPMailer(true);

            $user = $_SESSION["logged_user"];

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = EMAIL_USERNAME;                     // SMTP username
                $mail->Password   = EMAIL_PASSWORD;                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom(EMAIL_USERNAME, 'MoviePass');
                $mail->addAddress($user->getEmail(), $user->getName());     // Add a recipient

                // Attachments
                foreach($qrList as $qr) {
                    $mail->addAttachment($qr);
                }

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Entradas de cine';
                $mail->Body    = 'Estas son tus entradas.';

                $mail->send();

                echo '<script language="javascript">alert("Los Codigos de las entradas fueron enviadas al mail.");</script>'; 

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        public function inicio()
        {
            $movieList = $this->getMovies();

            if($_SESSION["logged_user"])
            {
                if($_SESSION["logged_user"]->getRole() == 1)
                {
                    require_once(ADMIN_VIEWS . "viewAdmin.php");
                }
                else
                {
                    require_once(CLIENT_VIEWS . "viewClient.php");
                }
            }
            else
            {
                require_once(VIEWS_PATH."index.php");
            }  
        }  

        public function getMovies() {
            $date = getdate();
            $newDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];
            
            $projections = $this->projectionDAO->getFrom($newDate);

            if($projections) {

                $movieIds = array();
                foreach($projections as $projection) {
                    array_push($movieIds, $projection->getMovie());
                }

                $movieList = $this->movieAPI->getMovies(array_unique($movieIds));
                
                if($movieList) {
                    return $movieList;
                }
                else {
                    return null;
                }
            }
            else {
                return null;
            }
        }

    }

?>