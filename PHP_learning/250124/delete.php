
<?php
      include 'config.php';
      include 'create.php';

      if (isset($_SERVER['QUERY_STRING'])){
      $sql = "SELECT * FROM Person";
      $result = $connect->query($sql);
      $product = $result->fetchAll(PDO::FETCH_ASSOC);
      $id = $_SERVER['QUERY_STRING'];
      $sql = "DELETE FROM Person WHERE $id";
      }
      try{
         $connect -> query($sql);
         header('location:'.'index.php');
      }catch(Exception $a){
         echo 'Delete Product FAIL!'.$a -> getMessage();
      }
?>
