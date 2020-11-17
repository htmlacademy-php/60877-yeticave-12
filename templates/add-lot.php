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
    <form class="form form--add-lot container <?php  if (isset($errors)) { echo "form--invalid";}?>" action="add.php" method="post" enctype="multipart/form-data">
      <h2>Добавление лота</h2>
      <div class="form__container-two">

        <div class="form__item <?php  if (isset($errors['name'])) { echo "form__item--invalid";}?>">
          <label for="lot-name">Наименование <sup>*</sup></label>
          <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" >
          <span class="form__error"><?php  if (isset($errors['name'])) { echo $errors['name'];}?></span>
        </div>

        <div class="form__item <?php  if (isset($errors['categories'])) { echo "form__item--invalid";}?>">
          <label for="category">Категория <sup>*</sup></label>
          <select id="category" name="category"  >
          <option value="-1">Выберите категорию</option>
            <?php
                 foreach ($rowscategories as $row):
               ?>

            <option value="<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
            <?php endforeach; ?>
          </select>
          <span class="form__error"><?php  if (isset($errors['categories'])) { echo $errors['categories'];}?></span>
        </div>

      </div>

      <div class="form__item form__item--wide <?php  if (isset($errors['message'])) { echo "form__item--invalid";}?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"  ></textarea>
        <span class="form__error"><?php  if (isset($errors['message'])) { echo $errors['message'];}?></span>
      </div>

      <div class="form__item form__item--file <?php  if (isset($errors['format'])) { echo "form__item--invalid";}?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
          <input class="visually-hidden" type="file" id="lot-img" value=""  name="add-lot-file">
          <label for="lot-img">
            Добавить
          </label>
        </div>
        <span class="form__error"><?php  if (isset($errors['format'])) { echo $errors['format'];}?>
        <?php  if (isset($errors['image-size'])) { echo $errors['image-size'];}?>
        </span>
      </div>

      <div class="form__container-three">
        <div class="form__item form__item--small <?php  if (isset($errors['lot-rate-num'])||isset($errors['lot-rate-empty'])) { echo "form__item--invalid";}?>">
          <label for="lot-rate">Начальная цена <sup>*</sup></label>
          <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?php  if (isset($errors['lot-rate-num'])) { echo $_POST['lot-rate'];}?>">
          <span class="form__error"><?php
          if (isset($errors['lot-rate-empty'])) {
              echo $errors['lot-rate-empty'];
            }
            ?>
            <?php
               if (isset($errors['lot-rate-num'])) {
                  echo $errors['lot-rate-num'];}
                  ?>
            </span>
        </div>
        <div class="form__item form__item--small <?php  if (isset($errors['lot-step-empty'])||isset($errors['lot-step-num'])) { echo "form__item--invalid";}?>">
          <label for="lot-step">Шаг ставки <sup>*</sup></label>
          <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?php  if (isset($errors['lot-step-num'])) { echo $_POST['lot-step'];}?>">
          <span class="form__error"><?php
          if (isset($errors['lot-step-empty'])) {
              echo $errors['lot-step-empty'];
        }
        if (isset($errors['lot-step-num'])) {
          echo $errors['lot-step-num'];
        }
        ?></span>
        </div>
        <div class="form__item <?php  if (isset($errors['wrongdate']) ) { echo "form__item--invalid";}?>">
          <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
          <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?php  if (isset($errors['wrongdate'])) { echo $_POST['lot-date'];}?>" >
          <span class="form__error">
                  <?php if (isset($errors['wrongdate']) ){echo $errors['wrongdate'];} ?>
                  <?php if (isset( $errors['missing-date']) ){echo $errors['missing-date'];} ?>
                  </span>
        </div>
      </div>
      <span class="form__error form__error--bottom"><?php  if (isset($errors)) { echo "Исправьте ошибки в форме";}?></span>
      <input type="submit" class="button" name="senddata">Добавить лот</button>
    </form>
  </main>

</div>

