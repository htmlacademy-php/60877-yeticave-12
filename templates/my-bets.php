<main>
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
    <section class="rates container">
      <h2>Мои ставки</h2>
      <table class="rates__list">
      <?php
                 foreach ($usermybetqueryarray as $mybetarray):
               ?>

        <tr class="rates__item

        <?php

        if ($mybetarray['id']==$getarrwinner['id']) {
          echo "rates__item--win";
        }

        $presentTime = strtotime('now');
        $futureDate = strtotime($mybetarray['finish_date']);
        $timerFinishing = $futureDate - $presentTime;
  if ($timerFinishing<=0)
      {
          echo "rates__item--end";
    }

      if ($mybetarray['id']==$getarrwinner['id']) {
        echo "timer--win";
              }
        ?>

        ">
          <td class="rates__info">
            <div class="rates__img">
              <img src="<?php echo $mybetarray['img'];?>" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title">
            <a href="lot.php?id=<?php echo $mybetarray['id']; ?>"><?php echo $mybetarray['name_of_the_lot'];?></a>
            <p><?php echo $mybetarray['deskription'];?></p>
            </h3>
          </td>
          <td class="rates__category">
              <?php echo $mybetarray['name']; ?>
          </td>
          <td class="rates__timer">
          <?php
              $hours = lefttotime($mybetarray['finish_date'])[0];
              $minutes = lefttotime($mybetarray['finish_date'])[1];
              ?>
          <div class="lot-item__timer timer

          <?php
                            $presentTime = strtotime('now');

                            $futureDate = strtotime($mybetarray['finish_date']);

                            $timerFinishing = $futureDate - $presentTime;

                      if ($timerFinishing>0&&$timerFinishing<3600){
                          echo "timer--finishing";
                        }

                          elseif($timerFinishing<=0){
                             echo "timer--end";
                          }

                          if ($mybetarray['id']==$getarrwinner['id']) {
                            echo "timer--win";
                                  }

                      ?>
                      ">
                 <?php
                 if ($mybetarray['id']==$getarrwinner['id']) {
          echo "Ставка выиграла";
                }
                elseif($timerFinishing<=0) {
echo "Торги окончены";
                }
                else {
                    echo $hours . " : " . $minutes;
                }
        ?>
          </td>
          <td class="rates__price">
            <?php echo $mybetarray['start_price'];?> р
          </td>
          <td class="rates__time">

          <?php
$now = strtotime('now');
$startdate = strtotime($mybetarray['date_of_creation']);

$final_result = $now - $startdate ;

$w = round($final_result / 86400 / 7);
$d = round($final_result / 86400 % 7);
$h = round($final_result / 3600 % 24);
$m = round($final_result / 60 % 60);
$s = round($final_result % 60);

 if ($h==0) {
    $h='0'.$h;
  }
  if ($m<10) {
    $m='0'.$m;
  }
  if ($s<10) {
    $s='0'.$s;
  }
  if ($d<1) {
    echo  $h.":".$m . ":" .$s." часа назад";
  }
  else if ($w>1) {
    echo  "Больше недели назад" ;
  }
  else if ($w==1) {
    echo  "Неделю назад";
  }
  else if ($d>1&&2<$d&&$w<1) {
    echo  "Больше cуток назад";
  }
  else if ($h==1&&$w==0&&$d==0) {
    echo  "Час назад";
  }
  else if ($h>24) {
     echo "Вчера, в ". $h.":".$m;
  }
          ?>

          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </section>
  </main>
