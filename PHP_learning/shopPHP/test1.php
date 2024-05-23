<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>test 1</title>
</head>
<body>
   <?php
      // $n = 0;
      // $a = 1;
      // echo ($a == 0) ?' Duong' : 'Am';
      // echo '<br>';
      // $a =2;
      // for ($i =0;$i <=$a; $i++):
         // 
         // <ul>
         //    <li>1</li>
         //    <li>2</li>
         //    <li>3</li>
         //    <li>4</li>
         // </ul> -->
         // 
      // endfor; 
      // do{
      //    echo $n .'<br>'; 
      //    // test break; 
      //    if ( $n == 5){
      //       break;
      //    } 
      //    $n ++;
         
      // }while($n <= 10);
      // function sumadd ($a,$b) {
      //    $sum =  $a + $b;
      //    return $sum;
      //    }
      // $po = 10;
      // $pi = 8;
      // $bienTong =  sumadd($po,$pi);
      // echo $bienTong.'<br>';
   
      // function doCount(){
      //    static $pu  = 1;
      //    $pu ++;  
      //    echo $pu.'<br>';
      // }
      // doCount();
      // doCount();
      // doCount();
      // doCount();
      // doCount();
      // doCount();
      // // fibonacci de quy
      // function fibonacci($n){
      //    if ($n == 0 || $n ==1){
      //       return $n;
      //    }
      //    return fibonacci($n -1 ) + fibonacci($n - 2);
      // }
      // $result = fibonacci(9);
      // echo 'de quy cua 5 la :'. $result .'<br>';
      // // kiem tra xem bien co ton tai hay khong 
      // $pt = 'Minh Quang';
      // if(isset($pt)){
      //    echo $pt.'<br>';
      // }
      // if (empty($pt)){
      //    echo $pt.'<br>';
      // }
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
     print_r($arr);
      



   ?>
</body>
</html>