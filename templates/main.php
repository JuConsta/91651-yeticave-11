<?php require_once(__DIR__ . '/../main.php'); ?>
   
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
            <?php 
            if (count($categories) > 0): 
                foreach ($categories as $category): ?>
                <li class="promo__item promo__item--<?= $category['char_code']?>">
                    <a class="promo__link" href="pages/all-lots.html"><?= strip_tags($category['name']); ?></a>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
<!--                    что делать, если вдруг массив категорий пуст? -->
            <?php endif;?>        
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php if (count($lots) > 0): ?>
            <?php foreach ($lots as $lot): 
                $range = get_date_range(strip_tags($lot[0])); //определяем интервал времени до истечения лота
                if($range != false): //если время истекло, то лот не показываем
            ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= strip_tags($lot[1]) ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= strip_tags($lot[2]) ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= strip_tags($lot[3]) ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                               <span class="lot__cost"><?php print(sum_format(strip_tags($lot[4]))); ?></span>                            
                        </div>                        
                        <div class="lot__timer timer <?php if($range[0] == '00') print "timer--finishing"; ?>">                           
                            <?php print $range[0] . ":" . $range[1]; ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php 
                endif;
                endforeach; 
            ?>
            <?php else: ?>
                <p>Нет открытых лотов.</p>
            <?php endif; ?>
        </ul>
    </section>