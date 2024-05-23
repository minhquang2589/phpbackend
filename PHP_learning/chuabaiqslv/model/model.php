<?php
class Model {
    protected $conn = null;
    protected $table = null;
    protected $columns = [];
    protected $primaryKey = "id";

    public function __construct(){
        $this->conn = (new Connection)->getConn();
    }

    public function create($data){
        $columns = implode(", ", $this->columns);
        $values = implode("', '", $data);
        $sql = "INSERT INTO $this->table ($columns) VALUES ('$values')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function all(){
        $sql = "SELECT * FROM $this->table";
        $result = $this->conn->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function find($id){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = $id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function update($id, $data){
        $set = '';
        foreach($data as $key => $value){
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ", ");
        $sql = "UPDATE $this->table SET $set WHERE $this->primaryKey = $id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = $id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}