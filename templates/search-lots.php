<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach ($rowsCategories as $row): ?>
                <li class="nav__item">
                    <a href="all-lots.php?categoryid=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="container">
        <section class="lots">
            <?php if (count($resultSearch) > 0): ?>
                <h2>Результаты поиска по запросу «<span><?php echo trim($_GET['search']); ?></span>»</h2>
                <ul class="lots__list">
                    <?php foreach ($resultSearch as $resultSearchRow): ?>

                        <li class="lots__item lot">
                        <div class="lot__image">
                        <?php if (isset($resultSearch)): ?>
                            <img src="<?php echo $resultSearchRow['img']; ?>" width="350" height="260"
                                 alt="<?php echo $resultSearchRow['symbol_code']; ?>">
                            </div>
                            <div class="lot__info">
                                <span class="lot__category"><?php echo $resultSearchRow['name']; ?></span>
                                <h3 class="lot__title"><a class="text-link"
                                                          href="/lot.php?id=<?php echo $resultSearchRow['id']; ?>"><?php echo $resultSearchRow['name_of_the_lot']; ?></a>
                                </h3>
                                <div class="lot__state">
                                    <div class="lot__rate">
                                        <span class="lot__amount">Стартовая цена</span>
                                        <span class="lot__cost"><?php echo $resultSearchRow['start_price']; ?><b
                                                class="rub">р</b></span>
                                    </div>
                                    <?php [$hours, $minutes] = lefttotime($resultSearchRow['finish_date']); ?>
                                    <div class="lot__timer timer <?php $presentTime = strtotime('now');
                                    $futureDate = strtotime($resultSearchRow['finish_date']);
                                    $timerFinishing = $futureDate - $presentTime;
                                    if ($timerFinishing < 3600) {
                                        echo "timer--finishing";
                                    } ?>
                    ">
                                        <?php echo $hours . ":" . $minutes ?>
                                    </div>
                                </div>
                            </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <?php echo "Ничего не найдено по вашему запросу" ?>
            <?php endif; ?>
        </section>
        <ul class="pagination-list">

            <?php if ($total > 1): ?>
                <?php

                if (isset($_GET['page'])) {
                    $getpage = $_GET['page'];
                } else {
                    $getpage = 0;
                }
                ?>
                <?php if ($getpage <= $total): ?>
                    <?php if (isset($page) && $page > 1): ?>
                        <li class="pagination-item pagination-item-prev">
                            <a href="search.php?search=<?php echo $_GET['search'] ?>&find=<?php echo $_GET['find']; ?>&page=<?php echo $page - 1; ?>">Назад</a>
                        </li>
                    <?php endif; ?>
                    <?php $params = $_GET; ?>
                    <?php if (isset($page)): ?>
                        <?php for ($i = 1; $i <= $total; $i++): ?>
                            <li class="pagination-item">
                                <a href="search.php?search=<?php echo $_GET['search'] ?>&find=<?php echo $_GET['find']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                            </li>
                        <?php endfor; ?>
                    <?php endif; ?>

                    <?php if (isset($page) && $page < $total): ?>
                        <li class="pagination-item pagination-item-next">
                            <a href="search.php?search=<?php echo $_GET['search'] ?>&find=<?php echo $_GET['find']; ?>&page=<?php echo $page + 1; ?>">Вперед</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>


        </ul>
    </div>
</main>
