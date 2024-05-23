<?php
include 'utils.php';
dd($_FILES);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required>
         <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone">
         <br>
        <label for="email">Email:</label>
        <input type="email" name="email">
         <br>
        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" accept="image/jpeg, image/png, image/jpg">
         <br>
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
