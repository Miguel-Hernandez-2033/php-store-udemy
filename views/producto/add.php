<?php if(isset($edit) && isset($prod) && is_object($prod)):?>
    <h1>Editar producto <?=$prod->nombre?></h1>
    <?php $url_action = base_url."producto/save&id=".$prod->id; ?>
<?php else:?>
    <h1>Crear producto</h1>
    <?php $url_action = base_url."producto/save"; ?>
<?php endif;?>
<div class="form_container">

    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= isset($prod) && is_object($prod) ? $prod->nombre : ''?>">

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="" cols="30" rows="3" style="resize: none;"><?= isset($prod) && is_object($prod) ? $prod->descripcion : ''?>
        </textarea>

        <label for="categoria">Categoria</label>
        <?php $categorias = utilities::showCategorias(); ?>
        <select name="categoria" id="">
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <option value="<?= $cat->id ?>" <?= isset($prod) && is_object($prod) && $cat->id == $prod->categoria_id ? 'selected' : '' ?>>
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">Imagen</label>
        <?php if(isset($prod) && is_object($prod) && !empty($prod->imagen)):?>
            <img src="<?= base_url ?>uploads/images/<?=$prod->imagen?>" class="thumb" alt="">
        <?php endif; ?>
        <input type="file" name="imagen">

        <label for="precio">Precio</label>
        <input type="number" name="precio" value="<?= isset($prod) && is_object($prod) ? $prod->precio : ''?>">

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?= isset($prod) && is_object($prod) ? $prod->stock : ''?>">

        <!--<label for="oferta">Oferta</label>
        <input type="number" name="oferta" value="<?= isset($prod) && is_object($prod) ? $prod->oferta : ''?>">-->

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" value="<?= isset($prod) && is_object($prod) ? $prod->fecha : ''?>">

        <input type="submit" value="Crear producto">
    </form>
</div>