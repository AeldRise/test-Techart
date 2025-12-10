<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список новостей | Страница <?= $currentPage ?> | Тестовое задание Techart.Web</title>
    <base href="/">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body class="b-layout" >
<?php require_once "views/particles/header.php"; ?>
<main>
    <div class="b-main__banner"
         style='background-image: url("assets/images/<?= $lastNews->getImage() ?>")'>
        <div class="b-banner__content">
            <h1 class="b-banner-content__title"><?= $lastNews->getTitle() ?></h1>
            <div class="b-banner-content__announce">
                <?= $lastNews->getAnnounce() ?>
            </div>
        </div>
    </div>
    <div class="b-main__news">
        <div>
            <h1 class="b-news__title">Новости</h1>
        </div>
        <div class="b-news__news-list">
            <?php
            foreach ($newsArray as $news) {
                $isLatestNews = $news->getId() === $lastNews->getId();
                $titleClass = "b-news-item__title";
                $buttonClass = "b-news-item__detailed-button";
                $date = date("d.m.Y", strtotime($news->getDate()));
                if($isLatestNews) {
                    $titleClass = "b-news-item__title b-news-item__title--active";
                    $buttonClass = "b-news-item__detailed-button b-news-item__detailed-button--active";
                }
            ?>
                <article class="b-news-item">
                    <div class="b-news-item__date">
                        <?= $date ?>
                    </div>
                    <div class="<?= $titleClass ?>">
                        <h2><?= $news->getTitle() ?></h2>
                    </div>
                    <div class="b-news-item__announce">
                        <?= $news->getAnnounce()?>
                    </div>
                    <div class="<?= $buttonClass ?>">
                    <a href="/news/<?= $news->getId()?>/">Подробнее
                    <?php 
                        if ($isLatestNews) {
                    ?>
                        <img src="assets/svg/arrow--active.svg">
                    <?php 
                        } else {
                    ?>
                        <img src="assets/svg/arrow.svg">
                    <?php
                        }
                    ?>
                </a>
                </div>
                </article>
            <?php
            }
            ?>
        </div>
        <div class="b-news__pagination">
        <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                $active = ($i == $currentPage) ? "b-pagination__item b-pagination__item--active" : "b-pagination__item";
        ?>
            <a href="/news/page-<?= $i ?>/" class="<?= $active ?>"><?= $i ?></a>
        <?php 
            }
            if ($currentPage < $totalPages) {
        ?>
            <a class="b-pagination__item b-pagination__item--forward" href="/news/page-<?= $currentPage + 1 ?>/">
            <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 10C2.44772 10 2 10.4477 2 11C2 11.5523 2.44772 12 3 12L3 10ZM18.466 11.7071C18.8565 11.3166
                18.8565 10.6834 18.466 10.2929L12.102 3.92893C11.7115 3.53841 11.0783 3.53841 10.6878 3.92893C10.2973
                4.31946 10.2973 4.95262 10.6878 5.34315L16.3447 11L10.6878 16.6569C10.2973 17.0474 10.2973 17.6805
                10.6878 18.0711C11.0783 18.4616 11.7115 18.4616 12.102 18.0711L18.466 11.7071ZM3 12L17.7589 12L17.7589
                10L3 10L3 12Z" fill="#841844"/>
            </svg>
            </a>
        <?php
            }
        ?>
        </div>
    </div>
</main>
<?php require_once "views/particles/footer.php"; ?>
</body>
</html>