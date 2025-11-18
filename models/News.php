<?php

namespace models;

class News
{
    private $id;
    private $date;
    private $title;
    private $announce;
    private $content;
    private $image;

    public function __construct($id, $date, $title, $announce, $content, $image){
        $this->id = $id;
        $this->date = $date;
        $this->title = $title;
        $this->announce = $announce;
        $this->content = $content;
        $this->image = $image;
    }
    public function getId(){
        return $this->id;
    }
    public function getDate(){
        return $this->date;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getAnnounce(){
        return $this->announce;
    }
    public function getContent(){
        return $this->content;
    }
    public function getImage(){
        return $this->image;
    }
}
