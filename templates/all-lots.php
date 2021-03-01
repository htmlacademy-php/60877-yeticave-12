<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php
            foreach ($rowsСategories as $row):
                ?>
                <li class="nav__item">

                    <a href="/all-lots.php?categoryid=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="container">
        <section class="lots">
            <h2>Все лоты в категории <span>«<?php echo $selectAllCategoryQueryArr['name']; ?>»</span></h2>
            <ul class="lots__list">
                <?php
                foreach ($allCategoriesLot as $allCategoriesLotArray):
                    ?>
                    <li class="lots__item lot">
                        <div class="lot__image">
                            <img src="<?php echo $allCategoriesLotArray['img']; ?>" width="350" height="260"
                                 alt="Сноуборд">
                        </div>
                        <div class="lot__info">
                            <span class="lot__category"><?php echo $allCategoriesLotArray['name']; ?></span>
                            <h3 class="lot__title"><a class="text-link"
                                                      href="lot.php?id=<?php echo $allCategoriesLotArray['id']; ?>"><?php echo $allCategoriesLotArray['name_of_the_lot']; ?></a>
                            </h3>
                            <div class="lot__state">

                                <?php if ($allCategoriesLotArray['rate_count'] > 0): ?>
                                    <span class="lot__amount">
             <?php
             if ($allCategoriesLotArray['rate_count'] > 0 && $allCategoriesLotArray['rate_count'] < 2) {
                 echo $allCategoriesLotArray['rate_count'] . " ставка";
             } else if ($allCategoriesLotArray['rate_count'] > 1) {
                 echo $allCategoriesLotArray['rate_count'] . " ставки";
             } else if ($allCategoriesLotArray['rate_count'] > 4) {
                 echo $allCategoriesLotArray['rate_count'] . " ставок";
             }
             ?>
                </span>
                                <?php else: ?>
                                    <div class="lot__lot-price">
                                        <span class="lot__amount">Стартовая цена</span>
                                        <span
                                            class="lot__cost"><?php echo $allCategoriesLotArray['start_price'] . ' ₽'; ?></span>
                                    </div>
                                <?php endif; ?>


                                <?php
                                $hours = lefttotime($allCategoriesLotArray['finish_date'])[0];
                                $minutes = lefttotime($allCategoriesLotArray['finish_date'])[1];
                                ?>
                                <div class="lot__timer timer <?php
                                $futureDate = strtotime($allCategoriesLotArray['finish_date']);
                                $timerFinishing = $futureDate - time();
                                if ($timerFinishing < 3600) {
                                    echo "timer--finishing";
                                } else {
                                    echo "timer";
                                }
                                ?>">
                                    <?php echo $hours . " : " . $minutes; ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <ul class="pagination-list">
            <?php if ($page <= $total): ?>

                <?php if (isset($page) && $page > 1 && isset($_GET['categoryid'])): ?>
                    <li class="pagination-item pagination-item-prev"><a
                            href="all-lots.php?categoryid=<?php echo strip_tags($_GET['categoryid']); ?>&page=<?php echo $page - 1; ?>">Назад</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($page) && isset($_GET['categoryid'])): ?>
                    <?php for ($i = 1; $i <= $total; $i++): ?>
                        <li class="pagination-item "><a
                                href="all-lots.php?categoryid=<?php echo strip_tags($_GET['categoryid']); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                <?php endif; ?>


                <?php if (isset($page) && $page < $total && isset($_GET['categoryid'])): ?>
                    <li class="pagination-item pagination-item-next"><a
                            href="all-lots.php?categoryid=<?php echo strip_tags($_GET['categoryid']); ?>&page=<?php echo $page + 1; ?>">Вперед</a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>

        </ul>
    </div>
</main>
