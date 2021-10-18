<?php require_once(VIEWS_PATH."nav.php"); ?>

<main style="height:85vh; background-color: #FFF; padding-top: 5vh;">
    <div class="contenedor">
        <h1 style="text-align: center;">CINES</h1>
        <table class="lista">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Hora de Apertura</th>
                    <th>Hora de Cierre</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($theaterList) {
                    foreach($theaterList as $theater) {
                ?>
                <tr class="active-row">
                    <td><?php echo $theater->getId() ?></td>
                    <td><?php echo $theater->getName() ?></td>
                    <td><?php echo $theater->getAddress() ?></td>
                    <td><?php echo $theater->getOpeningTime() ?></td>
                    <td><?php echo $theater->getClosingTime() ?></td>
                    <td>
                        <form action="<?php echo FRONT_ROOT ?>Theater/modifyView" method="post">
                            <input type="hidden" name="id" value="<?php echo $theater->getId() ?>">
                            <button class="btn modify" type="submit">Modificar</button>
                        </form>          
                    </td>
                    <td>
                        <form action="<?php echo FRONT_ROOT ?>Theater/remove" method="post">
                            <input type="hidden" name="id" value="<?php echo $theater->getId() ?>">
                            <button class="btn remove" type="submit">Eliminar</button>
                        </form>          
                    </td>
                </tr>
                <?php } }?>                        
        </tbody>
    </table>
    </div> 
</main>
