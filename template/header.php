<?php
$currency = $_COOKIE['currency'] ?? 'zł';
?>

<!DOCTYPE html>
<html id="d" class="sm m p"
      lang="<?php
      // Pobierz język z cookie lub domyślnie 'pl'
      $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'pl';
      echo htmlspecialchars($lang);
      ?>"
      style="
          font-size: <?php echo isset($_COOKIE['fontSize']) ?  $_COOKIE['fontSize'] : '100%'; ?>;
          zoom: <?php echo isset($_COOKIE['pageZoom']) ? $_COOKIE['pageZoom'] : '100%'; ?>;
          "
>
<head>
    <meta charset="UTF-8">
    <?php
//    $userAgent = $_SERVER['HTTP_USER_AGENT'];
//    $isSafari = strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false && strpos($userAgent, 'Chromium') === false;
//    $isAppleDevice = preg_match('/Macintosh|iPhone|iPad|iPod/', $userAgent);
//    if ($isSafari && $isAppleDevice) {
//        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, initial-scale=1, maximum-scale=1">';
//    } else {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    //}

    if (isset($outputHead) && $outputHead) {
      echo $outputHead;
    } else { ?>
    <title>Sklep Bartnik</title>
    <meta name="description" content="Sklep Bartnik">
    <meta name="keywords" content="Sklep Bartnik">
    <?php } ?>
    <meta name="author" content="Sklep Bartnik">
<!--    <meta name="color-scheme" content="light dark">-->
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
<!--    <link rel="icon" type="image/png" href="/assets/favicon/favicon-96x96.png" sizes="96x96" />-->
<!--    <link rel="icon" type="image/svg+xml" href="/assets/favicon/favicon.svg" />-->
<!--    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" />-->
<!--    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png" />-->
<!--    <meta name="apple-mobile-web-app-title" content="Sklep Bartnik" />-->
<!--    <link rel="manifest" href="/assets/favicon/site.webmanifest" />-->
  
    <link rel="preload" href="/fonts/chakrapetch-bold-webfont.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/Poppins-Medium.woff2" as="font" type="font/woff2" crossorigin>
<!--    <link rel="preload" fetchpriority="high" as="image" href="/img/hero_image_mobile.avif" type="image/jpeg">-->
<!--    <link rel="preload" fetchpriority="high" as="image" href="/img/hero_bg.avif" type="image/jpeg" media="screen and (min-width: 44.01rem)">-->
<!--    <link rel="preload" fetchpriority="high" as="image" href="/img/hero_bg_mobile.avif" type="image/jpeg" media="screen and (max-width: 44rem)">-->
<!--    <link rel="preload" fetchpriority="high" as="image" href="/img/hero_image2_mobile.png.webp" type="image/jpeg">-->
<!--    <link rel="preload" href="https://www.google.com/recaptcha/api.js?render=6LdgdW4rAAAAAD56T4Y82cWTK81-zJSJLYg6H3Nu" as="script">-->
<!--    <link rel="preload" href="https://www.gstatic.com/recaptcha/releases/h7qt2xUGz2zqKEhSc8DD8baZ/styles__ltr.css" as="style">-->

  <?php include "head_style.php"; ?>
    <link rel="stylesheet" href="/template/vars.css<?php echo VERSION; ?>">
    <link rel="stylesheet" href="/template/grid.css<?php echo VERSION; ?>">
    <link rel="stylesheet" href="/template/style.css<?php echo VERSION; ?>">
    <link rel="stylesheet" href="/template/decors.css<?php echo VERSION; ?>">
    <link rel="stylesheet" href="/assets/animate.css<?php echo VERSION; ?>" media="screen and (min-width: 44.01rem)">
    <link rel="stylesheet" href="/template/style-lg-.css<?php echo VERSION; ?>" media="screen and (min-width: 66.01rem)">
    <link rel="stylesheet" href="/template/style-md.css<?php echo VERSION; ?>" media="screen and (max-width: 66rem)">
    <link rel="stylesheet" href="/template/style-t.css<?php echo VERSION; ?>" media="screen and (min-width: 44.01rem) and (max-width: 66rem)">
    <link rel="stylesheet" href="/template/style-sm.css<?php echo VERSION; ?>" media="screen and (max-width: 44rem)">
    <link rel="stylesheet" href="/assets/dd-slider.css<?php echo VERSION; ?>">

<!--    <link rel="stylesheet" href="/template/style-lg.css?v=--><?php //echo VERSION; ?><!--" media="screen and (65em < width <= 95em)">-->
<!--    <link rel="stylesheet" href="/template/style-md-.css?v=--><?php //echo VERSION; ?><!--" media="screen and (min-width: 44.01rem) and (max-width: 66rem)">-->
<!--    <link rel="stylesheet" href="/template/style-xs.css?v=--><?php //echo VERSION; ?><!--" media="screen and (max-width: 24rem)">-->

  <script src="/assets/dd-slider.js"></script>
  <script>
      <?php if (isset($_GET['scale2']) && DEV) { readfile(__DIR__ . '/dev_zoom.js');
      } else { // readfile(__DIR__ . '/dev_zoom2.js'); ?>

      let currentDeviceClass = 'sm m p'; // Default class for small mobile devices / mobile first
      function updateDeviceClass() {
          const html = document.documentElement;
          const w = window.innerWidth;
          const h = window.innerHeight;

          let newClass = '';

          if (w <= 704) newClass = 'sm m p'; // mobile phone
          else if (w <= 1056) newClass = 'md m t'; // 66 // mobile tablet
          else if (w <= 1232) newClass = 'lg d'; // 77 // desktop
          else if (w <= 1408) newClass = 'xl d';  // 88 // desktop
          else if (w <= 1760) newClass = 'xxl d d1k'; // 110 displays 1k // desktop
          else if (w <= 2200) newClass = 'xxl d d2k'; // displays 2k // desktop
          else if (w <= 2600) newClass = 'xxl d d3k'; // displays 3k // desktop
          else newClass = 'xxl d d4k'; // displays 4k+ // desktop

          // else if (w <= 1584) newClass = 'xxl d1 desktop'; // 99
          // else if (w <= 2000) newClass = 'xxl d2 desktop'; // 121
          // else if (w <= 2400) newClass = 'xxl d3 desktop'; // 143

          if (w <= 1408 && h <= 704 && w/h > 1.6) {
              newClass += ' short'; // High density screens
          }
          // console.log(`Device class: ${newClass} (w: ${w}, h: ${h})`);


          if (newClass !== currentDeviceClass) {
              html.classList.remove(
                  'sm','md','lg','xl','xxl',
                  'm', 'p', 't', 'd', 'short',
                  'hd','d1k','d2k','d3k','d4k'
              );
              html.classList.add(...newClass.split(' '));
              currentDeviceClass = newClass;
          }
      }
      updateDeviceClass();
      let resizeTimer;
      window.addEventListener('resize', () => {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(updateDeviceClass, 50);
      });
      window.addEventListener('DOMContentLoaded', updateDeviceClass);
      <?php } ?>


      (function() {
          // Pobieramy element <html> i informacje o kliencie
          const html = document.documentElement;
          const ua = navigator.userAgent;

          // --- Wykrywanie Systemu Operacyjnego ---
          let osClass = '';
          if (/Windows/i.test(ua))   { osClass = 'windows'; }
          // Sprawdzamy urządzenia mobilne Apple przed Mac'iem
          else if (/iPad/i.test(ua))  { osClass = 'ipados'; }
          else if (/iPhone/i.test(ua)) { osClass = 'ios'; }
          else if (/Macintosh/i.test(ua)) { osClass = 'macos'; }
          else if (/Android/i.test(ua))  { osClass = 'android'; }
          else if (/Linux/i.test(ua))    { osClass = 'linux'; }
          if (osClass) {
            html.classList.add(osClass);
          }

          // --- Wykrywanie Przeglądarki ---
          // Kolejność ma znaczenie, ponieważ User Agent często zawiera nazwy innych przeglądarek
          let browserClass = '';
          if (/Edg/i.test(ua)) { // Edge (Chromium)
              browserClass = 'edge';
          } else if (/OPR|Opera/i.test(ua)) { // Opera
              browserClass = 'opera';
          } else if (/Chrome/i.test(ua)) { // Chrome (musi być po Edge i Opera)
              browserClass = 'chrome';
          } else if (/Firefox/i.test(ua)) { // Firefox
              browserClass = 'firefox';
          } else if (/Safari/i.test(ua)) { // Safari (musi być po Chrome)
              browserClass = 'safari';
          }
          if (/Trident/i.test(ua) || /MSIE/i.test(ua)) { // Internet Explorer
              browserClass = 'ie';
          }
          if (browserClass) {
            html.classList.add(browserClass);
          }
      })();

  </script>
</head>
<?php //flush(); ?>
<body <?php echo isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark' ? 'data-theme="dark"' : ''; ?>>
<div class="page-wrapper">

<?php include PART.'header-main.php'; ?>


  <?php if (isset($_COOKIE['currency']) && $_COOKIE['currency'] == 'EUR') { ?>
    <style>

			.cart-item__total-price,
			.cart-summary__total,
			.summary-netto,
			.summary-brutto,
			.price__current,
			.summary-row span,
			.summary-row--total strong,
			.product-price span {
				/*transition: color .3s ease-in-out, background-color .3s ease-in-out;*/
				opacity: 0;
				animation: fadeInAnimation 0.17s forwards;
				animation-delay: 0.21s;
			}
			/* dodaj animację pojawiania się elementów po 200ms */
			.fade-in {
			}
			@keyframes fadeInAnimation {
				from {
					opacity: 0;
				}
				to {
					opacity: 1;
				}
			}
    </style>
  <?php } ?>
