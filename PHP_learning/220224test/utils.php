<?php 
function dd($var){
   echo '<pre>';
   var_dump($var);
   echo '<pre>';
};
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