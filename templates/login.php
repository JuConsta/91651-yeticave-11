  <main>
   
    <?php if (count($categories)): ?>
    <nav class="nav">
      <ul class="nav__list container">
       <?php foreach ($categories as $category): ?>
            <li class="nav__item">
                <a href="../pages/all-lots.html"><?= strip_tags($category['name']); ?></a>
            </li>
            <?php endforeach; ?>
      </ul>
    </nav>
    <?php endif; ?>
    
    <?php $classname = count($errors) > 0 ? "form--invalid" : ""; ?>
    <form class="form container <?=$classname;?>" action="" method="post"> <!-- form--invalid -->
      <h2>Вход</h2>
      
      <?php $classname = isset($errors['email']) ? "form__item--invalid" : ""; ?>
      <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=getPostVal("email");?>">
        <span class="form__error"><?=$errors['email'] ?? ""; ?></span>
      </div>
      
      <?php $classname = isset($errors['password']) ? "form__item--invalid" : ""; ?>
      <div class="form__item form__item--last <?=$classname;?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль">
        <span class="form__error"><?=$errors['password'] ?? "";?></span>
      </div>
      <button type="submit" class="button">Войти</button>
    </form>
  </main>

