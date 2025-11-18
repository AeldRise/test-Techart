<?php
use models\NewsRepository;
use models\News;

require_once "models/News.php";
require_once "models/NewsRepository.php";
require_once "config/dbConnect.php";
$newsRepository = new NewsRepository($pdo);
$news = $newsRepository->getNewsById($_GET["news"]);
$date = strtotime($news->getDate());
$dateFormatted = date("d.m.Y", $date);

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестовое задание Techart.Web</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body class="b-layout">
<?php
require_once "views/header.php";
?>
<hr>
<main class="b-main__news">
    <div class="b-bread">
        <span class="b-bread__item">
            <a class="b-bread-item__link" href="index.php">Главная страница</a>
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
            <div class="b-news-item__date"><?= $dateFormatted ?></div>
            <div class="b-news-detailed__announce"><?=$news->getAnnounce() ?></div>
            <div class="b-news-item__content"><?=$news->getContent() ?></div>
            <div class="b-news-item__detailed-button">
                <a href="index.php">
                    <svg width="26" height="15" viewBox="0 0 26 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.293015 8.07106C-0.0975094 7.68054 -0.0975094 7.04737 0.293014 6.65685L6.65698 0.292887C7.0475 -0.0976379 7.68067 -0.097638 8.07119 0.292886C8.46171 0.683411 8.46171 1.31658 8.07119 1.7071L2.41434 7.36395L8.07119 13.0208C8.46171 13.4113 8.46171 14.0445 8.07119 14.435C7.68067 14.8255 7.0475 14.8255 6.65698 14.435L0.293015 8.07106ZM26 8.36395L1.00012 8.36395L1.00012 6.36395L26 6.36395L26 8.36395Z" fill="#841844"/>
                    </svg>
                    Назад к новостям
                </a>
            </div>
        </div>
        <div class="b-detailed-news__image" ><img src="assets/images/<?=$news->getImage()?>"></div>
    </div>
</main>

</body>

<footer class="b-footer">
    <div>
        <hr>
    </div>
    <div class="b-footer__text">
        <p>© 2023 — 2412 «Галактический вестник»</p>
    </div>
</footer>
</html>