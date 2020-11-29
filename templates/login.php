

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
    <form class="form container" action="login.php" method="post"> <!-- form--invalid -->
      <h2>Вход</h2>
      <div class="form__item <?php if (isset($errors['email'])){echo "form__item--invalid"; } ?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail">
        <span class="form__error"><?php if (isset($errors['email'])){ echo $errors['email']; } ?>
        <?php if (isset($errors['wrongformatemail'])){ echo $errors['wrongformatemail']; } ?>
    </span>
      </div>
      <div class="form__item form__item--last <?php if (isset($errors['password'])){ echo "form__item--invalid"; } ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль">
        <span class="form__error"><?php if (isset($errors['password'])){echo $errors['password']; } ?></span>
      </div>
      <input type="submit" class="button" name="submit">Войти</button>
    </form>
  </main>

