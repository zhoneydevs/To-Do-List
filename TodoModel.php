<?php 

class TodoModel {

    private $id;
    private $name;
    private $user;
    private $done;
    private $created;

    function __construct($id, $name, $user, $done, $created)
    {
        $this->id = $id;
        $this->name = $name;
        $this->user = $user;
        $this->done = $done;
        $this->created = $created;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getUser(){
        return $this->user;
    }
    
    
    public function getDone(){
        return $this->done;
    }

    public function getCreated(){
        return $this->created;
    }
    
    

    
}