<?php
include 'connect.php';
include 'utils.php';

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
           $id = 'id ='.$id;
           $classid = $id;
       }
   }
   $sql = "SELECT * FROM StudentSubject";
   try{
      $result = $connect -> Query($sql);
      $sql = "DELETE FROM StudentSubject WHERE $StudentID";
      try{
         $connect -> Query($sql);
         $sql = "SELECT * FROM Students";
         try{
            $connect -> query($sql);
            $sql = "DELETE FROM Students WHERE $id";
            try{
               $connect -> query($sql);
               $sql = "SELECT * FROM Class WHERE $id ";
               $connect -> Query($sql);
               $sql = "DELETE FROM Class WHERE id = (SELECT Classid FROM Students WHERE Classid =  $classid )";
               try{
                  $connect -> Query($sql);
                  header('location: index.php');
               }catch(exception $a){
                  echo 'Error: '.$a->getMessage();
               }
            }catch(exception $a){
            echo 'Error: '.$a->getMessage();
         }
         }catch(exception $a){
            echo 'Error: '.$a->getMessage();
         }
      }catch(Exception $a){
         echo 'Error: '.$a->getMessage();
      }
   }catch(Exception $a){
      echo 'Error: '.$a->getMessage();
   }
}

?>