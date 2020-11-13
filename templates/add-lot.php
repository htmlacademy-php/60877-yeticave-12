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
    <form class="form form--add-lot container <?php  if ($errors) { echo "form--invalid";}?>" action="add.php" method="post" enctype="multipart/form-data">
      <h2>Добавление лота</h2>
      <div class="form__container-two">

        <div class="form__item <?php  if ($errors['name']) { echo "form--invalid";}?>">
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" required >
          <span class="form__error"><?php  if ($errors['name']) { echo $errors['name'];}?></span>
        </div>

        <div class="form__item <?php  if ($errors['field']) { echo "form__item--invalid";}?>">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="category" required >
            <option>Выберите категорию</option>
            <?php
                 foreach ($rowscategories as $row):
               ?>
            <option><?php echo $row['name'];?></option>
            <?php endforeach; ?>
          </select>
          <span class="form__error">Выберите категорию</span>
        </div>

      </div>

      <div class="form__item form__item--wide <?php  if ($errors['categories']) { echo "form__item--invalid";}?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота" required ></textarea>
        <span class="form__error"><?php  if ($errors['categories']) { echo $errors['categories'];}?></span>
      </div>

      <div class="form__item form__item--file <?php  if ($errors['format']) { echo "form__item--invalid";}?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <input class="visually-hidden" type="file" id="lot-img" value="" required name="add-lot-file">
          <label for="lot-img">
            Добавить
          </label>
        </div>
        <span class="form__error"><?php  if ($errors['format']) { echo $errors['format'];}?></span>
      </div>

      <div class="form__container-three">
        <div class="form__item form__item--small <?php  if ($errors['lot-rate-empty']||$errors['lot-rate-empty']) { echo "form__item--invalid";}?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input id="lot-rate" type="text" name="lot-rate" placeholder="0" required >
          <span class="form__error"><?php
          if ($errors['lot-rate-empty']) {
              echo $errors['lot-rate-empty'];
            }
              if ($errors['lot-rate-num']) {
                  echo $errors['lot-rate-num'];
            }
            ?>
            </span>
        </div>
        <div class="form__item form__item--small <?php  if ($errors['lot-step-empty']||$errors['lot-step-num']) { echo "form__item--invalid";}?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input id="lot-step" type="text" name="lot-step" placeholder="0" required >
          <span class="form__error"><?php
          if (
              $errors['lot-step-empty']) {
              echo $errors['lot-step-empty'];
        }
        if ($errors['lot-step-num']) {
          echo $errors['lot-step-num'];
        }
        ?></span>
        </div>
        <div class="form__item <?php  if ($errors['date']) { echo "form__item--invalid";}?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" required >
          <span class="form__error"><?php
            if ($errors['date']) {
              echo $errors['date']; }
                  ?>
                  <?php if ($errors['wrongdate']){echo $errors['wrongdate'];} ?>
                  </span>
        </div>
      </div>
      <span class="form__error form__error--bottom"><?php  if ($errors) { echo "Исправьте ошибки в форме";}?></span>
      <input type="submit" class="button" name="senddata">Добавить лот</button>
    </form>
  </main>

</div>

