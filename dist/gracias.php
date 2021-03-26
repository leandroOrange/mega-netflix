<?php
require_once('OrangeAPI.php');

$orange = new APIclient();
$orange->url = ORANGE_URL;
$orange->token = ORANGE_TOKEN;
$orange->saltKey = ORANGE_SALT;
$orange->setSessionToken(ORANGE_SESSION);

$r = $orange->request('GET','landing',array(
  'landing' => 'megacable-netflix',
  'sublanding' => $_GET['city'],
  'step' => 'gracias'
));

if ($r->response->status != 200){
  die("dato no valido");
}
$id_pixel_facebook;
$id_google_tag;
$fbq_envent_conversion;
$id_google_analytics;
$id_google_googletag_conversion;

if (($_GET['ag']) === 'or') {
  $id_pixel_facebook = $orange->get('id-facebook');
  $id_google_tag = $orange->get('id-google-ads');
  $fbq_envent_conversion = $orange->get('fb-event-conversion');
  $id_google_analytics = $orange->get('	id-google-analytics-orange');
  $id_google_googletag_conversion = $orange->get('id-goog-ads-conversion');
}else{
  $id_pixel_facebook = $orange->get('id-facebook-thera');
  $id_google_tag = $orange->get('id-google-ads-thera');
  $fbq_envent_conversion = $orange->get('fb-event-conversion-thera');
  $id_google_analytics = $orange->get('id-google-analytics');
  $id_google_googletag_conversion = $orange->get('id-goog-ads-conversion-thera');
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Megacable - Gracias por registrarte!</title>
  <link rel="icon" href="fav.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="fav.ico" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/aos.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Facebook Pixel Code -->
  <script>
      !function (f, b, e, v, n, t, s) {
        if (f.fbq) return; n = f.fbq = function () {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
        n.queue = []; t = b.createElement(e); t.async = !0;
        t.src = v; s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?= $id_pixel_facebook; ?>');
      fbq('track', 'PageView');
      fbq('track', '<?= $fbq_envent_conversion; ?>');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?=$id_pixel_facebook;?>&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->

    <?php if (($_GET['ag']) === 'th') {?>
      <!-- Facebook Pixel Code -->
      <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1944558472454005');
        fbq('track', 'PageView');
        fbq('track', 'Lead');
      </script>
      <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1944558472454005&ev=PageView&noscript=1"
      /></noscript>
      <!-- End Facebook Pixel Code -->
    <?php }?>

    <?php if ($orange->get('id-google-analytics')){?>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src='https://www.googletagmanager.com/gtag/js?id=<?=$id_google_analytics;?>'></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?=$id_google_analytics;?>');
      </script>
    <?php }?>

    <!-- Global site tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$id_google_tag;?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() { dataLayer.push(arguments); }
      gtag('js', new Date());
      gtag('config', '<?=$id_google_tag;?>');
    </script>

    <!-- Event snippet for Lead conversion page -->
    <script>
      gtag('event', 'conversion', { 'send_to': '<?=$id_google_googletag_conversion;?>' });
    </script>

  <?php if (($_GET['ag']) === 'th') {?>
    <!-- Global site tag (gtag.js) - Google Ads: 833256778 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-833256778"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-833256778');
    </script>
    <!-- Event snippet for Lead conversion page -->
    <script>
      gtag('event', 'conversion', {'send_to': 'AW-833256778/TvMXCPGJlHgQyvqpjQM'});
    </script>
  <?php }?>
  
</head>

<body>

  <div class="wrapper-typ">
    <div>
      <img src="assets/img/global/logo-megacable-blanco.png" alt="logo-megacable">
      <h2>Recibirás una llamada del número 3396901500 para atender tu solicitud</h2>
      <p>*Nuestro horario de atención es de Lunes a Domingo de 08:00 AM a 10:00 PM (Hora del Centro de México), lo contactaremos en cuanto reanudemos actividades.</p>
    </div>
  </div>

  <script src="assets/js/vendors/vendors.js"></script>
</body>

</html>