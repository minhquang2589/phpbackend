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