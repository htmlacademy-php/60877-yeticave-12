
    <nav class="nav">
      <ul class="nav__list container">
      <?php
                 foreach ($rowscategories as $row):
               ?>
        <li class="nav__item">
          <a href="all-lots.php?categoryid=<?php echo $row['id'];?>"><?php echo $row['name'];?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <section class="lot-item container">
      <h2> <?php echo $onelot['name_of_the_lot']; ?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="<?php echo $onelot['img']; ?>" width="730" height="548" alt="Сноуборд">
          </div>
          <p class="lot-item__category">Категория:
          <?php
                echo $onelot['name'];
              ?>
             </span></p>
          <p class="lot-item__description">
          <?php echo $onelot['deskription']; ?>
      </p>
        </div>
        <div class="lot-item__right">

<?php $nowdate = strtotime('now');
      $finish_date = strtotime($onelot['finish_date']);

if (isset($_SESSION['iduser'])&&($nowdate<$finish_date)
&&($selectlotsauthorarr[0]['authorid']!==$userid)
&&($maxdatebidqueryarr[0]['id']!==$userid)): ?>

          <div class="lot-item__state">
          <?php
              $hours = lefttotime($onelot['finish_date'])[0];
              $minutes = lefttotime($onelot['finish_date'])[1];

$distance = strtotime($onelot['finish_date']) - strtotime("now");

$w = ceil($distance / 86400 / 7);
$d = ceil($distance / 86400 % 7);
$h = ceil($distance / 3600 % 24);
$m = ceil($distance / 60 % 60);
$s = ceil($distance % 60);
              ?>
            <div class="lot-item__timer timer <?php
                            $presentTime = strtotime('now');
                            $futureDate = strtotime($onelot['finish_date']);
                            $timerFinishing = $futureDate - $presentTime;
                      if ($timerFinishing<3600)
                          {echo "timer--finishing";}
                          else {
                            echo "timer";
                        }
                      ?>
                      ">
            <?php echo $hours . " : " . $m." : ".$s;?>

            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?php
                   echo $querysumlottodbfinal['max(summary_of_the_lot)'];
                   if (!$querysumlottodbfinal['max(summary_of_the_lot)']) {
                       echo $onelot['start_price'];
                   }
                ?></span>
              </div>
              <div class="lot-item__min-cost">

                Мин. ставка <span><?php echo formatPrice($maxbidfornowarr[0]["max(summary_of_the_lot)"] + $maxbidfornowarr[0]["step_of_the_bid"]);?></span>
              </div>
            </div>
            <form class="lot-item__form <?php if(isset($errors['wrongbet'])) {echo "form__item--invalid";}?>" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" placeholder="<?php echo $querysumlottodbfinal['max(summary_of_the_lot)']; ?>">
                <span class="form__error"><?php if(isset($errors['wrongbet'])) {echo $errors['wrongbet'];}?></span>
              </p>
              <input type="submit" class="button" name="send_bid" value="Сделать "></button>
            </form>
          </div>


<?php else:?>
<span>Возможные причины появления данного сообщения <br>
1) Пользователь не зарегистрирован<br> 2) истек срок действия лота<br> 3) проверьте что не вы автор поста, может быть и такое!<br>4)
последняя ставка создана текущим юзером
</span>
    <?php endif; ?>
          <div class="history">
            <h3>История ставок (<span><?php echo count($rowshistorysum);?></span>)</h3>
            <table class="history__list">
            <?php foreach ($rowshistory as $history): ?>
              <tr class="history__item">
                <td class="history__name"><?php echo $history['name']; ?></td>
                <td class="history__price"><?php echo formatPrice($history['summary_of_the_lot']); ?></td>
                <td class="history__time"><?php

                $datefromdatabase = $history['date'];
               $datetoprint = strtotime($datefromdatabase);

               echo date ("Y-m-d", $datetoprint )." в ".date ("H:i", $datetoprint );

                ?></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
    </section>
