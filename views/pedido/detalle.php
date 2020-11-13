<h1>Datos del pedido</h1>
<?php if (isset($ped)) : ?>

    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?= base_url ?>pedido/estado" method="POST">
            <input type="hidden" name="pedido_id" value="<?=$ped->id?>">
            <select name="estado" id="">
                <option value="confirmed" <?= $ped->estado == "confirmed" ? 'Selected' : "" ?>>Pendiente</option>
                <option value="preparation" <?= $ped->estado == "preparation" ? 'Selected' : "" ?>>En preparacion</option>
                <option value="ready" <?= $ped->estado == "ready" ? 'Selected' : "" ?>>Preparado para enviar</option>
                <option value="sended" <?= $ped->estado == "sended" ? 'Selected' : "" ?>>Enviado</option>
            </select>
            <input type="submit" value="Actualizar">
        </form>
        <br>
    <?php endif; ?>

    <h3>Datos de envio</h3>
    Provincia: <?= $ped->provincia ?>
    <br>
    Localidad: <?= $ped->localidad ?>
    <br>
    Direccion: <?= $ped->direccion ?>
    <br>
    <br>
    <h3>Datos del pedido</h3>
    Estado del pedido: <?= utilities::showStatus($ped->estado) ?>
    <br>
    Numero del pedido: <?= $ped->id ?>
    <br>
    Total a pagar: <?= $ped->coste ?>
    <br>
    Productos:


    <table>
        <th>ID</th>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Unidades</th>
        <?php while ($producto = $productos->fetch_object()) : ?>
            <tr>
                <td><?= $producto->id ?></td>
                <td><img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="" class="thumb"></td>
                <td><?= $producto->nombre ?></td>
                <td><?= $producto->descripcion ?></td>
                <td><?= $producto->precio ?></td>
                <td>x<?= $producto->unidades ?></td>
            </tr>
        <?php endwhile; ?>

    </table>

    <br>
<?php endif; ?>