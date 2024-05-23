<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$connect = new mysqli($host, $user, $pass);

if (!$connect) {
    echo 'connect failed';
} else {
    $sql = "CREATE DATABASE IF NOT EXISTS QLSV";
    $connect->query($sql);

    $sql = "USE QLSV";
    $connect->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS User (
        id INT PRIMARY KEY AUTO_INCREMENT,
        Username VARCHAR(50),
        Password VARCHAR(50),
        FullName VARCHAR(50) NULL,
        Email VARCHAR(60),
        Phone VARCHAR(20) NULL
    );";

    try {
        $connect->query($sql);
    } catch (Exception $a) {
        echo 'Error: ' . $a->getMessage();
    }

    $sql = "CREATE TABLE IF NOT EXISTS Class (
        id INT PRIMARY KEY AUTO_INCREMENT,
        Class_Name VARCHAR(30)
    );";

    try {
        $connect->query($sql);
    } catch (Exception $a) {
        echo 'Error: ' . $a->getMessage();
    }

    $sql = "CREATE TABLE IF NOT EXISTS Students (
        id INT PRIMARY KEY AUTO_INCREMENT,
        Name VARCHAR(50),
        Birthday DATE,
        Gender INT,
        Classid INT,
        FOREIGN KEY (Classid) REFERENCES Class(id)
    );";

    try {
        $connect->query($sql);
    } catch (Exception $a) {
        echo 'Error: ' . $a->getMessage();
    }

    $sql = "CREATE TABLE IF NOT EXISTS Subjects (
        id INT PRIMARY KEY AUTO_INCREMENT,
        Name VARCHAR(50)
    );";

    try {
        $connect->query($sql);
    } catch (Exception $a) {
        echo 'Error: ' . $a->getMessage();
    }

    $sql = "CREATE TABLE IF NOT EXISTS StudentSubject (
        id INT PRIMARY KEY AUTO_INCREMENT,
        StudentID INT,
        SubjectID INT,
        FOREIGN KEY (StudentID) REFERENCES Students(id),
        FOREIGN KEY (SubjectID) REFERENCES Subjects(id)
    );";

    try {
        $connect->query($sql);
    } catch (Exception $a) {
        echo 'Error: ' . $a->getMessage();
    }
}
?>
