<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'Complete') : ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices la transferencia
        bancaria a la cuenta 468461911911 con el coste del pedido sera procesado y enviado.
    </p>
    <br>
    <?php if (isset($ped)) : ?>
        <h3>Datos del pedido</h3>
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

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'Complete') : ?>
    <h1>Tu pedido no ha podido procesarse</h1>
<?php endif; ?>