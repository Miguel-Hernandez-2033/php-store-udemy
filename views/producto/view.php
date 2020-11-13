<?php if (isset($prod)) : ?>
    <h1><?= $prod->nombre ?></h1>
    <div id="detail-product">
        <div class="image">
            <img src="<?= base_url ?>uploads/images/<?= $prod->imagen ?>" alt="">
        </div>
        <div class="data">
            <p class="description"><?= $prod->descripcion ?></p>
            <p class="price"><?= $prod->precio ?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else : ?>
    <h1>No existe tal producto</h1>
<?php endif; ?>