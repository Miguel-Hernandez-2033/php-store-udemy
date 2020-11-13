<?php if (isset($_SESSION['identity'])) : ?>
    <h1>Hacer pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ver carrito</a>
    </p>
    <br>
    <h3>Direccion para la entrega del pedido</h3>
    <form action="<?= base_url ?>pedido/add" method="POST">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" required>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Confirmar pedido">
    </form>
<?php else : ?>
    <h1>Es necesario estar logeado</h1>
    <p>Necesitar estar registrado he iniciar sesion</p>
<?php endif; ?>