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
    <form class="form container <?php if (isset($errors)){ echo "form--invalid";}?>" action="registration.php" method="post" autocomplete="off">
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item

      <?php if (isset($errors['email'])){ echo "form__item--invalid";}?>
      <?php if (isset($errors['wrongformatemail'])){ echo "form__item--invalid";}?>
      <?php if (isset($errors['repeatemail'])){ echo "form__item--invalid";}?>">


        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?php if (isset($errors['repeatemail'])){ echo $_POST['email'];}?>
        ">
        <span class="form__error">      <?php if (isset($errors['repeatemail'])){ echo $errors['repeatemail'];}?>
      <?php if (isset($errors['wrongformatemail'])){ echo $errors['wrongformatemail'];}?></span>
      </div>
      <div class="form__item <?php if (isset($errors['password'])){ echo "form__item--invalid";}?> ">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" >
        <span class="form__error"><?php if (isset($errors['password'])){ echo $errors['password'];}?>"></span>
      </div>
      <div class="form__item <?php if (isset($errors['name'])){ echo "form__item--invalid";}?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?php if (isset($errors['name'])){ echo $_POST['name'];}?>">
        <span class="form__error"><?php if (isset($errors['name'])){ echo $errors['name'];}?></span>
      </div>
      <div class="form__item <?php if (isset($errors['message'])){ echo "form__item--invalid";}?>">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться" value="<?php if (isset($errors['message'])){ echo $_POST['message'];}?>"></textarea>
        <span class="form__error"><?php if (isset($errors['message'])){ echo $errors['message'];}?></span>
      </div>
      <?php
       if ($errors) {
    ?>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <?php
      }
    ?>
      <input type="submit" class="button" name="register">Зарегистрироваться</button>
      <a class="text-link" href="#">Уже есть аккаунт</a>
    </form>
  </main>
