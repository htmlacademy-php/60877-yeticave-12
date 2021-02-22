<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php
            foreach ($rowsCategories as $row):
                ?>
                <li class="nav__item">
                    <a href="all-lots.php?categoryid=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <section class="lot-item container">
        <h2>404 Страница не найдена</h2>
        <p>Данной страницы не существует на сайте.</p>
    </section>
</main>
