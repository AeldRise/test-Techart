<?php

namespace models;
require_once "models/News.php";
use PDO;

class NewsRepository
{
    private $connection;
    public function __construct(PDO $connection){
        $this->connection = $connection;
    }
    public function getManyNews(int $startIndex, int $count): false|array
    {
        $newsItems = [];
        $sql = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT {$startIndex}, {$count}";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $newsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($newsArray as $row) {
            $newsItem = new News($row['id'],$row['date'],$row['title'],$row['announce'], $row['content'],$row['image']);
            $newsItems[] = $newsItem;
        }
        return $newsItems;
    }
    public function getNewsById(int $newsId){
        $sql = "SELECT * FROM `news` WHERE `id` = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $newsId);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        return new News($item['id'],$item['date'],$item['title'],$item['announce'],$item['content'],$item['image']);
    }

    public function getNewsCount(): int {
        $sql = "SELECT COUNT(*) FROM `news` ORDER BY `date` DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();

    }
    public function getLastNews(){
        $sql = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        return new News($item['id'],$item['date'],$item['title'],$item['announce'],$item['content'],$item['image']);
    }

}