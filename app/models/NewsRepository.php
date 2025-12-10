<?php

namespace App\Models;

use PDO;

use App\Models\Repository;
use App\Core\Database;

class NewsRepository extends Repository
{   
    public function getItemsByOffset(int $count, int $startIndex = 0): false|array
    {
        $newsItems = [];
        $sql = "";
        $items = [];
        if ($startIndex === 0) {
            $sql =  "SELECT * FROM `news` ORDER BY `date` DESC LIMIT :count OFFSET 0";
            $items = parent::getByQuery($sql, ['count' => $count]);
        } else {
            $sql = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT :count OFFSET :startIndex";
            $items = parent::getByQuery($sql, ['count' => $count, 'startIndex' => $startIndex]);
        }
        foreach ($items as $row) {
            $newsItem = new News($row);
            $newsItems[] = $newsItem;
        }
        return $newsItems;
    } 

    public function getById(int $newsId)
    {
        $sql = "SELECT * FROM `news` WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $newsId);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        return new News($item);
    }

    public function getCount(): int 
    {
        $sql = "SELECT COUNT(*) FROM `news` ORDER BY `date` DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getLastItem()
    {
        $sql = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        return new News($item);
    }
}