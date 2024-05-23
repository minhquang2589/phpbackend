<?php 
function dd($var){
   echo '<pre>';
   var_dump($var);
   echo '<pre>';
};
function sanitizer ($var){
   $var = trim($var);
   $var = htmlspecialchars($var);
   return $var;
}