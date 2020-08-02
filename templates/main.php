<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php
                foreach($categories as $category):
               ?>
            <li class="promo__item promo__item--boards">
                    <a class="promo__link" href="pages/all-lots.html"><?=$category; ?></a>
              </li>
              <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php foreach ($lots as $lot): ?>
            <li class="lots__item lot">
              <div class="image">
                    <img src="<?php echo $lot['img']; ?>" width="350" height="260" alt="">
              </div>
              <div class="lot__info">
                 <span class="lot__category"><?php $lot['category'];?></span>
                  <h3 class="lot__title">  <a class="text-link" href="pages/lot.html"><?php echo htmlspecialchars($lot['name']);?></a></h3>
                  <div class="lot__state">
                      <div class="lot__rate">
                          <span class="lot__amount">Стартовая цена</span>
                         <span class="lot__cost"> <?php echo htmlspecialchars(formatPrice($lot['price'])); ?></span>
                      </div>

                      <div class="lot__timer timer
                      <?php $presentTime = strtotime('now');
                            $futureDate = strtotime($lot['time']);
                        $timerFinishing = $futureDate - $presentTime;
                      if ($timerFinishing<3600)
                          {echo "timer--finishing";}

                      ?>
                      ">

                       <?php $lefttoend = lefttotime( $lot['time'] );

                        if($lefttoend[0]<=0&&$lefttoend[1]<=0){
                              $lefttoend[0] = 0;
                              $lefttoend[1] = 0;
                              echo $lefttoend[0] ." : " .  $lefttoend[1];
                            }
                            else {
                                echo $lefttoend[0] ." : " .  $lefttoend[1];
                            }
                                ?>
                      </div>
                    </div>
                </div>
            </li>
               <?php endforeach; ?>
        </ul>
    </section>
</main>
