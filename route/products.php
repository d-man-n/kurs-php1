<?php

if (!in_array("Администраторы", isAdmin($_SESSION['id_user']))) {
  header("Location: /noauth/");
}


if (isset($_POST['add-product'])) {
  addProduct($_POST);
} else {
  $products = getProducts();
}

if (isset($_GET['id1']) && $_GET['id1'] == 'add'): 

  if (isset($_GET['id2']) && $_GET['id2'] > 0) {
    $product = getProductById($_GET['id2']);
    $catalog = getCatalogByProductId($_GET['id2']);
  }

?>

  <main class="page-add">
    <h1 class="h h--1"><?=isset($product) ? "Правка товара" : "Добавление товара"?></h1>
    <form class="custom-form" id="addForm" method="post" enctype="multipart/form-data">
      <?php if (isset($product)): ?>
        <input type="hidden" name="product-id" id="product-id" value="<?=$_GET['id2']?>">
      <?php endif; ?>
      <fieldset class="page-add__group custom-form__group">
        <legend class="page-add__small-title custom-form__title">Данные о товаре</legend>
        <label for="product-name" class="custom-form__input-wrapper page-add__first-wrapper">
          <input type="text" class="custom-form__input" name="product-name" id="product-name" placeholder="Название товара" value="<?=isset($product) ? $product['name_product'] : ""?>">
        </label>
        <label for="product-price" class="custom-form__input-wrapper">
          <input type="number" class="custom-form__input" name="product-price" id="product-price" step="0.01" placeholder="Цена товара" value="<?=isset($product) ? $product['price'] : ""?>">
        </label>
      </fieldset>
      <fieldset class="page-add__group custom-form__group">
        <legend class="page-add__small-title custom-form__title">Фотография товара</legend>
        <ul class="add-list">
          <li class="add-list__item add-list__item--add" <?=isset($product) && $product['image'] != "" ? "hidden" : ""?>>
            <input type="file" name="product-photo" id="product-photo" hidden="">
            <label for="product-photo">Добавить фотографию</label>
          </li>
          <?php if (isset($product) && $product['image'] != ""): ?> 
            <li class="add-list__item add-list__item--active"><img src="<?=insert_base64_encoded_image_src($product['image'])?>"></li>
          <?php endif; ?>
        </ul>
      </fieldset>
      <fieldset class="page-add__group custom-form__group">
        <legend class="page-add__small-title custom-form__title">Раздел</legend>
        <div class="page-add__select">
          <select name="catalog[]" class="custom-form__select" multiple="multiple">
            <option hidden="">Название раздела</option>
            <option value="2" <?=!isset($catalog) || (isset($catalog) && in_array(2, $catalog)) ? "selected" : ""?>>Женщины</option>
            <option value="3" <?=isset($catalog) && in_array(3, $catalog) ? "selected" : ""?>>Мужчины</option>
            <option value="4" <?=isset($catalog) && in_array(4, $catalog) ? "selected" : ""?>>Дети</option>
            <option value="5" <?=isset($catalog) && in_array(5, $catalog) ? "selected" : ""?>>Аксессуары</option>
          </select>
        </div>
        <input type="checkbox" name="new" id="new" class="custom-form__checkbox" <?=isset($product) && $product['new'] == 1 ? "checked" : ""?>>
        <label for="new" class="custom-form__checkbox-label">Новинка</label>
        <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox" <?=isset($product) && $product['sale'] == 1 ? "checked" : ""?>>
        <label for="sale" class="custom-form__checkbox-label">Распродажа</label>
      </fieldset>
      <button class="button" type="submit" name="add-product"><?=isset($product) ? "Сохранить товар" : "Добавить товар"?></button>
    </form>
    <section class="shop-page__popup-end page-add__popup-end" hidden="">
      <div class="shop-page__wrapper shop-page__wrapper--popup-end">
        <h2 class="h h--1 h--icon shop-page__end-title"><?=isset($product) ? "Товар успешно сохранен" : "Товар успешно добавлен"?></h2>
      </div>
    </section>
  </main>

  <?php if (isset($product) && $product['image'] != ""): ?>
    <script>
      const imgContainer = document.querySelector('.add-list__item--active');
      const addList1 = document.querySelector('.add-list');
      const addButton = addList1.querySelector('.add-list__item--add');
      // const addInput = addList1.querySelector('#product-photo');

      imgContainer.addEventListener('click', evt => {
        addList1.removeChild(evt.target);
        // addInput.value = '';
        checkList(addList1, addButton);
      });
    </script>
  <?php endif; ?>

<?php else: ?>
  <main class="page-products">
    <h1 class="h h--1">Товары</h1>
    <a class="page-products__button button" href="/products/add/">Добавить товар</a>
    <div class="page-products__header">
      <span class="page-products__header-field">Название товара</span>
      <span class="page-products__header-field">ID</span>
      <span class="page-products__header-field">Цена</span>
      <span class="page-products__header-field">Категория</span>
      <span class="page-products__header-field">Новинка</span>
    </div>
    <ul class="page-products__list">

      <?php foreach($products as $product): ?>

        <li class="product-item page-products__item" id="<?=$product['id']?>">
          <b class="product-item__name"><?=$product['name']?></b>
          <span class="product-item__field"><?=$product['id']?></span>
          <span class="product-item__field"><?=number_format($product['price'], 0, '.', ' ')?> руб.</span>
          <span class="product-item__field"><?=implode(',<br>', $product['catalog'])?></span>
          <span class="product-item__field"><?=$product['new'] == 1 ? "Да" : "Нет"?></span>
          <a href="/products/add/<?=$product['id']?>/" class="product-item__edit" aria-label="Редактировать"></a>
          <button class="product-item__delete"></button>
        </li>

      <?php endforeach; ?>

    </ul>
  </main>
<?php endif; ?>