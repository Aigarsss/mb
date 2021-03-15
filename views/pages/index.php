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

            <h1 class="subscribe__heading">Subscribe to newsletter</h1>
            <p class="subscribe__text">Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>


            <!-- FORM -->
            <form id="form" action="" method="POST" class="subscribe__form">
              <div class="subscribe__form__inputarea">
                <input id="email" type="email" placeholder="Type your email address here..." name="email" class="subscribe__form__inputarea__input">
                <button name="submit" type="submit" id="emailSubmit" class="subscribe__form__inputarea__button"></button>
              </div>
              
              <div id="error">
                <?php 
                if (is_array($data["errors"])){
                  if (count($data["errors"]) > 0) {
                    foreach($data["errors"] as $error) {
                      echo $error . " <br>";
                    }
                  }
                }

                ?>
              </div>

              <div id="termsError"></div>
            
              <div class="termsarea">
                <label class="terms" for="termsCheckbox">
                  <input id="termsCheckbox" type="checkbox" name="terms" id="terms" value="checked" class="terms__checkbox">
                  <span class="terms__checkbox-replace"></span> I agree to <a href="#" class="terms__link">terms of service</a>
                </label>
              </div>

            </form>
          </div>
          
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