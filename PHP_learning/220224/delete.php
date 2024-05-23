<?php
require_once 'connect.php';
require_once 'utils.php';
$error = [];

if (isset($_SERVER['QUERY_STRING'])) {
   $id = $_SERVER['QUERY_STRING'];

   $sqlDeleteProducts = "DELETE FROM products WHERE $id";
   try {
      $install->getConnect()->query($sqlDeleteProducts);
      $sqlDeleteProductCate = "DELETE FROM productcate WHERE id = (SELECT Cate_id FROM products WHERE $id)";
      try {
         $install->getConnect()->query($sqlDeleteProductCate);
         header('location: listproduct.php');
      } catch (Exception $a) {
         $error[] = $a->getMessage();
      }
   } catch (Exception $a) {
      $error[] = $a->getMessage();
   }
}
?>
