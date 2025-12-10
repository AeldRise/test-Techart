<?php
namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        require_once "views/indexView.php";
    }
}