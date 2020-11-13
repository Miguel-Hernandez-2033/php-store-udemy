<h1>Algunos de nuestros productos</h1>

<?php while ($prod = $productos->fetch_object()) : ?>
    <div class="product">
        <a href="<?=base_url?>producto/view&id=<?=$prod->id?>">
            <img src="<?= base_url ?>uploads/images/<?= $prod->imagen ?>" alt="">
            <h2><?= $prod->nombre ?></h2>
        </a>
        <p><?= $prod->precio ?></p>
        <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>" class="button">Comprar</a>
    </div>
<?php endwhile; ?>