<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "testreact";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $sql = "INSERT INTO users (fullname, email, phone, birthday, gender, password, address) VALUES ('$fullname', '$email', '$phone', '$birthday', '$gender', '$password', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array(
            "message" => "User registered successfully",
            "okkkk" =>  $fullname,

        ));
    } else {
        echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

$conn->close();
