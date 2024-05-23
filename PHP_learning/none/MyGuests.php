<?php

include "utils.php";
class MyGuests {
   public $table = 'myguests';
   public $id;
   public $firstname;
   public $lastname;
   public $email;
   public $reg_date;

   public function __construct( $id = null, $firstname = null, $lastname = null, $email = null){
      $this -> id = $id;
      $this -> firstname = $firstname;
      $this -> lastname = $lastname;
      $this -> email = $email;
   }
}


 ?>