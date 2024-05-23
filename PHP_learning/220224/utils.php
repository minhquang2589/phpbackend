<?php 
function dd($var){
   echo '<pre>';
   var_dump($var);
   echo '<pre>';
}
function santize ($var){
   $var = htmlspecialchars($var);
   $var = trim($var);
   $var = stripslashes($var); 
   return $var;
}
?>
<script>
   function confirmDelete(event){
      event.preventDefault();
      let cf = confirm ("Are you sure you want Delete");
      if (cf){
         let url = event.currentTarget.getAttribute("href");
         window.location.href = url;
      }
   }
</script>