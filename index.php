<?php
// echo "<pre>";


// print_r($_POST);

// echo "</pre>";

// $email = $_POST['email'];

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

<body>

  <nav class = "split left">
  <nav class="navbar">
    <div id="logo">
      <a href="/">
        <!-- <img src="img/logo_pineapple_mobile.svg" alt="pineapple_logo"> -->
        <div class="image"></div>
      </a>
    </div>

    <div class = "navbar-links">
      <ul>
          <li><a href="#" class="menu-item">About</a></li>
          <li><a href="#" class="menu-item">How it works</a></li>
          <li><a href="#" class="menu-item">Contact</a></li>
      </ul>
    </div>
  </nav>

  <div id="container">

    <div id="main">
    <h1>Subscribe to newsletter</h1>
    <p>Subscribe to our newsletter and get 10% discount on pinapple glasses.</p>


    <!-- FORM -->
    <form id="form" action="index.php" method="POST">
      <div class="inputarea">
        <input id="email" type="email" placeholder="Type your email address here..." name="email">
        <button type="submit" id="emailSubmit"></button>
      </div>
      
      <div id="error"></div>
      <div id="termsError"></div>
    
    <div class="termsarea">

      <label class="terms" for="termsCheckbox">
        <input id="termsCheckbox" type="checkbox" name="terms" id="terms" value="checked">
        <span class="checkmark"></span>
        I agree to <a href="#">terms of service</a>
      </label>
    </div>

    </form>

  </div>

    <!-- SOCIALS -->
    <div id = "socials">
      <div class="container">
        <a href="#" class="icon icon-ic_facebook"></a>
        <a href="#" class="icon icon-ic_instagram"></a>
        <a href="#" class="icon icon-ic_twitter"></a>
        <a href="#" class="icon icon-ic_youtube"></a>
      </div>

    </div>
  </nav>

  <nav class="split right">
  </nav>

  </div>




  <script src="js/main.js"></script>

</body>

</html>
