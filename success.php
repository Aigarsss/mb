<?php

require 'Model.php';
$model = new Model();
$insert = $model->insert();

?>

<!doctype html>
<html lang="">

<head>
  <meta charset="utf-8">
  <title>Pineapple Inc</title>
  <meta name="description" content="Buy your pineapple sunglasses here">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="body-container">

  <div class = "main-container">
    
    <nav class="navbar">
      <div class="navbar__logo">
        <a href="/" class="navbar__image-link">
          <div class="navbar__image"></div>
        </a>
      </div>

      <div class = "navbar__items">
        <ul class = "navbar__items__list">
            <li class = "navbar__items__list__item"><a href="/subscribers.php" class="navbar__items__list__item__link">About</a></li>
            <li class = "navbar__items__list__item"><a href="#" class="navbar__items__list__item__link">How it works</a></li>
            <li class = "navbar__items__list__item"><a href="#" class="navbar__items__list__item__link">Contact</a></li>
        </ul>
      </div>
    </nav>

      <div class="subscribe-container">

        <div class="subscribe">
          
          <div id='successIcon'></div>
          <h1 class="subscribe__heading">Thanks for subscribing!</h1>
          <p class="subscribe__text">You have successfully subscribed to our email listing. Check your email for the discount code.</p>
          <br>

          <!-- SOCIALS -->
          <div class = "socials">
            <div class="socials__container">
              <a href="#" class="icon icon-ic_facebook"></a>
              <a href="#" class="icon icon-ic_instagram"></a>
              <a href="#" class="icon icon-ic_twitter"></a>
              <a href="#" class="icon icon-ic_youtube"></a>
            </div>
          </div>

        </div>          
      </div>
  </div>


  <div class="background-container"></div>

  <script src="js/main.js"></script>

</body>

</html>
