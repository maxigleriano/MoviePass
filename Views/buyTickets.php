<?php require_once(VIEWS_PATH . "nav.php") ?>

<main>
    <div class="form-box">
        <h2>Comprar Entradas</h2>
        <form action="<?php echo FRONT_ROOT ?>Purchase/completePurchase" method="post">

            <label for="theater">Cine</label>
            <p><?php echo $theater->getName() ?></p>
        
            <label for="room">Sala</label>
            <p><?php echo $room->getName() ?></p>

            <label for="movie">Película</label>
            <p><?php echo $movie->getTitle() ?></p>

            <label for="date">Fecha</label>
            <p><?php echo date("d/m/Y", strtotime($projection->getDate())) ?></p>

            <label for="time">Horario de Inicio</label>
            <p><?php echo $projection->getBeginningTime() ?></p>

            <label for="value">Valor de la Entrada</label>
            <p>$<?php echo $room->getTicketValue() ?></p>

            <label for="tickets">Numero de Entradas</label>
            <p><?php echo $tickets ?></p>

            <label for="total">Total</label>
            <p>$<?php echo $total ?></p>

            <div style="margin-bottom: 30px;"></div>

            <script
                src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
                data-public-key="<?php echo ACCESS_TOKEN ?>"
                data-transaction-amount="<?php echo $total ?>"
                data-button-label="Pagar"
            >
			</script>
        </form>
    </div> 
</main>
