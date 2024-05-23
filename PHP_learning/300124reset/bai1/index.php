
<?php
require_once 'connect.php';
require_once 'utils.php';
session_start();

if (!isset($_SESSION['User'])) {
    header('location: login.php');
    die();
} else {
   $sql = "SELECT * FROM Students";
   $result1 = $connect->query($sql);
   $sql = "SELECT * FROM Class ";
   $result2 = $connect->query($sql);
   $sql = "SELECT * FROM Subjects ";
   $result3 = $connect->query($sql); 
}
?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>QLSV</title>
 </head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <body>
   <h1>QLSV</h1>
   <button style="border: 0px; padding: 0px 0px 0px 0px;" ><a class="btn btn-danger" style=" color: white; text-decoration: none"  href="logout.php">Logout</a></button>
   <button style="border: 0px; padding: 0px 0px 0px 0px;"  ><a class="btn btn-success" style="color: white; text-decoration: none"  href="addstudent.php">Add Student</a></button>
   <table>
      <tr>
         <th>Name</th>
         <th>Class</th>
         <th>Birthday</th>
         <th>Gender</th>
         <th>Subject</th>
         <th>update</th>
      </tr>
      <?php
      if ($result1 && $result2 && $result3) {
         while (($row1 = $result1->fetch_assoc()) && ($row2 = $result2->fetch_assoc()) && ($row3 = $result3->fetch_assoc())) {
            if ($row1['Gender'] == 1){
               $row1['Gender'] = 'Male';
            }else {
               $row1['Gender'] = 'Female';
            }
             echo '<tr>';
             echo '<td>' . $row1['Name'] . '</td>';
             echo '<td>' . $row2['Class_Name'] . '</td>';
             echo '<td>' . $row1['Birthday'] . '</td>';
             echo '<td>' . $row1['Gender'] . '</td>';
             echo '<td>' . $row3['Name'] . '</td>';
             echo '<td class="btn btn-danger mt-1 "><a onclick ="confirmDelete(event)" style="color: white; text-decoration: none"   href="delete.php?StudentID=' .$row1['id'].'?id='.$row1['id']. '">Delete</a></td>';
             echo '<td class="btn btn-success mt-1"><a style="color: white; text-decoration: none" href="update.php?StudentID=' .$row1['id'].'?id='.$row1['id']. '">Edit</a></td>';
             echo '</tr>';  
         }
     }
   ?>  
   </table>
 </body>
 </html>