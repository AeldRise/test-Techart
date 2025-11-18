<?php

use models\NewsRepository;

require_once "models/NewsRepository.php";

$currentPage = $_GET["page"] ?? 1;
$countNewsPerPage = 4;
require_once "config/dbConnect.php";
$newsStartIndex = ($currentPage * $countNewsPerPage) - $countNewsPerPage;
$newsRepository = new NewsRepository($pdo);
$newsCount = $newsRepository->getNewsCount();
$newsArray = $newsRepository->getManyNews($newsStartIndex,$countNewsPerPage);
$totalPages = ceil($newsCount / $countNewsPerPage);
$newsRepository = new NewsRepository($pdo);
$newsStartIndex = ($currentPage * $countNewsPerPage) - $countNewsPerPage;
$lastNews = $newsRepository->getLastNews();
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
<body class="b-layout" >
<?php
require_once "views/header.php";
?>
<main>
    <div class="b-main__banner"
         style='background-image: url("assets/images/<?=$lastNews->getImage()?>")'>
        <div class="b-banner__content">
            <h1 class="b-banner-content__title"><?= $lastNews->getTitle()?></h1>
            <div class="b-banner-content__announce">
                <?= $lastNews->getAnnounce()?>
            </div>
        </div>

        <!-- Автоматом подтягивается наиболее новая новость -->
    </div>
    <div class="b-main__news">
        <div>
            <h1 class="b-news__title">Новости</h1>
        </div>
        <div class="b-news__news-list">

            <?php
            foreach ($newsArray as $news) {
                $titleClass = "b-news-item__title";
                $buttonClass = "b-news-item__detailed-button";
                $svgColor="#841844";
                $date = strtotime($news->getDate());
                $dateformatted = date("d.m.Y", $date);
                echo '<article class="b-news-item">';
                echo '<div class="b-news-item__date">';
                echo $dateformatted;
                echo '</div>';
                if($news->getId() === $lastNews->getId()) {
                    $titleClass = "b-news-item__title b-news-item__title--active";
                    $buttonClass = "b-news-item__detailed-button b-news-item__detailed-button--active";
                    $svgColor = "#FFFFFF";
                }
                echo '<div class="'.$titleClass.'">';
                echo '<h2>' . $news->getTitle() . '</h2>';
                echo '</div>';
                echo '<div class="b-news-item__announce">';
                echo $news->getAnnounce();
                echo '</div>';
                echo '<div class="'.$buttonClass.'">';
                echo "<a href=\"?news={$news->getId()}\">Подробнее";
                echo '<svg width="27" height="15" viewBox="0 0 27 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 6.36395C0.447715 6.36395 4.82823e-08 6.81167 0 7.36395C-4.82823e-08 7.91624
                             0.447715 8.36395 1 8.36395L1 6.36395ZM26.707 8.07106C27.0975 7.68054 27.0975
                              7.04737 26.707 6.65685L20.343 0.292887C19.9525 -0.0976379 19.3193 -0.097638
                               18.9288 0.292886C18.5383 0.683411 18.5383 1.31658 18.9288 1.7071L24.5857
                                7.36395L18.9288 13.0208C18.5383 13.4113 18.5383 14.0445 18.9288 14.435C19.3193
                                 14.8255 19.9525 14.8255 20.343 14.435L26.707 8.07106ZM1 8.36395L25.9999
                                  8.36395L25.9999 6.36395L1 6.36395L1 8.36395Z"
                                   fill='.".$svgColor.".'"/>
                        </svg>';
                echo '</a>' ;
                echo '</div>';
                echo '</article>';
            }
            ?>
        </div>
        <div class="b-news__pagination">
            <!-- Пагинация -->
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                $active = ($i == $currentPage) ? " class='b-pagination__item b-pagination__item--active'" : " class='b-pagination__item'";
                echo "<a  href='?page=$i'$active>$i</a>";
            }

            // Кнопка "Вперед"
            if ($currentPage < $totalPages) {
                echo "<a class='b-pagination__item b-pagination__item--forward' href='?page=" . ($currentPage + 1) . "'>";
                echo '<svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3 10C2.44772 10 2 10.4477 2 11C2 11.5523 2.44772 12 3 12L3 10ZM18.466 11.7071C18.8565 11.3166 18.8565 10.6834 18.466 10.2929L12.102 3.92893C11.7115 3.53841 11.0783 3.53841 10.6878 3.92893C10.2973 4.31946 10.2973 4.95262 10.6878 5.34315L16.3447 11L10.6878 16.6569C10.2973 17.0474 10.2973 17.6805 10.6878 18.0711C11.0783 18.4616 11.7115 18.4616 12.102 18.0711L18.466 11.7071ZM3 12L17.7589 12L17.7589 10L3 10L3 12Z" fill="#841844"/>
</svg>';
                echo "</a>";
            }
            ?>
        </div>
    </div>

</main>

<footer class="b-footer">
    <div>
        <hr>
    </div>
    <div class="b-footer__text">
        <p>© 2023 — 2412 «Галактический вестник»</p>
    </div>

</footer>
</body>
</html>

