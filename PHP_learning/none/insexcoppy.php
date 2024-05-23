<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <?php 
   // bat thong bao ve loi:
   ini_set('display_errors','1');
   ini_set('display_start_errors','1');
   error_reporting(E_ALL);
   include 'require.php';
   echo 'require php done';
   echo '<br>';
   // ham chuyen doi chuoi thanh mang
   $ar = 'hoc | lap | trinh';
   $br =  explode('|',$ar); 
   var_dump ($ar);
   echo  '<br>';
   var_dump ($br);
   echo '<br>';
   // ham chuyen doi mang thanh chuoi
   $cr = implode(' ',$br);
   var_dump ($cr);
   echo '<br>';
   echo $cr;
   echo '<br>';
   var_dump($cr);
   echo '<br>';
   // ham dem so luong ky tu trong chuoi
   echo strlen($cr); 
   echo '<br>';
   // ham dem so luong chu trong chuoi 
   echo str_word_count($cr); 
   echo '<br>';
   // ham lap lai chuoi n lan
   echo str_repeat($cr,3);
   echo '<br>';
   // ham sua ky tu trong chuoi
   $dr = 'Minh Quang Dep Trai';
   echo str_replace(' ',' | ',$dr);
   echo '<br>';
   // ham mp5 va sha1 ma hoa ky tu. md5 ma hoa 15 ky tu, sha1 40 ky tu.
   echo md5($dr); 
   echo '<br>';
   echo sha1($dr);
   echo '<br>';
   // ham hien thi html (co ca strips code ).
   echo htmlentities('<ul type = none > <li>html </li></ul>');
   echo '<br>';
   // ham htmlentities hien thi html khong bao gom strips code 
   $html = htmlentities('<ul type = none> <li>html </li></ul>');
   echo html_entity_decode($html);
   echo '<br>';
   // ham strip_tags loai bo tag html
   echo strip_tags ('<ul type = none > <li>html </li></ul>');
   echo '<br>';
   // ham substr cat bo chuoi 
   $hr = 'aptech learning ';
   $jr = substr($hr,7,8);
   echo $jr;
   echo '<br>';
   // ham strtolower chuyen doi tat  ca chu hoa thanh chu thuong
   echo strtolower ($dr);
   echo '<br>';
   // ham strtoipper chuyen doi tat ca chu thuong thsnh chu hoa 
   echo strtoupper ($dr);
   echo '<br>';
   // ham ucfrist thay doi chu cai dau tien cua mang thanh viet hoa
   echo ucfirst($hr);
   echo'<br'; 
   echo lcfirst ($hr) .'<br>';
   // ham ucword thay doi tat ca chu cai dau tien trong mang thanh viet hoa 
   echo ucwords($hr) .'<br>';
   $kr  = 'k qUang k';
   // ham trim loai bo ky tu trong chuoi 
   echo trim($kr,'k').'<br>'; 
   echo 'bài tập lấy 5 ký tự cuối cùng trong mảng :'.'<br>';
   $bt1 = 'Ngo Minh Quang';
   $bt1p = substr($bt1, -5);
   echo '5 ký tự cuối cùng là: ' .$bt1p.'<br>';;

   echo '<br>';
   $name1 = 200;
   var_dump ($name1). '<br>' ;

   $test1 =433;
   $test2 = 4;
   $test3 = $test1 + 2 * ($test2);
    echo $test1. '<br>' ;
    echo 'bien 3 =  '. $test3. '<br>' ;


   // 
   $test4 = 4;
     ++ $test4;
   echo $test4.'<br>' ;
   if ($test4 > 6){
      echo 'lon hon 6';
   }else {
      echo 'nho hon 6'.'<br>';
   }
   // 
   echo 'switch case test :'.'<br>';
   $test5  = 93939;
   switch ($test5) {
      case 1:
         if ($test5 = 1){
            echo 'yes'.'<br>';
         }
      break;
      case 2:
         if ($test5 = 2){
            echo 'yes'.'<br>';
         }
      break;
      case 3:
         if ($test5 = 3){
            echo 'yes'.'<br>';
         }
         break;
      case 4:
         if ($test5 = 4){
            echo 'THU 4'.'<br>';
         }
      break;
      default:
         echo 'THU 5'.'<br>';
      break;
   }
   // test for 
   echo 'Test FOR :'.'<br>';
   for ($i = -3; $i < 0 ; $i++){
      echo $i.'<br>';
   }
   
   // test chan le
   echo 'chan le :'.'<br>';
   $min = 0;
   $max = 30;
   $demsochan = 0;
   $demsole = 0;
   $sochan = null;
   $sole = null;

   for ( $i = $min ; $i <= 100 ; $i ++){
      if($i %2 ==0){
         $sochan.=$i . ',';
         $demsochan ++;
      } else {
         $sole.= $i.',';
         $demsole ++;
      }
   }
   echo 'tim duoc '.$demsochan.' so chan,'.' so chan la :'.$sochan .'<br>';
   echo 'tim duoc '.$demsole.' so le,'.' so le la :'.$sole .'<br>';
   //  tinh giai thua 
   $n = 5;
   if ($n >= 0) {
      $result = 1;
      for ($i = 1; $i < $n ; $i++){
         $result *= $i ;
      }
      echo $result .'<br>';  
   }
   // while and do while
   $n = 0;
   $result = 0;
   while($n < 10){
      $n ++;
      // test continue;
      if ( $n == 5){
         continue;
      } 
      if ( $n == 6){
         continue;
      } 
      echo $n .'<br>';  
   }

   // exit('dung chuong trinh tai day');  
   // die('dung chuong trinh tai day');  
   // 
   $n = 0;
   $a = 1;
   echo ($a == 0) ?' Duong' : 'Am';
   echo '<br>';
   $a =2;
   for ($i =0;$i <=$a; $i++):
      ?>
      <ul>
         <li>1</li>
         <li>2</li>
         <li>3</li>
         <li>4</li>
      </ul>
     <?php 
   endfor; 
   do{
      echo $n .'<br>'; 
      // test break; 
      if ( $n == 5){
         break;
      } 
      $n ++;
      
   }while($n <= 10);
   function sumadd ($a,$b) {
      $sum =  $a + $b;
      return $sum;
      }
   $po = 10;
   $pi = 8;
   $bienTong =  sumadd($po,$pi);
   echo $bienTong.'<br>';

   function doCount(){
      static $pu  = 1;
      $pu ++;  
      echo $pu.'<br>';
   }
   doCount();
   doCount();
   doCount();
   doCount();
   doCount();
   doCount();
   // fibonacci de quy
   function fibonacci($n){
      if ($n == 0 || $n ==1){
         return $n;
      }
      return fibonacci($n -1 ) + fibonacci($n - 2);
   }
   $result = fibonacci(9);
   echo 'de quy cua 5 la :'. $result .'<br>';
   // kiem tra xem bien co ton tai hay khong 
   $pt = 'Minh Quang';
   if(isset($pt)){
      echo $pt.'<br>';
   }
   if (empty($pt)){
      echo $pt.'<br>';
   }
   // mảng.
   // in mang
   $arr = array('number 0' =>'html','number 1' =>'php','number 2' =>'pyton');
   $arr1 =     ['number 0' =>'html','number 1' =>'php','number 2' =>'pyton' ];
   echo'<br>'; 
   print_r($arr); 
   echo'<br>';
   print_r($arr1);
   // them phan tu vao mang
   $arr['nember 4' ] = 'Javascript';
   array_push($arr);
   echo'<br>'; 
   print_r($arr); 
   echo'<br>';  
   // sua mang
   $arr1['numbe 4'] = 'SQL';
   array_push($arr1);
   print_r($arr1);
   echo'<br>'; 
   $arr['number 0'] = 'C++'; 
   //  xoa phan tu trong mang;
   unset($arr['number 0']);
   //  doc mang 
   $inmang = $arr1['number 2'];
   echo $inmang;
   echo'<br>'; 
   //  doc mang 
   echo'<br>'; 
   echo 'mang $arr1 :'. '<br>';
   if (!empty($arr1)){
      foreach ($arr1 as $value) {
          echo $value . '<br>';
      }
  }
  echo'<br>'; 
  echo 'mang $arr :'. '<br>';
  if (! empty($arr)){
   foreach($arr as $value){
      echo $value. '<br>';
   }
  }
  //dem so luong phan tu co trong mang
  echo count($arr). '<br>';
  $arrayValue = array_values($arr1);
  print_r($arrayValue) . '<br>';
  echo'<br>'; 
  // hien thi key (so thu tu goc) trong mang
  $arrayKey = array_keys ($arr);
  print_r($arrayKey) . '<br>';
  // hien thi ten da dinh danh trong mang
  $arrayPop = array_pop($arr);
  print_r($arrayPop). '<br>';
  echo'<br>'; 
  // is_array kirm tra xem co phai mang hay khong 
  echo is_array($arr1);
  //
  $result = array_push($arr1,'ngo','minh','quang');
  echo'<br>'; 
  echo $result ;
  echo'<br>'; 
  array_shift($arr);
  echo'<br>'; 
  print_r($arr);
  echo'<br>'; 
  array_unshift($arr1, 'ngo','minh','quang');
  echo'<br>'; 
  print_r($arr1);

   



   ?>
</body>
</html>