<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        
        <?php if (count($categories)): ?>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
             
                <?php foreach ($categories as $category): ?>
                <li class="promo__item promo__item--<?= strip_tags($category['char_code']); ?>">
                    <a class="promo__link" href="pages/all-lots.html"><?= strip_tags($category['name']); ?></a>
                </li>
                <?php endforeach; ?>                    
        </ul>
        <?php else: ?>
<!--                    если массив категорий пуст, то список UL не выводится -->
            <?php endif;?>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php if (count($lots)): ?>
            <?php foreach ($lots as $lot): 
                $range = get_date_range($lot['dt_exp']); //определяем интервал времени до истечения лота                
            ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= strip_tags($lot['image_url']); ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= strip_tags($lot['cat_name']); ?></span>
                    <h3 class="lot__title"><a class="text-link" href=<?php echo 'lot.php' . '?id=' . $lot['lot_id']; ?>><?= strip_tags($lot['lot_name']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                               <span class="lot__cost"><?php print(sum_format(strip_tags($lot['start_price'])) . " ₽"); ?></span>                            
                        </div>                        
                        <div class="lot__timer timer <?php if($range[0] == '00') print "timer--finishing"; ?>">                           
                            <?php print $range[0] . ":" . $range[1]; ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
                <p>Нет открытых лотов.</p>
            <?php endif; ?>
        </ul>
    </section>
</main>