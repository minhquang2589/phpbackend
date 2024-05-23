<?php 
include "utils.php";
$host = "localhost";
$username = "root";
$password = "";
$connect = new mysqli($host, $username, $password);

$sql = "CREATE DATABASE IF NOT EXISTS testdatabase";
$connect -> query($sql);
$sql = "USE MyDatabases";
$connect -> query($sql);

$sql = "DROP DATABASE ";
$connect -> query($sql);



?>