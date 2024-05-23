<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Buoi 1 php</title>
</head>
<style>
      .formLogin{
         height: 500px;
         width: 200px;
      }
</style>
<body>
   <?php 
   echo 'Bài 1: Bạn hãy tách các ký tự số của một số nguyên dương'.'<br>';
      $ramdom = rand(1,1000);
      $StrRandom = (string)$ramdom;
      $mb = mb_str_split($StrRandom);
      foreach($mb as $values){
         echo $values.',';
      }
   echo'<br>';
   echo 'Bài 2: Viết chương trình tung đồng xu';
   echo'<br>';
      $RDCoin = rand(0,1);
      if ($RDCoin == 1){
         echo'mặt sấp  '.'<br>';
         }else {
            echo 'mặt ngửa'.'<br>';
         }
   echo ' Bài 3: Định nghĩa ra một mảng 2 chiều';
      $person = array (
         $index = null,
         $associativeArray1 = array (
            'Name' => 'Ngo Minh A',
            'Age' => 21,
            'Gender' => true,
            'mark' => 6.3
         ),
         $associativeArray2 = array (
            'Name' => 'Ngo Minh B',
            'Age' => 22,
            'Gender' => false ,
            'mark' => 7.3
         ),
         $associativeArray3 = array (
            'Name' => 'Ngo Minh C',
            'Age' => 23,
            'Gender' => true,
            'mark' => 8.3
         )
      );
   echo'<br>';
   echo ' Bài 4:sử dụng class để định nghĩa đối tượng sinh viên';
   echo'<br>';
      class Student {
         public $name;
         public $age;
         public $gender;
         public $mark;

            public function __construct ($name, $age,$gender,$mark){
               $this -> name = $name;
               $this -> age = $age;
               $this -> gender = $gender;
               $this -> mark = $mark;
            }
      };
      $studentCL = array (
         new Student  ('Ngo Minh A',21,true,6.8),
         new Student  ('Ngo Minh B',22,false,7.8),
         new Student  ('Ngo Minh C',23,true,8.8)
      );
      echo'<pre>';
      for ($i=0; $i<=count($studentCL); $i++){
         echo '<tr>
                  <td>'.'Name: '.$studentCL[$i]->name.'</td>
                  <td>'.'Age: '.$studentCL[$i]->age.'</td>
                  <td>'.'Gender: '.$studentCL[$i]->gender.'</td>
                  <td>'.'Mark: '.$studentCL[$i]->mark.'</td>
               </tr>';
      };
      echo'<br>';
      echo 'Bài 5: form handling Điểm trung bình:';
      echo'<br>';
      ?>
   <!-- <form action="" method="post">
      <label for="number1">Input Number 1:</label>
      <input type="number" name="number1">
      <label for="number2">Input Number 2:</label>
      <input type="number" name="number2" >
      <label for="number3">Input Number 3:</label>
      <input type="number" name="number3">
      <input type="submit" name="values" value="SEND">
   </form> -->
   <?php
   //    if(isset($_POST['values'])) {
   //       if(isset($_POST['number1'])) {
   //          $score1 = floatval($_POST['number1']);
   //      } else {
   //          $score1 = 0;
   //      }
        
   //      if(isset($_POST['number2'])) {
   //          $score2 = floatval($_POST['number2']);
   //      } else {
   //          $score2 = 0;
   //      }
        
   //      if(isset($_POST['number3'])) {
   //          $score3 = floatval($_POST['number3']);
   //      } else {
   //          $score3 = 0;
   //      }
   //    }
   //    $average = ($score1 + $score2 + $score3) / 3;
   //    echo '<p>Điểm trung bình: ' . number_format($average, 2) . '</p>';
   // //
   // echo'Bài 6: ính tổng số nguyên chẵn tử 1 -> n : ';
   ?>
   <form action="" method="post">
      <label for="InputNumber" >Input Number :</label>
      <input type="number" name ="InputNumber"  id="InputNumber">
      <input type="submit" name="InputNumber1" value="SEND">
   </form>
   <?php
      $sochan = null;
      $total  = 0;
      if(isset($_POST['InputNumber1'])){
         $number2 = $_POST['InputNumber'];
         
         for($i = 0; $i <= $number2; $i+=2){
            if($i %2 == 0){
               $total += $i.',';
            }
         }
         echo'<br>';
         echo 'tổng số nguyên chẵn là :'. $total ;
         echo'<br>';
      }else {
         echo'<br>';
         echo 'tổng số nguyên chẵn là : 0';
         echo'<br>';
      }

      echo'<br>';
   echo'Bài 7:Xác định số phần tử của chuỗi';
   echo'<br>';
   echo'Bài 8 : Xác định thời gian cách đây 29 ngày và in ra : ';
   echo'<br>';
   $date = date('Y-m-d');
   $dateQK = date('Y-m-d', strtotime($date . ' - 29 days'));
   echo 'Ngày hiện tại :'. $date;
   echo'<br>';
   echo 'Trước 29 ngày là ngày :'. $dateQK;
   echo'<br>';
   echo'Viết PHP để lấy thông tin cấu hình và phiên bản của PHP ';
   phpinfo();
echo'<br>';
echo'Viết PHP script để in một chuỗi cho trước (sử dụng print và echo)'.'<br>';
   $EchoAndPrintf = 'Đây là chuỗi';
   echo $EchoAndPrintf;
   echo'<br>';
   print_r($EchoAndPrintf);
   echo'<br>';
echo'Viết PHP script để tạo một form đơn giản để nhận và hiển thị tên đăng nhập.'.'<br>';
 ?>
   <form class=""  method="post">
      <label for="username" >Username :</label>
      <input type="text"  name ="username">
      <input type="submit" name ="submit"  value="SEND">
   </form>
 <?php 

   // if (isset($_POST('submit'))){
   //    $username = $_POST('username');
   //    echo $username;
   // }
 ?>
</body>
</html>