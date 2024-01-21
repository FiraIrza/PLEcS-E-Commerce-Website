<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./css/header.css"/>
  </head>
  <body>
    <div class="header">
      <div class="top-header">
        <!--Account-->
        <img class="line" src="./img/line.png" />
        <div class="account">
          <div class="button">
            <div class="icon-free"><div class="icon"><a href="login.php"><img src="./img/user.png"></div></div>
            </a>
          </div>
          <!--Cart-->
          <div class="button">
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i></a>
          </div>
        </div>
        <div class="logo">
        <a href="index.php">
        <img src="./img/logo header.png" alt="logo">
        </a>
        </div>
      </div>
      <div class="menu">
        <div class="item-menu"><div class="item"></div></div>
        <div class="item-menu"><div class="item"><a href="allProduct.php">All Products</a></div></div>
        <div class="item-menu"><div class="item"><a href="creamPuff.php">Cream Puffs</a></div></div>
        <div class="item-menu"><div class="item"><a href="drinks.php">Drinks</a></div></div>
        <div class="item-menu"><div class="item"><a href="aboutUs.php">About Us</a></div></div>
        <div class="item-menu"><div class="item"><a href="contactus.php">Contact Us</a></div></div>
        <div class="item-wrapper"><div class="item"></div></div>
      </div>
    </div>
  </body>
</html>

