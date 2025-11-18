<?php

require_once "models/NewsRepository.php";

$pdo = new PDO("mysql:host=localhost;dbname=test_techart","root","");

$numberOfNews = $_GET['news']?? "";
if ($numberOfNews === ""){
    include "views/indexView.php";

} else {
    include "views/newsView.php";
}



