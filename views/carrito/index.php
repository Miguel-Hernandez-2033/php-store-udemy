<h1>Carrito de la compra</h1>
<?php if (isset($_SESSION['carrito']) && isset($_SESSION['carrito']) >= 1) : ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php
        foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>
            <tr>
                <td><img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" alt=""></td>
                <td><a href="<?= base_url ?>producto/view&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>
                <td><?= $producto->precio ?></td>
                <td>
                    <?= $elemento['unidades'] ?>
                    <div class="updown-unidades">
                        <a class="button" href="<?= base_url ?>carrito/down&index=<?= $indice ?>">-</a>
                        <a class="button" href="<?= base_url ?>carrito/up&index=<?= $indice ?>">+</a>
                    </div>
                </td>
                <td><a class="button button-carrito button-red" href="<?= base_url ?>carrito/remove&index=<?= $indice ?>">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <div class="delete-carrito">
        <a class="button button-delete button-red" href="<?= base_url ?>carrito/deleteAll">Vaciar carrito</a>
    </div>

    <div class="total-carrito">
        <?php $stats = utilities::statsCarrito(); ?>
        <h3>Total: <?= $stats['total'] ?></h3>
        <a class="button button-pedido" href="<?= base_url ?>pedido/index">Hacer pedido</a>
    </div>
<?php else : ?>
    <h3>No existe ninguna producto en el carrito</h3>
<?php endif; ?>