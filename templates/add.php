<main>
    <?php if (count($categories)): ?>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($categories as $category): ?>
            <li class="nav__item">
                <a href="../pages/all-lots.html">
                    <?= strip_tags($category['name']); ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php endif; ?>

    <form class="form form--add-lot container form--invalid" action="" method="post" enctype="multipart/form-data">
        <!-- form--invalid -->
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : ""; ?>
            <div class="form__item <?=$classname;?>">
                <!-- form__item--invalid -->
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=getPostVal("lot-name");?>">
                <span class="form__error"><?= $errors['lot-name'] ?? ""; ?></span>
            </div>
            <?php $classname = isset($errors['category']) ? "form__item--invalid" : ""; ?>
            <div class="form__item <?=$classname;?>">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="category">
                    <option value="-1">Выберите категорию</option>
                    <?php if (count($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= strip_tags($category['id']); ?>" <?php if($category['id']==getPostVal("category")) print 'selected' ; ?>>
                        <?= strip_tags($category['name']); ?>
                    </option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <span class="form__error"><?= $errors['category'] ?? ""; ?></span>
            </div>
        </div>
        <?php $classname = isset($errors['message']) ? "form__item--invalid" : ""; ?>
        <div class="form__item form__item--wide <?=$classname;?>">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="message" placeholder="Напишите описание лота"><?=getPostVal("message");?></textarea>
            <span class="form__error"><?= $errors['message'] ?? ""; ?></span>
        </div>
        <?php $classname = isset($errors['lot-img']) ? "form__item--invalid" : ""; ?>
        <div class="form__item form__item--file <?=$classname;?>">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="lot-img" name="lot-img">
                <label for="lot-img">
                    Добавить
                </label>
                <span class="form__error"><?= $errors['lot-img'] ?? ""; ?></span>
            </div>
        </div>
        <div class="form__container-three ">
           <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : ""; ?>
            <div class="form__item form__item--small <?=$classname;?>">
                <label for="lot-rate">Начальная цена <sup>*</sup></label>
                <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?=getPostVal("lot-rate");?>">
                <span class="form__error"><?= $errors['message'] ?? ""; ?></span>
            </div>
            <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : ""; ?>
            <div class="form__item form__item--small <?=$classname;?>">
                <label for="lot-step">Шаг ставки <sup>*</sup></label>
                <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?=getPostVal("lot-step");?>">
                <span class="form__error"><?= $errors['message'] ?? ""; ?></span>
            </div>
            <?php $classname = isset($errors['lot-date']) ? "form__item--invalid" : ""; ?>
            <div class="form__item <?=$classname;?>">
                <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="lot-date" type="text" name="lot-date" value="<?=getPostVal("lot-date");?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД" >
                <span class="form__error"><?= $errors['message'] ?? "";?></span>
            </div>
        </div>
        <?php if(count($errors)): ?>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <?php endif; ?>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>
