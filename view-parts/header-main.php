<header id="header" class="header page-header">
  <?php include PART.'header-top-bar-announcement.php'; ?>

  <div class="top-bar-main on-desktop">
    <div class="shipping-info">
      <span><strong>BEZPŁATNA WYSYŁKA</strong> przy zakupach powyżej 250 PLN!</span>
    </div>
    <div class="top-bar-controls on-desktop">
      <div class="accessibility-controls">
        <!-- Zmieniony element do zmiany czcionki -->
        <div class="font-size-changer">
          <span data-size="100%">Aa</span>
          <span data-size="125%">Aa</span>
          <span data-size="150%">Aa</span>
        </div>
        <!-- Element do zmiany motywu -->
        <img class="theme-toggle" src="/img/button-toggle0.svg" alt="Zmień motyw">
      </div>
      <?php include PART.'header-controls.php'; ?>
    </div>
  </div>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const langSelector = document.querySelector('.language-selector');
          const submenu = langSelector.querySelector('.language-submenu');
          const currentLangSpan = langSelector.querySelector('span');
          const flagImg = langSelector.querySelector('.flag-icon');

          // Pokaż/ukryj submenu po kliknięciu
          langSelector.addEventListener('click', function(e) {
              submenu.classList.toggle('open');
              e.stopPropagation();
          });

          // Zamknij submenu po kliknięciu poza
          document.addEventListener('click', function() {
              submenu.classList.remove('open');
          });

          // Obsługa wyboru języka
          submenu.querySelectorAll('li').forEach(function(li) {
              li.addEventListener('click', function(e) {
                  const lang = li.getAttribute('data-lang');
                  const flag = li.querySelector('.flag-icon').src;
                  // Ustaw cookie na 365 dni
                  document.cookie = 'lang=' + lang + ';path=/;max-age=' + (60*60*24*365);
                  // Zmień flagę i tekst
                  flagImg.src = flag;
                  currentLangSpan.textContent = lang.toUpperCase();
                  submenu.classList.remove('open');
                  // Przeładuj stronę, by PHP pobrał nowy język
                  location.reload();
                  e.stopPropagation();
              });
          });
      });

      document.addEventListener('DOMContentLoaded', function() {
          const currencySelector = document.querySelector('.currency-selector');
          if (!currencySelector) return;
          const submenu = currencySelector.querySelector('.currency-submenu');
          const currentCurrencySpan = currencySelector.querySelector('span');

          currencySelector.addEventListener('click', function(e) {
              submenu.classList.toggle('open');
              e.stopPropagation();
          });

          document.addEventListener('click', function() {
              submenu.classList.remove('open');
          });

          submenu.querySelectorAll('li').forEach(function(li) {
              li.addEventListener('click', function(e) {
                  const currency = li.getAttribute('data-currency');
                  document.cookie = 'currency=' + currency + ';path=/;max-age=' + (60*60*24*365);
                  currentCurrencySpan.textContent = currency;
                  submenu.classList.remove('open');
                  location.reload();
                  e.stopPropagation();
              });
          });
      });
  </script>


  <style>
		.language-selector { position: relative; cursor: pointer;	gap: 5px;}
		.language-submenu { display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 10; min-width: 100px; }
		.language-submenu.open { display: block; }
		.language-submenu li { padding: 6px 16px; cursor: pointer; display: flex; align-items: center; }
		.language-submenu li:hover { background: #f0f0f0; }
		.flag-icon { width: 20px; height: 14px; margin-right: 8px; }
		.language-selector span {
			text-transform: uppercase;
		}

		.currency-selector { position: relative; cursor: pointer; }
		.currency-submenu { display: none; position: absolute; background: #fff; border: 1px solid #ccc; z-index: 10; min-width: 60px; right: 0; }
		.currency-submenu.open { display: block; }
		.currency-submenu li { padding: 6px 16px; cursor: pointer; }
		.currency-submenu li:hover { background: #f0f0f0; }
  </style>
<div class="main-header">
  <a href="/">
    <img class="logo on-light" src="/img/logo0.svg" alt="Logo Bartnik">
    <img class="logo on-dark" src="/img/logo-dark.svg" alt="Logo Bartnik">
  </a>
  <img class="search-icon on-phone" src="/img/loupe0.svg" alt="Szukaj" onclick="document.querySelector('.search-bar').classList.toggle('show-on-mobile');">
  <div class="search-bar on-tablet on-desktop">
    <label>
      <input type="text" name="search" class="search-input" placeholder="Szukaj produktu..." onkeydown="if(event.key==='Enter'){window.location.href='/s?s='+encodeURIComponent(this.value);return false;}">
    </label>
    <img class="search-icon" src="/img/loupe0.svg" alt="Szukaj" onclick="const input=this.previousElementSibling.querySelector('.search-input');if(input){window.location.href='/s?s='+encodeURIComponent(input.value);}">
    <img class="search-icon close on-mobile" src="/img/delete0.svg" alt="Szukaj" onclick="document.querySelector('.search-bar').classList.toggle('show-on-mobile');">
  </div>
  <a class="on-desktop button-secondary" href="https://bartnik.pl/" target="_blank">Sądecki Bartnik</a>

  <div class="top-bar-controls on-mobile">
    <?php include PART.'header-controls.php'; ?>
  </div>
  <!--      <div class="search-and-actions"></div>-->
</div>
<nav class="main-nav">
  <div class="nav-container">
    <div class="mobile-menu-trigger on-mobile" onclick="document.querySelector('.main-nav .nav-container').classList.toggle('show-mobile');">
      <img src="/img/vector0.svg" alt="Menu" >
      <span>Menu</span>
    </div>

    <ul class="nav-links">
      <li class="flex">
        <a href="/" class="on-scroll-down">
          <img class="mini-logo" src="/img/mini-logo.svg" alt="Logo Bartnik">
        </a>
        <ul class="nav-categories-dropdown">
          <li>
            <img src="/img/vector0.svg" alt="Menu">
            <span>Kategorie sklepu</span>
            <ul class="menu-content">
              <li><a href="/kategoria/3-miody-naturalne" title="Miody">Miody</a></li>
              <li><a href="/kategoria/5-leki-i-kosmetyki" title="Leki i kosmetyki">Leki i kosmetyki</a><ul><li class="first-in-line"><a href="/kategoria/109-mydelka" title="Mydełka">Mydełka</a></li><li><a href="/kategoria/6-tabletki" title="Tabletki">Tabletki</a></li><li><a href="/kategoria/7-mydla-w-plynie" title="Mydła w płynie">Mydła w płynie</a></li><li><a href="/kategoria/9-masci" title="Maści">Maści</a></li><li><a href="/kategoria/10-krople-propolisowe" title="Krople propolisowe ">Krople propolisowe </a></li><li class="first-in-line"><a href="/kategoria/93-higiena-jamy-ustnej" title="Higiena jamy ustnej ">Higiena jamy ustnej </a></li><li><a href="/kategoria/136-pielegnacja-twarzy" title="Pielęgnacja twarzy ">Pielęgnacja twarzy </a></li><li><a href="/kategoria/139-pielegnacja-rak" title="Pielęgnacja rąk ">Pielęgnacja rąk </a></li><li><a href="/kategoria/140-pielegnacja-stop" title="Pielęgnacja stóp">Pielęgnacja stóp</a></li><li><a href="/kategoria/141-pielegnacja-wlosow" title="Pielęgnacja włosów ">Pielęgnacja włosów </a></li><li class="first-in-line"><a href="/kategoria/142-pielegnacja-ust" title="Pielęgnacja ust">Pielęgnacja ust</a></li><li><a href="/kategoria/143-pielegnacja-ciala" title="Pielęgnacja ciała ">Pielęgnacja ciała </a></li></ul></li><li><a href="/kategoria/63-lakocie-i-upominki" title="Łakocie i upominki">Łakocie i upominki</a><ul><li class="first-in-line"><a href="/kategoria/89-zestawy-prezentowe-duze" title="Zestawy prezentowe DUŻE">Zestawy prezentowe DUŻE</a></li><li><a href="/kategoria/123-zestawy-prezentowe-srednie" title="Zestawy prezentowe ŚREDNIE ">Zestawy prezentowe ŚREDNIE </a></li><li><a href="/kategoria/124-zestawy-prezentowe-male" title="Zestawy prezentowe MAŁE">Zestawy prezentowe MAŁE</a></li><li><a href="/kategoria/79-upominki-okolicznosciowe" title="Upominki okolicznościowe">Upominki okolicznościowe</a></li><li><a href="/kategoria/133-upominki-wesele" title="Upominki WESELE">Upominki WESELE</a></li><li class="first-in-line"><a href="/kategoria/132-upominki-chrzest-sw" title="Upominki CHRZEST ŚW.">Upominki CHRZEST ŚW.</a></li><li><a href="/kategoria/130-upominki-i-komunia-sw" title="Upominki I KOMUNIA ŚW.">Upominki I KOMUNIA ŚW.</a></li><li><a href="/kategoria/60-swiece-z-wosku" title="Świece z wosku">Świece z wosku</a></li><li><a href="/kategoria/56-cukierki-miodowe" title="Cukierki miodowe">Cukierki miodowe</a></li><li><a href="/kategoria/80-belgijskie-czekolady-z-miodem" title="Belgijskie czekolady z miodem">Belgijskie czekolady z miodem</a></li><li class="first-in-line"><a href="/kategoria/114-czekoladki-z-produktami-pszczelimi" title="Czekoladki z produktami pszczelimi">Czekoladki z produktami pszczelimi</a></li><li><a href="/kategoria/119-slodkie-przekaski" title="Słodkie przekąski">Słodkie przekąski</a></li><li><a href="/kategoria/83-krowki" title="Krówki">Krówki</a></li><li><a href="/kategoria/81-napoje-miodowe" title="Napoje miodowe">Napoje miodowe</a></li><li><a href="/kategoria/117-akcesoria" title="Akcesoria">Akcesoria</a></li><li class="first-in-line"><a href="/kategoria/158-herbaty" title="Herbaty">Herbaty</a></li><li><a href="/kategoria/155-polska-roza" title="Polska Róża">Polska Róża</a></li></ul></li><li><a href="/kategoria/34-produkty-pszczele" title="Produkty pszczele">Produkty pszczele</a><ul><li class="first-in-line"><a href="/kategoria/35-mleczko-pszczele" title="Mleczko pszczele">Mleczko pszczele</a></li><li><a href="/kategoria/36-pierzga" title="Pierzga">Pierzga</a></li><li><a href="/kategoria/37-propolis-kit-pszczeli" title="Propolis - kit pszczeli">Propolis - kit pszczeli</a></li><li><a href="/kategoria/102-propolis-krople" title="Propolis - krople">Propolis - krople</a></li><li><a href="/kategoria/38-pylek-kwiatowy" title="Pyłek kwiatowy">Pyłek kwiatowy</a></li><li class="first-in-line"><a href="/kategoria/39-ziolomiody" title="Ziołomiody">Ziołomiody</a></li><li><a href="/kategoria/82-bee-complex" title="Bee-complex">Bee-complex</a></li><li><a href="/kategoria/115-plaster-miodu" title="Plaster miodu">Plaster miodu</a></li></ul></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href="#">Pszczelarze <img class="arrow-down-icon" src="/img/arrow-down3.svg" alt="Rozwiń"></a>
        <ul>
          <li class="first-in-line"><a href="/kategoria/134-weza-pszczela" title="Węza pszczela ">Węza pszczela </a></li><li><a href="/kategoria/128-ciasto-dla-pszczol" title="Ciasto dla pszczół">Ciasto dla pszczół</a></li><li><a href="/kategoria/47-ule-i-elementy-uli" title="Ule i elementy uli">Ule i elementy uli</a></li><li><a href="/kategoria/160-ramki-do-ula" title="Ramki do ula ">Ramki do ula </a></li><li><a href="/kategoria/164-zdrowie-pszczol" title="Zdrowie pszczół ">Zdrowie pszczół </a></li><li class="first-in-line"><a href="/kategoria/46-preparaty-i-srodki-chemiczne" title="Preparaty i środki chemiczne">Preparaty i środki chemiczne</a><ul><li class="first-in-line"><a href="/kategoria/73-apiforte" title="ApiForte">ApiForte</a></li></ul></li><li><a href="/kategoria/45-odziez-pszczelarska" title="Odzież pszczelarska">Odzież pszczelarska</a></li><li><a href="/kategoria/44-miodarki" title="Miodarki">Miodarki</a></li><li><a href="/kategoria/43-sprzet-pszczelarski" title="Sprzęt pszczelarski">Sprzęt pszczelarski</a></li><li><a href="/kategoria/74-logar" title="Logar">Logar</a></li><li class="first-in-line"><a href="/kategoria/113-literatura" title="Literatura">Literatura</a></li><li><a href="/kategoria/137-filmy-dvd" title="Filmy - DVD">Filmy - DVD</a></li><li><a href="/kategoria/138-materialy-konferencyjne-broszury-inne" title="Materiały konferencyjne - broszury - inne">Materiały konferencyjne - broszury - inne</a></li>
        </ul>
      </li>

      <li><a href="/kategoria/nowosci">Nowości</a></li>
      <li><a href="/kategoria/bestsellery">Bestsellery</a></li>
      <li><a href="/kategoria/promocje">Promocje</a></li>
      <li><a href="/kategoria/dla-nauczyciela">Dla nauczyciela</a></li>
    </ul>
    <div class="separetor"></div>
    <div class="user-widget">
      <a href="/moje-konto">
        <img class="cart-icon" src="/img/user.svg" alt="Konto">
      </a>
    </div>
    <div class="cart-widget">
      <a href="/koszyk" class="cart-trigger">
        <img class="cart-icon" src="/img/shopping-cart-3596863.svg" alt="Koszyk">
        <span>0</span>
      </a>
      <?php include PART.'/header-mini-cart.php'; ?>
    </div>
  </div>
</nav>
</header>