<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новость | <?= $news->getTitle() ?> | Тестовое задание Techart.Web</title>
    <base href="/">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body class="b-layout">
<?php require_once "views/header.php"; ?>
<hr>
<main class="b-main__news">
    <div class="b-bread">
        <span class="b-bread__item">
            <a class="b-bread-item__link" href="/">Главная страница</a>
        </span>
        <span>
            /
        </span>
        <span class="b-bread__item b-bread__item--current">
            <?= $news->getTitle() ?> 
        </span>
    </div>
    <div class="b-detailed-news__title"><?= $news->getTitle() ?></div>
    <div class="b-main__detailed-news">
        <div class="b-news-item-detailed">
            <div class="b-news-item__date"><?= $date ?></div>
            <div class="b-news-detailed__announce"><?= $news->getAnnounce() ?></div>
            <div class="b-news-item__content"><?= $news->getContent() ?></div>
            <div class="b-news-item__detailed-button">
                <a href="/news/">
                    <img src="assets/svg/arrow-back.svg">
                    Назад к новостям
                </a>
            </div>
        </div>
        <div class="b-detailed-news__image" ><img src="assets/images/<?= $news->getImage() ?>"></div>
    </div>
</main>
<?php require_once "views/footer.php"; ?>
</body>
</html>