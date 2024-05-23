<?php
class studentModel extends Model{
    public function __construct()
    {
        parent::__construct();
        $this->table = "students";
        $this->columns = ["name", "birthday", "gender", "class_id"];
    }
}