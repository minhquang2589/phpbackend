<?php 
function dd($var){
   echo '<pre>';
   var_dump($var);
   echo '<pre>';
};
function santize ($var){
   $var = htmlspecialchars($var);
   $var = trim($var);
   $var = stripslashes($var); 
   return $var;
}
function randompass (){
   $salt = 'qwertyuiopasdfghjklzxcvbnm23456789';
   $count = strlen($salt);
   $i = 0;
   $Password = '';
   while ($i < 8){
      $num = rand(0, $count -1);
      $tmp = substr($salt, $num , 1);
      $Password = $Password .$tmp;
      $i ++;
   }
   return $Password;
}