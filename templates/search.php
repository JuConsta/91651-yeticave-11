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

    <div class="container">
        <section class="lots">
            <h2>Результаты поиска по запросу «<span><?=$search;?></span>»</h2>

            <ul class="lots__list">
                <?php if (count($search_lots)): ?>
                
                <?php foreach ($search_lots as $lot): 
                    $range = get_date_range($lot['dt_exp']);            
                ?>

                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?= strip_tags($lot['image_url']); ?>" width="350" height="260" alt="Сноуборд">
                    </div>
                    
                    <div class="lot__info">
                       
                        <span class="lot__category">
                            <?= strip_tags($lot['cat_name']); ?></span>
                            
                        <h3 class="lot__title"><a class="text-link" href="<?php echo 'lot.php' . '?id=' . $lot['id']; ?>">
                                <?= strip_tags($lot['name']); ?></a></h3>
                                
                        <div class="lot__state">
                           
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?php print(sum_format(strip_tags($lot['start_price'])) . " ₽"); ?></span>
                            </div>
                            
                            <div class="lot__timer timer <?php if($range[0] == '00') print " timer--finishing"; ?>">
                                <?php print $range[0] . ":" . $range[1]; ?>
                            </div>
                            
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Ничего не найдено по вашему запросу.</p>
                <?php endif; ?>

            </ul>
        </section>
<!--
        
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
            <li class="pagination-item pagination-item-active"><a>1</a></li>
            <li class="pagination-item"><a href="#">2</a></li>
            <li class="pagination-item"><a href="#">3</a></li>
            <li class="pagination-item"><a href="#">4</a></li>
            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
        
-->
    </div>
</main>
