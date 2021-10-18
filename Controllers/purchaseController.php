<?php

    namespace Controllers;
 
    include('vendor/autoload.php');
    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
    use Endroid\QrCode\Writer\PngWriter;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    use DAO\TheaterDAO as TheaterDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\ProjectionDAO as ProjectionDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use DAO\TicketDAO as TicketDAO;
    use DAO\MovieDAO as MovieDAO;

    use Models\Theater as Theater;
    use Models\Room as Room;
    use Models\Projection as Projection;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use Models\Movie as Movie;

    class PurchaseController
    {
        private $theaterDAO;
        private $roomDAO;
        private $purchaseDAO;
        private $ticketDAO;
        private $projectionDAO;
        private $movieDAO;

        public function __construct() {
            $this->theaterDAO = new TheaterDAO();
            $this->roomDAO = new RoomDAO();
            $this->purchaseDAO = new PurchaseDAO();
            $this->ticketDAO = new TicketDAO();
            $this->projectionDAO = new ProjectionDAO();
            $this->movieDAO = new MovieDAO();


        }

        public function selectTickets($projectionId) 
        {
            $_SESSION["projectionId"] = $projectionId;
            
            $projection = $this->projectionDAO->getProjection($projectionId);

            if($projection->getAvailableSeats() > 0) 
            {
                if(isset($_SESSION["loggedUser"])) 
                {
                    require_once(VIEWS_PATH . "selectTickets.php");
                }
                else
                {
                    require_once(VIEWS_PATH."login.php");
                }
            }
            else
            {
                echo '<script language="javascript">alert("No hay entradas disponibles para esta función.");</script>';
                
                $this->Index();
            }
        }

        public function buyTickets($tickets) 
        {
            $projectionId = $_SESSION["projectionId"];
            
            $projection = $this->projectionDAO->getProjection($projectionId);
            $movie = $this->movieDAO->getMovie($projection->getMovieId());
            $room = $this->roomDAO->getRoom($projection->getRoomId());
            $theater = $this->theaterDAO->getTheater($room->getTheaterId());

            $total = $tickets * $room->getTicketValue();

            $purchase = new Purchase();
            $purchase->setTicketAmount($tickets);
            $purchase->setTotal($total);
            $purchase->setDate(date("Y-m-d", time()));
            $purchase->setUserId($_SESSION["loggedUser"]->getId());
            $purchase->setProjectionId($projectionId);

            $_SESSION["purchase"] = $purchase;

            if($projection->getAvailableSeats() > 0) 
            {
                if(isset($_SESSION["loggedUser"])) 
                {
                    require_once(VIEWS_PATH . "buyTickets.php");
                }
                else
                {
                    require_once(VIEWS_PATH."login.php");
                }
            }
            else
            {
                echo '<script language="javascript">alert("No hay entradas disponibles para esta función.");</script>';
                
                $this->Index();
            }
        }

        public function completePurchase($token, $issuer_id, $installments, $payment_method_id) 
        {
            $purchase = $_SESSION["purchase"];

            $purchaseId = $this->purchaseDAO->add($purchase);

            $purchase = $this->purchaseDAO->getPurchase($purchaseId);

            $this->updateSeats($purchase);

            $qrList = array();

            for($i=0; $i<$purchase->getTicketAmount(); $i++) {
                $ticket = new Ticket();
                $ticket->setPurchaseId($purchase->getId());
                $ticketId = $this->ticketDAO->add($ticket);

                $ticket = $this->ticketDAO->getTicket($ticketId);

                $writer = new PngWriter();

                // Create QR code
                $qrCode = QrCode::create($ticket->getId())
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->setSize(300)
                    ->setMargin(10)
                    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->setForegroundColor(new Color(0, 0, 0))
                    ->setBackgroundColor(new Color(255, 255, 255));

                $result = $writer->write($qrCode);

                $path = "./QRCodes/qr_" . $ticket->getId() . ".jpg";

                $file = fopen($path, "w");

                fwrite($file, $result->getString());

                array_push($qrList, $path);
            }

            $this->sendMail($qrList);

            $this->Index();
        }

        public function updateSeats(Purchase $purchase)  {
            $projection = $this->projectionDAO->getProjection($purchase->getProjectionId());

            $projection->setAvailableSeats($projection->getAvailableSeats() - $purchase->getTicketAmount());
            $projection->setSoldSeats($projection->getSoldSeats() + $purchase->getTicketAmount());

            $this->projectionDAO->modify($projection);
        }

        public function sendMail($qrList) {
            $mail = new PHPMailer(true);

            $user = $_SESSION["loggedUser"];

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
                echo '<script language="javascript">alert("Error. Las entradas no se enviaron correctamente.");</script>'; 
            }
        }

        //INDEX FUNCTIONS

        public function Index($message = "")
        {         
            $movieList = $this->getMovies();
            $principalMovie = null;

            if($movieList)
            {
                $principalMovie = $movieList[count($movieList)-1];

                $this->updateImg($principalMovie->getBackdropPath());
            }

            require_once(VIEWS_PATH."index.php");
        }

        private function getMovies()
        {
            $date = getdate();
            $todayDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];

            $projections = $this->projectionDAO->getAll();

            $movies = null;

            if($projections)
            {
                $movies = array();
                foreach($projections as $projection) 
                {
                    if($projection->getDate() >= $todayDate)
                    {
                        $movie = $this->movieDAO->getMovie($projection->getMovieId());

                        array_push($movies, $movie);
                    }
                }

                array_unique($movies, SORT_REGULAR);
            }

            return $movies;
        }

        private function updateImg($image)
        {
            $fp=fopen("./Views/img/backdrop.jpg", "w");
            
            $ch=curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $image);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            
            curl_exec($ch);

            curl_close($ch);
            
            fclose($fp);
        }

    }
