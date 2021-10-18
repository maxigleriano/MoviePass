<?php require_once(VIEWS_PATH."nav.php"); ?>

<main style="height:85vh; background-color: #FFF; padding-top: 5vh;">
    <div class="contenedor">
        <h1 style="text-align: center;">SALAS</h1>
        <table class="lista">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cine</th>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Precio</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($roomList) {
                    foreach($roomList as $room) {
                ?>
                <tr class="active-row">
                    <td><?php echo $room->getId() ?></td>
                    <td><?php echo $this->theaterDAO->getTheater($room->getTheaterId())->getName()  ?></td>
                    <td><?php echo $room->getName() ?></td>
                    <td><?php echo $room->getCapacity() ?></td>
                    <td><?php echo $room->getTicketValue() ?></td>
                    <td>
                        <form action="<?php echo FRONT_ROOT ?>Room/modifyView" method="post">
                            <input type="hidden" name="id" value="<?php echo $room->getId() ?>">
                            <button class="btn modify" type="submit">Modificar</button>
                        </form>          
                    </td>
                    <td>
                        <form action="<?php echo FRONT_ROOT ?>Room/remove" method="post">
                            <input type="hidden" name="id" value="<?php echo $room->getId() ?>">
                            <button class="btn remove" type="submit">Eliminar</button>
                        </form>          
                    </td>
                </tr>
                <?php } }?>                        
        </tbody>
    </table>
    </div> 
</main>
