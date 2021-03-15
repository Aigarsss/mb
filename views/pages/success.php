<?php 
include("views/inc/header.inc.php");
?>

  <div class = "main-container">
    
    <nav class="navbar">
      <div class="navbar__logo">
        <a href="/" class="navbar__image-link">
          <div class="navbar__image"></div>
        </a>
      </div>

      <div class = "navbar__items">
        <ul class = "navbar__items__list">
            <li class = "navbar__items__list__item"><a href="/pages/subscribers" class="navbar__items__list__item__link">About</a></li>
            <li class = "navbar__items__list__item"><a href="#" class="navbar__items__list__item__link">How it works</a></li>
            <li class = "navbar__items__list__item"><a href="#" class="navbar__items__list__item__link">Contact</a></li>
        </ul>
      </div>
    </nav>

      <div class="subscribe-container">

        
        <div class="subscribe">
          <div  id="subscribe">

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

<?php 
include("views/inc/footer.inc.php");
?>