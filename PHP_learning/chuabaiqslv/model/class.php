<?php
class classModel extends Model{
    public function __construct()
    {
        parent::__construct();
        $this->table = "classes";
        $this->columns = ["name"];
    }
}