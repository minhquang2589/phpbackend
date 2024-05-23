<?php
include 'connect.php';
include 'utils.php';
session_start();
if (!isset($_SESSION['User'])) {
    header('location: login.php');
    die();
   }else{
      if(isset($_SERVER['QUERY_STRING'])){
         $StudentID = $_SERVER['QUERY_STRING'];
         $str = $StudentID;
         $startPositionStudentID = strpos($str, "StudentID=");
         if ($startPositionStudentID !== false) {
            $substringStudentID = substr($str, $startPositionStudentID + strlen("StudentID="));
            $startPositionID = strpos($substringStudentID, "?id=");
            if ($startPositionID !== false) {
               $studentID = substr($substringStudentID, 0, $startPositionID);
               $StudentID = 'StudentID ='.$studentID;
               $id = substr($substringStudentID, $startPositionID + strlen("?id="));
               $id = $id;
            }
         }
      }

      if ($_SERVER['REQUEST_METHOD']=='POST'){
         $Fullname = $_POST['Fullname'];
         $Birthday = $_POST['Birthday'];
         $Gender = isset($_POST['Male']) ? 1 : 0;
         $Subject = isset($_POST['Toan']) ? 'Toan' : '';
         $Subject = isset($_POST['Ly']) ? 'Ly' : '';
         $Subject = isset($_POST['Hoa']) ? 'Hoa' : '';
         $Class = $_POST['Class'];

         $sql = "SELECT * FROM Students WHERE id = $id";
         $connect -> query($sql);
         $sql = "UPDATE Students SET Name = ?, Birthday = ?, Gender = ?, Classid = ( SELECT id FROM Class WHERE Class_Name = ? LIMIT 1) WHERE id = ?";
         $stmt = $connect->prepare($sql);
        try {
            $stmt->bind_param('ssisi', $Fullname, $Birthday, $Gender, $Class, $id);
            $stmt->execute();
            header('location: index.php');
        } catch (Exception $aa) {
            echo "Error: " . $aa->getMessage();
        }
    }
     
}

 ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Student</title>
 </head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <body>
   <h1>Update Student</h1>
   <form action="" method = "POST">
      <table>
         <tr>
            <td><label for="Name"  name="Fullname" id="Fullname">Fullname</label></td>
            <td><input type="text" for ="Fullname" name="Fullname" id="Fullname"></td>
         </tr>
         <tr>
            <td><label for="Birthday"  name="Birthday" id="Birthday">Birthday</label></td>
            <td><input type="date" for ="Birthday" name="Birthday" id="Birthday"></td>
         </tr>
         <tr>
         <td><label for="Gender"  name="Gender" id="Gender">Gender</label></td>
         <td><input type="radio"  for="Gender"  name="Male" id="Male" >Male</td>
         <td><input type="radio"  for="Gender"  name="Female" id="Female" >Female</td>
         </tr>
         <tr>
            <td><label for="Subject">Subject</label></td>
            <td><input type="checkbox" id="Toan" name="Toan">Toan</td>
            <td><input type="checkbox" id="Ly" name="Ly">Ly</td>
            <td><input type="checkbox" id="Hoa" name="Hoa">Hoa</td>
            <td><button  class="btn btn-success"><a  style="color: white; text-decoration: none" href="Addsubject.php">Add Subject</a></button></td>
         </tr>
         <tr>
            <td><label for="Class">Class</label>
                  <select name="Class" id="Class">
                  <option name = "C2307L" id="C2307L" for= "C2307L" value="C2307L">C2307L</option>
                  <option name = "C2308L" id="C2308L" for= "C2308L" value="C2308L">C2308L</option>
                  <option name = "C2309L" id="C2309L" for= "C2309L" value="C2309L">C2309L</option>
                  </select>
            </td>
            <td><button  class="btn btn-success"><a  style="color: white; text-decoration: none" href="addclass.php">Add Class</a></button></td>
         </tr>
         <tr>
            <td><button class="btn btn-success">Submit</button></td>
         </tr>
      </table>
   </form>
 </body>
 </html>