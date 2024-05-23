<?php
// $host = "localhost";
// $user = "root";
// $pass = "";

// $conn  = new mysqli($host, $user, $pass);


class Install{
    private $host ="localhost";
    private $user = "root";
    private $pass = "";
    private $conn = null;

    public function __construct(){
        $this->conn  = new mysqli($this->host, $this->user, $this->pass);

        // $this->createDatabase();
        // $this->createTableUsers();
    }

    public function createDatabase(){
        $sql = "CREATE DATABASE IF NOT EXISTS qlsv";
        if ($this->conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $this->conn->error;
        }
        $this->conn->select_db("qlsv");
    }

    public function createTableUsers(){
        $sql = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL unique,
            password VARCHAR(40) NOT NULL,
            email VARCHAR(50) not null unique,
            phone VARCHAR(15),
            fullname VARCHAR(50)
        )";
        if ($this->conn->query($sql) === TRUE) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function createTableClasses(){
        $sql = "CREATE TABLE classes (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL
        )";
        if ($this->conn->query($sql) === TRUE) {
            echo "Table classes created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function createTableStudents(){
        $sql = "CREATE TABLE students (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            birthday DATE,
            gender int,
            class_id int(6) unsigned
        )";
        if ($this->conn->query($sql) === TRUE) {
            echo "Table students created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function createTableSubjects(){
        $sql = "CREATE TABLE subjects (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL
        )";
        if ($this->conn->query($sql) === TRUE) {
            echo "Table subjects created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function createTableStudentSubject(){
        $sql = "CREATE TABLE student_subject (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            student_id int(6) unsigned,
            subject_id int(6) unsigned
        )";
        if ($this->conn->query($sql) === TRUE) {
            echo "Table student_subject created successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }

    public function addForeignKey(){
        $sql = "ALTER TABLE students
        ADD FOREIGN KEY (class_id) REFERENCES classes(id)";
        if ($this->conn->query($sql) === TRUE) {
            echo "Add foreign key successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }

        $sql = "ALTER TABLE student_subject
        ADD FOREIGN KEY (student_id) REFERENCES students(id)";
        if ($this->conn->query($sql) === TRUE) {
            echo "Add foreign key successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }

        $sql = "ALTER TABLE student_subject
        ADD FOREIGN KEY (subject_id) REFERENCES subjects(id)";
        if ($this->conn->query($sql) === TRUE) {
            echo "Add foreign key successfully";
        } else {
            echo "Error creating table: " . $this->conn->error;
        }
    }
}

$install = new Install();
$install->createDatabase();
$install->createTableUsers();
$install->createTableClasses();
$install->createTableStudents();
$install->createTableSubjects();
$install->createTableStudentSubject();
$install->addForeignKey();