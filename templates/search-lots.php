  <main>
  <nav class="nav">
      <ul class="nav__list container">
      <?php
                 foreach ($rowscategories as $row):
               ?>
        <li class="nav__item">
          <a href="all-lots.html"><?php echo $row['name'];?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span><?php echo $_GET['search']; ?></span>»</h2>

        <ul class="lots__list">
        <?php
                 foreach ($resultsearch as $resultsearchrow):
               ?>
          <li class="lots__item lot">
            <div class="lot__image">
            <?php if (count($resultsearch)>0):?>
              <img src="<?php echo $resultsearchrow['img']; ?>" width="350" height="260" alt="<?php echo $resultsearchrow['symbol_code']; ?>">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?php echo $resultsearchrow['name']; ?></span>
              <h3 class="lot__title"><a class="text-link" href="/lot.php?id=<?php echo $resultsearchrow['id']; ?>"><?php echo $resultsearchrow['name_of_the_lot']; ?></a></h3>
              <div class="lot__state">
                <div class="lot__rate">
                  <span class="lot__amount">Стартовая цена</span>
                  <span class="lot__cost"><?php echo $resultsearchrow['start_price']; ?><b class="rub">р</b></span>
                </div>
                <?php
                  $hours = lefttotime($resultsearchrow['finish_date'])[0];
                  $minutes = lefttotime($resultsearchrow['finish_date'])[1];
                ?>
                <div class="lot__timer timer <?php
                            $presentTime = strtotime('now');
                            $futureDate = strtotime($resultsearchrow['finish_date']);
                            $timerFinishing = $futureDate - $presentTime;
                      if ($timerFinishing<3600)
                          {echo "timer--finishing";}
                      ?>
                    ">
                <?php echo $hours.":".$minutes ?>
                </div>
              </div>
            </div>
          </li>
            <?php  else: echo "Ничего не найдено"; ?>
            <?php  endif; ?>
          <?php endforeach; ?>
        </ul>

      </section>
      <ul class="pagination-list">


        <?php if(count($resultsearch)>=$results_per_page): ?>
            <li class="pagination-item pagination-item-prev"><a href="">Назад</a></li>
            <?php for($i=1; $i<$num_rows; $i++): ?>
               <?php if ($i!= $nav): ?>
                <?php echo '<li class="pagination-item"><a href="searh.php/?id=<?php count($resultsearch);?>/page=.$i."></a>'.$i.'</li>' ?>
        <?php endif; ?>
        <?php endfor; ?>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        <?php endif; ?>

      </ul>
    </div>
  </main>
