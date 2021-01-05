<main>
    <nav class="nav">
    <ul class="nav__list container">
      <?php
                 foreach ($rowscategories as $row):
               ?>
        <li class="nav__item">
          <a href="/all-lots.php?categoryid=<?php echo $row['id'];?>"><?php echo $row['name'];?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <div class="container">
      <section class="lots">
        <h2>Все лоты в категории <span>«<?php echo $selectallcategoryqueryarr['name']; ?>»</span></h2>
        <ul class="lots__list">
        <?php
                 foreach ($allcategorieslot as $allcategorieslotarray):
               ?>
          <li class="lots__item lot">
            <div class="lot__image">
              <img src="<?php echo $allcategorieslotarray['img']; ?>" width="350" height="260" alt="Сноуборд">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?php echo $allcategorieslotarray['name']; ?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?php echo $allcategorieslotarray['id']; ?>"><?php echo $allcategorieslotarray['name_of_the_lot']; ?></a></h3>
              <div class="lot__state">
              <?php
              /* Вытягиваю историю ставок*/
              $con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");
if ($con == false) {
   print("Ошибка подключения: " . mysqli_connect_error());
}
              $id = $allcategorieslotarray['id'];
$thehistoryofbids= "Select count(bids.id) from bids JOIN users ON bids.userid = users.id where bids.lotid = ".$id;
$resultthehistoryofbids = mysqli_query($con, $thehistoryofbids );
$rowshistory= mysqli_fetch_all($resultthehistoryofbids, MYSQLI_ASSOC);
/* конец истории ставок*/


              ?>

              <?php if ($rowshistory[0]["count(bids.id)"]<1): ?>


                <div class="lot__rate">
                  <span class="lot__amount">Стартовая цена</span>
                  <span class="lot__cost"><?php echo $allcategorieslotarray['start_price']; ?><b class="rub">р</b></span>
                </div>

                 <?php else: ?>



                <span>
                     <?php
                        if ($rowshistory[0]["count(bids.id)"]==1) {
                             echo $rowshistory[0]["count(bids.id)"]. " ставка";
                            }
                        if ($rowshistory[0]["count(bids.id)"]>1) {
                             echo $rowshistory[0]["count(bids.id)"]. " ставки";
                            }
                        if ($rowshistory[0]["count(bids.id)"]>4) {
                             echo $rowshistory[0]["count(bids.id)"]. " ставок";
                            } ?>
                            </span>

                 <?php endif; ?>

                <?php
              $hours = lefttotime($allcategorieslotarray['finish_date'])[0];
              $minutes = lefttotime($allcategorieslotarray['finish_date'])[1];
              ?>
                <div class="lot__timer timer <?php
                            $presentTime = strtotime('now');
                            $futureDate = strtotime($allcategorieslotarray['finish_date']);
                            $timerFinishing = $futureDate - $presentTime;
                      if ($timerFinishing<3600)
                          {echo "timer--finishing";}
                          else {
                            echo "timer";
                        }
                      ?>">
                <?php echo $hours . " : " . $minutes;?>
                </div>
              </div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </section>
      <ul class="pagination-list">
      <?php if ($page<=$total):?>

        <?php if (isset($page) && $page > 1): ?>
        <li class="pagination-item pagination-item-prev"><a href = "all-lots.php?categoryid=<?php echo $_GET['categoryid'];?>&page=<?php echo $page-1; ?>">Назад</a></li>
        <?php endif; ?>

        <?php if (isset($page)): ?>
            <?php for ($i = 1;$i <= $total; $i++): ?>
        <li class="pagination-item "><a href="all-lots.php?categoryid=<?php echo $_GET['categoryid']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>
        <?php endif; ?>


        <?php if (isset($page) && $page < $total): ?>
        <li class="pagination-item pagination-item-next"><a href="all-lots.php?categoryid=<?php echo $_GET['categoryid']; ?>&page=<?php echo $page+1; ?>">Вперед</a></li>
        <?php endif; ?>

        <?php endif; ?>

      </ul>
    </div>
  </main>
