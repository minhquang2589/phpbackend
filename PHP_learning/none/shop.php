<?php
   include 'utils.php';
   $host = 'localhost';
   $username = 'root';
   $password = '';
   $database = 'productmanagement';
   $charset = 'utf8';
   try {
      $connect = new PDO("mysql:host=$host;dbname=$database;charset=$charset", $username, $password);  
      $sql = "SELECT * FROM `product`";
      $stmt = $connect->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
   }
   $sqlSelect = " SELECT * FROM `product`";
    $result = $connect  -> query($sqlSelect); 
    $product = $result -> fetchAll(PDO::FETCH_ASSOC); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> SHOP PHP</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Newsreader:ital,wght@1,500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Newsreader:ital,opsz,wght@0,6..72,500;1,6..72,500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,500&display=swap" rel="stylesheet">
<style link> </style>
<link rel="stylesheet" href="cartPHP.css">
<body>
   <div class=" homepage">
      <div class="boc">
         <header class="main-header">
            <div class="container">
               <div class="row">
                  <div class="col-2">
                     <div class=" logo">
                        <p> World Peas</p>
                     </div>
                  </div>
                  <div class="col-10">
                     <div class=" align-items-center d-flex flex-wrap justify-content-end">
                        <div class="menu">
                           <ul class="navi "  type = "none">
                              <li><a class="innavi" href=""> Shop</a> </li>
                              <li><a class="innavi" href=""> Newstand  </a> </li>
                              <li><a class="innavi" href="">  Who We Are </a> </li>
                              <li><a class="innavi"  > My Profile</a> </li>
                           </ul>
                        </div>
                        <div class="menubasket">
                              <button id="buttonincart" type="button" class=" bthd  btn btn-success " > Basket (0)</button>
                              <div id="listincart" class=" incart position-absolute">
                                 <div class="numbercart" id="numbercart2"> <h2>0 items in cart!</h2></div>
                                 <div class=" inforcart"> 
                                    <div><h5 class="numberitem"  id="infornumberitem" ></h5></div>
                                    <div id="inforcart" ></div>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header> 
      </div>
      <br>
      <div class="boc">
            <div class="container " >
               <div class="row">
                  <div class="col-5">
                     <div class=" banner ">
                           <h2 class="producee"> Produce</h2>
                           <span class="producee-2"> <strong class="">Fresh </strong> - dec 14.2023</span>  
                     </div>
                  </div>
                  <div class="col-7 justify-content-end ">
                     <div class=" lest ">
                        <div class="btn btn-success btn2 active cach-btn2 ">
                           Defaults
                        </div>
                        <div class="btn btn-success btn2 cach-btn2 ">
                           A - Z
                        </div>
                        <div class="btn btn-success btn2 cach-btn2  ">
                           <a class="listview" href="cart.html">List View</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </div>
      <br>
   <div class="boc">
      <div class="container">
         <div class="bocitem">
            <div class="row">
            <?php for ($i = 0; $i <count($product); $i++) : ?>
               <div class="col-4">
                  <div class="itempro">
                     <div class="imgitem">
                        <i class="bi bi-bag"><img src="bag.svg" ></i>
                        <img src="<?php echo $product[$i]["image"] ?>" alt="">
                     </div>
                     <div class="produceif">
                        <h2 class="produceif1"><?php echo $product[$i]["name"] ?></h2>
                        <span class="producegia"><?php echo $product[$i]["price"] ?> / ib</span>
                        <p class ="madein"><?php echo $product[$i]["madein"] ?></p>
                     </div>
                  </div>
               </div>
               <?php endfor; ?>
            </div>
         </div>
      </div>
   </div>
</div>
</body>
</html>