<?php if (isset($cat)) : ?>
    <h1>Categoria <?= $cat->nombre ?></h1>
    <?php if ($productos->num_rows != 0) : ?>
        <?php while ($prod = $productos->fetch_object()) : ?>
            <div class="product">
                <a href="<?= base_url ?>producto/view&id=<?= $prod->id ?>">
                    <img src="<?= base_url ?>uploads/images/<?= $prod->imagen ?>" alt="">
                    <h2><?= $prod->nombre ?></h2>
                </a>
                <p><?= $prod->precio ?></p>
                <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No existen productos en esta categoria</p>
    <?php endif; ?>
<?php else : ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>