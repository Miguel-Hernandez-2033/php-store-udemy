<h1>Gestionar productos</h1>

<a href="<?=base_url?>producto/add" class="button button-small">Crear producto</a>
<!--Sessions estado de la creacion del producto-->
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'Complete'): ?>
    <strong class="alert_green">El producto a sido ingresado correctamente</strong><br>
<?php elseif(isset($_SESSION['producto']) == 'Failed'): ?>
    <strong class="alert_error">Se ha producido un error al ingresar el producto</strong><br>
<?php endif; ?>
<?php utilities::deleteSessions('producto'); ?>
<!--Sessions estado al eliminar un producto-->
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'Complete'): ?>
    <strong class="alert_green">El producto a sido eliminado correctamente</strong><br>
<?php elseif(isset($_SESSION['delete']) == 'Failed'): ?>
    <strong class="alert_error">Se ha producido un error al eliminar el producto</strong><br>
<?php endif; ?>
<?php utilities::deleteSessions('delete'); ?>

<table>
    <th>ID</th>
    <th>Imagen</th>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Fecha</th>
    <th>Acciones</th>
    <?php while($prod = $productos->fetch_object()):?>
        <tr>
            <td><?=$prod->id?></td>
            <td><img src="<?=base_url?>uploads/images/<?=$prod->imagen?>" alt="" class="thumb"></td>
            <td><?=$prod->nombre?></td>
            <td><?=$prod->descripcion?></td>
            <td><?=$prod->precio?></td>
            <td><?=$prod->stock?></td>
            <td><?=$prod->fecha?></td>
            <td>
                <a href="<?=base_url?>producto/edit&id=<?=$prod->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/delete&id=<?=$prod->id?>" class="button button-gestion button-red" >Eliminar</a>
            </td>
        </tr>
    <?php endwhile;?>

</table>
