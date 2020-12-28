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
    <section class="rates container">
      <h2>Мои ставки</h2>
      <table class="rates__list">
        <tr class="rates__item">
          <td class="rates__info">
            <div class="rates__img">
              <img src="../img/rate1.jpg" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title"><a href="lot.html">2014 Rossignol District Snowboard</a></h3>
          </td>
          <td class="rates__category">
            Доски и лыжи
          </td>
          <td class="rates__timer">
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
            <?php echo $hours . " : " . $minutes;?>
          </td>
          <td class="rates__price">
            10 999 р
          </td>
          <td class="rates__time">
            5 минут назад
          </td>
        </tr>
      </table>
    </section>
  </main>
