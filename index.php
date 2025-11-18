<?php

require_once "models/NewsRepository.php";



$numberOfNews = $_GET['news']?? "";
if ($numberOfNews === ""){
    include "views/indexView.php";

} else {
    include "views/newsView.php";
}



