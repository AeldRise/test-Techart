<?php
namespace App\Controllers;

use App\Models\NewsRepository;
use App\Core\Database;

class NewsController extends Controller
{   
    public function index($page = 1)
    {   
        $db = new Database();
        $newsRepository = new NewsRepository($db);
        $countPerPage = 4;
        $newsStartIndex = ($page - 1) * $countPerPage;
        $newsCount = $newsRepository->getCount();
        $totalPages = ceil($newsCount / $countPerPage);
        $newsArray = $newsRepository->getItemsByOffset($countPerPage, $newsStartIndex);
        $lastNews = $newsRepository->getLastItem();
        $currentPage = $page;
        require "views/newsIndexView.php";
    }

    public function show($id)
    {
        $db = new Database();
        $newsRepository = new NewsRepository($db);
        $news = $newsRepository->getById($id);
        $date = date("d.m.Y", strtotime($news->getDate()));
        require "views/newsView.php";
    }
}