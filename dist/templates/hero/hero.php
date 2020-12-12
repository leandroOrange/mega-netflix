<div class="Hero" id="hero">
  <div class="container">
    <div class="row Hero__wrapper-mobile-form">
      <div class="col">
        <?php include 'templates/forms/bar-form.php';?>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <img src="assets/img/promo/titulo-entero.png" alt="" class="img-fluid">
       <!--  <div class="bodymovin lottie-hero-1" data-animation-path="assets/img/promo/titulo.json" data-anim-loop="false" data-anim-type="svg" data-name="ninja"></div> -->
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="col">
          <div class="bodymovin lottie-hero-2" data-animation-path="assets/img/promo/<?=$orange->get('_sublanding');?>/hero.json" data-anim-loop="false" data-anim-type="svg" data-name="ninja"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php include 'templates/forms/primary-form.php';?>
    </div>
  </div>
</div>
