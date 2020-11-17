
<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php
                 foreach ($rowscategories as $row):
               ?>
            <li class="promo__item promo__item--<?php echo $row['symbol_code'];?>">
                 <a class="promo__link" href="pages/all-lots.html"><?php print($row['name']);?></a>
              </li>
              <?php endforeach; ?>
        </ul>
    </section>


    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php foreach ($rowslots as $row): ?>

            <li class="lots__item lot">
              <div class="image">
                    <img src="<?php echo $row['img']; ?>" width="350" height="260" alt="">

              </div>
              <div class="lot__info">
                 <span class="lot__category"><?php echo $row['name'];?></span>
                  <h3 class="lot__title">  <a class="text-link" href="lot.php?id=<?php echo $row['id'];?>"><?php echo htmlspecialchars($row['name_of_the_lot']);?></a></h3>
                  <div class="lot__state">
                      <div class="lot__rate">
                          <span class="lot__amount">Стартовая цена </span>
                         <span class="lot__cost"> <?php echo htmlspecialchars(formatPrice($row['start_price'])); ?></span>
                      </div>

                      <div class="lot__timer timer
                      <?php $presentTime = strtotime('now');
                            $futureDate = strtotime($row['finish_date']);

                        $timerFinishing = $futureDate - $presentTime;
                      if ($timerFinishing<3600)
                          {echo "timer--finishing";}

                      ?>
                      ">

                       <?php
                       $lefttoend = lefttotime( $row['finish_date'] );

                        if($lefttoend[0]<=0&&$lefttoend[1]<=0){
                            echo $futureDate;
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
