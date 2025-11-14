<?php
$w = __DIR__;
//$oldPrice = isset($_COOKIE['lastProductOldPrice']) ? $_COOKIE['lastProductOldPrice'] : '50';
//$newPrice = isset($_COOKIE['lastProductNewPrice']) ? $_COOKIE['lastProductNewPrice'] : '32';
//$nazwaProduktu = htmlspecialchars($_GET['t'] ?? 'Nazwa przykładowego produktu');
//// Pobierz nazwę produktu z cookie, jeśli istnieje
//if (isset($_COOKIE['lastProductName'])) {
//  $nazwaProduktu = htmlspecialchars($_COOKIE['lastProductName']);
//}

// jeśli w nazwie produktu jest słowo "Miód", to wyciągnij kolejne słowo z nazwy produktu i zapisz je w zmiennej $rodzajMiodu
//if (stripos($nazwaProduktu, 'Miód') !== false) {
//  $slowa = explode(' ', $nazwaProduktu);
//  $indexMiodu = array_search('Miód', $slowa);
//  if ($indexMiodu !== false && isset($slowa[$indexMiodu + 1])) {
//    $rodzajMiodu = $slowa[$indexMiodu + 1];
//  } else {
//    $rodzajMiodu = '';
//  }
//}

function generate_product_url($title, $slug) {
  return '/product/' . $slug . '?t=' . urlencode($title);
}


$viewMode = $_COOKIE['productViewMode'] ?? 'grid';


?>
<link rel="stylesheet" href="<?php css($w, 'style.css'); ?>">
<!--<link rel="stylesheet" href="--><?php //css($w, 'style-lg-.css'); echo VERSION; ?><!--" media="screen and (min-width: 66.01rem)">-->
<link rel="stylesheet" href="<?php css($w, 'style-md.css'); echo VERSION; ?>" media="screen and (max-width: 66rem)">
<!--<link rel="stylesheet" href="--><?php //css($w, 'style-t.css'); echo VERSION; ?><!--" media="screen and (min-width: 44.01rem) and (max-width: 66rem)">-->
<link rel="stylesheet" href="<?php css($w, 'style-sm.css'); echo VERSION; ?>" media="screen and (max-width: 44rem)">

<div class="page-container page-product-category fade i">
  <div class="sidebar-trigger on-mobile">
    <div class="button sidebar-trigger-categories">
  <!--      <img src="/img/vector0.svg" alt="Kategorie">-->
        <span>Kategorie</span>
    </div>
    <div class="button sidebar-trigger-filters">
  <!--      <img src="/img/filter0.svg" alt="Filtry">-->
        <span>Filtry</span>
    </div>
  </div>
  <aside class="sidebar">
    <nav class="sidebar__navigation">
      <h2 class="sidebar__title">Kategorie</h2>
      <ul class="category-list">
        <li class="category-list__item"><a href="/kategoria/dla-mamy-i-taty">Dla Mamy i Taty</a></li>
        <li class="category-list__item"><a href="/kategoria/bestsellery">Bestsellery</a></li>
        <li class="category-list__item"><a href="/kategoria/dla-dzieci">Dla dzieci</a></li>
        <li class="category-list__item"><a href="/kategoria/dla-nauczyciela">Dla Nauczyciela</a></li>
        <li class="category-list__item"><a href="/kategoria/miody">Miody</a></li>
        <li class="category-list__item"><a href="/kategoria/miody-pasieka-kasztelewicz">Miody "Pasieka Kasztelewicz"</a></li>
        <li class="category-list__item"><a href="/kategoria/produkty-pszczel">Produkty pszczele</a></li>
        <li class="category-list__item"><a href="/kategoria/polska-roza-soki-shoty-konfitury">Polska Róża - soki, shoty, konfitury...</a></li>
        <li class="category-list__item"><a href="/kategoria/lakocie-i-upominki">Łakocie i upominki</a></li>
        <li class="category-list__item"><a href="/kategoria/leki-i-kosmetyki">Leki i kosmetyki</a></li>
        <li class="category-list__item"><a href="/kategoria/literatura-i-filmy">Literatura i filmy</a></li>
        <li class="category-list__item"><a href="/kategoria/pszczelarze">Pszczelarze</a></li>
        <li class="category-list__item"><a href="/kategoria/weza-pszczela">Węza pszczela</a></li>
      </ul>
    </nav>

    <div class="sidebar__tags">
      <a href="#" class="tag">Wiosna</a>
      <a href="#" class="tag">Majówka</a>
      <a href="#" class="tag">Nowości</a>
      <a href="#" class="tag">Promocje</a>
      <a href="#" class="tag">do 10 <?php echo $currency; ?></a>
    </div>

    <div class="sidebar__filter filter-price">
      <h3 class="filter__title">Cena</h3>
      <div class="price-slider">
        <div id="price-range-slider" style="margin: 20px 0;"></div>
        <div>
          <span id="range-min">0.00 <?php echo $currency; ?></span>
          &ndash;
          <span id="range-max">115.00 <?php echo $currency; ?></span>
        </div>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.7.1/dist/nouislider.min.css">
        <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.1/dist/nouislider.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var slider = document.getElementById('price-range-slider');
                var minSpan = document.getElementById('range-min');
                var maxSpan = document.getElementById('range-max');
                var currency = '<?php echo $currency; ?>';

                noUiSlider.create(slider, {
                    start: [0, 115],
                    connect: true,
                    step: 0.5,
                    range: {
                        'min': 0,
                        'max': 115
                    },
                    format: {
                        to: function (value) {
                            return value.toFixed(2);
                        },
                        from: function (value) {
                            return Number(value);
                        }
                    }
                });

                slider.noUiSlider.on('update', function (values) {
                    minSpan.textContent = values[0] + ' ' + currency;
                    maxSpan.textContent = values[1] + ' ' + currency;
                });
            });
        </script>
      </div>
    </div>

    <div class="sidebar__filter filter-subcategory">
      <h3 class="filter__title">Opcjonalna podkategoria</h3>
      <ul class="filter-list">
        <li class="filter-list__item"><input type="checkbox" id="catA" checked> <label for="catA">Miody z serii A</label> <span>(10)</span></li>
        <li class="filter-list__item"><input type="checkbox" id="catB"> <label for="catB">Miody z serii B</label> <span>(12)</span></li>
        <li class="filter-list__item"><input type="checkbox" id="catC"> <label for="catC">Miody z serii C</label> <span>(11)</span></li>
        <li class="filter-list__item"><input type="checkbox" id="catD"> <label for="catD">Miody z serii D</label> <span>(2)</span></li>
      </ul>
    </div>

    <div class="sidebar__promo-box">
      <a href="/kategoria/miody" class="banner-half banner-pink view-all-link" style="text-decoration: none;"> <img class="banner-bg-texture" src="/img/honey-texture-31.png" alt=""> <img class="banner-promo-image" src="/img/gift-10.png" alt="Prezent"> <div class="banner-half-text"> <p>Słodki i odpowiedni upominek</p> <h2>Dla Mamy i Taty</h2> <span class="link flex"><img src="/img/link-arrow2.svg" alt=""> zobacz wszystkie</span> </div> </a>
    </div>



    <nav class="sidebar__navigation">
      <h2 class="sidebar__title">Dla kogo</h2>
      <ul class="category-list">
        <li class="category-list__item"><a href="#">Dla Mamy i Taty</a></li>
        <li class="category-list__item"><a href="#">Dla smakosza</a></li>
        <li class="category-list__item"><a href="#">Dla nauczyciela</a></li>
      </ul>
    </nav>

    <div class="sidebar__filter filter-subcategory">
      <h3 class="filter__title">Opcjonalna filtracja</h3>
      <ul class="filter-list colors">
        <li class="filter-list__item"><input type="checkbox" id="colorA"> <label for="colorA" data-color="grey">Szary</label> <span>(7)</span></li>
        <li class="filter-list__item"><input type="checkbox" id="colorB"> <label for="colorB" data-color="white">Biały</label> <span>(6)</span></li>
        <li class="filter-list__item"><input type="checkbox" id="colorC"> <label for="colorC" data-color="red">Czerwony</label> <span>(8)</span></li>
        <li class="filter-list__item"><input type="checkbox" id="colorD"> <label for="colorD" data-color="yellow">żółty</label> <span>(8)</span></li>
      </ul>
    </div>



  </aside>

  <main class="main-content">
    <header class="category-header">
      <h2 class="category-header__title">.</h2>
      <p class="category-header__description">
        Ultricies pulvinar egestas accumsan elit eu ipsum vulputate metus. Scelerisque lacus facilisis duis mi feugiat. Laoreet vitae sagittis adipiscing risus. At viverra elementum mattis sit facilisis pharetra mauris duis urna. A sed cras turpis.
      </p>
    </header>
<!--    <section class="product-listing">-->
    <section class="product-listing<?php echo ($viewMode === 'list') ? ' product-listing--list' : ' product-listing--grid'; ?>">
      <div class="product-listing__toolbar">
<!--        <div class="toolbar__view-options">-->
<!--          <button class="view-options__btn view-options__btn--list"><img src="--><?php //w($w); ?><!--list4.svg" alt="Widok listy"></button>-->
<!--          <button class="view-options__btn view-options__btn--grid view-options__btn--active"><img src="--><?php //w($w); ?><!--grid0.svg" alt="Widok siatki"></button>-->
<!--          <span class="toolbar__product-count">Znaleziono 25 produktów</span>-->
<!--        </div>-->
        <div class="toolbar__view-options">
          <button class="view-options__btn view-options__btn--list<?php if ($viewMode === 'list') echo ' view-options__btn--active'; ?>" id="view-list">
            <img src="<?php w($w); ?>list4.svg" alt="Widok listy">
          </button>
          <button class="view-options__btn view-options__btn--list2<?php if ($viewMode === 'list2') echo ' view-options__btn--active'; ?>" id="view-list2">
            <img src="<?php w($w); ?>list4.svg" alt="Widok listy">2
          </button>
          <button class="view-options__btn view-options__btn--grid<?php if ($viewMode === 'grid') echo ' view-options__btn--active'; ?>" id="view-grid">
            <img src="<?php w($w); ?>grid0.svg" alt="Widok siatki">
          </button>
          <span class="toolbar__product-count">Znaleziono 25 produktów</span>
        </div>
        <div class="toolbar__sort-options">
          <label for="sort-by">Sortuj wg:</label>
          <select id="sort-by" class="sort-options__select">
            <option value="popular">Najpopularniejsze</option>
            <option value="price-asc">Cena rosnąco</option>
            <option value="price-desc">Cena malejąco</option>
          </select>
        </div>
      </div>
      <script>
          // document.addEventListener('DOMContentLoaded', function () {
          //     const listing = document.querySelector('.product-listing');
          //     const btnList = document.getElementById('view-list');
          //     const btnGrid = document.getElementById('view-grid');
          //
          //     function setView(mode) {
          //         if (!listing) return;
          //         if (mode === 'list') {
          //             listing.classList.add('product-listing--list');
          //             listing.classList.remove('product-listing--grid');
          //             btnList.classList.add('view-options__btn--active');
          //             btnGrid.classList.remove('view-options__btn--active');
          //         } else {
          //             listing.classList.add('product-listing--grid');
          //             listing.classList.remove('product-listing--list');
          //             btnGrid.classList.add('view-options__btn--active');
          //             btnList.classList.remove('view-options__btn--active');
          //         }
          //         // Przełącz klasę aktywnego przycisku
          //         [btnList, btnGrid].forEach(btn => btn.classList.remove('view-options__btn--active'));
          //         if (mode === 'list') {
          //             btnList.classList.add('view-options__btn--active');
          //         } else {
          //             btnGrid.classList.add('view-options__btn--active');
          //         }
          //         document.cookie = 'productViewMode=' + mode + ';path=/;max-age=31536000';
          //     }
          //
          //     if (btnList) {
          //         btnList.addEventListener('click', function () {
          //             setView('list');
          //         });
          //     }
          //     if (btnGrid) {
          //         btnGrid.addEventListener('click', function () {
          //             setView('grid');
          //         });
          //     }
          // });
          document.addEventListener('DOMContentLoaded', function () {
              const listing = document.querySelector('.product-listing');
              const btnList = document.getElementById('view-list');
              const btnList2 = document.getElementById('view-list2');
              const btnGrid = document.getElementById('view-grid');
              const buttons = [btnList, btnList2, btnGrid];

              function setView(mode) {
                  if (!listing) return;
                  // Usuń wszystkie klasy widoku
                  listing.classList.remove('product-listing--list', 'product-listing--list2', 'product-listing--grid');
                  // Dodaj odpowiednią klasę
                  if (mode === 'list') {
                      listing.classList.add('product-listing--list');
                  } else if (mode === 'list2') {
                      listing.classList.add('product-listing--list2');
                  } else {
                      listing.classList.add('product-listing--grid');
                  }
                  // Przełącz klasę aktywnego przycisku
                  buttons.forEach(btn => btn && btn.classList.remove('view-options__btn--active'));
                  if (mode === 'list' && btnList) {
                      btnList.classList.add('view-options__btn--active');
                  } else if (mode === 'list2' && btnList2) {
                      btnList2.classList.add('view-options__btn--active');
                  } else if (btnGrid) {
                      btnGrid.classList.add('view-options__btn--active');
                  }
                  document.cookie = 'productViewMode=' + mode + ';path=/;max-age=31536000';
              }

              if (btnList) {
                  btnList.addEventListener('click', function () {
                      setView('list');
                  });
              }
              if (btnList2) {
                  btnList2.addEventListener('click', function () {
                      setView('list2');
                  });
              }
              if (btnGrid) {
                  btnGrid.addEventListener('click', function () {
                      setView('grid');
                  });
              }
            setTimeout(function() {
                var fade_element = document.querySelector('.page-container.fade.i');
                if (fade_element) {
                    fade_element.classList.remove('fade', 'i');
                }
            }, 400);
          });
      </script>


      <div class="product-grid">
        <article class="product-card">
          <?php $title = 'Miód rzepakowo-gryczany'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-rzepakowo-gryczany'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-890.png" alt="<?php echo $title; ?>">
              <div class="product-card__badges">
                <span class="badge badge--sale">-10%</span>
                <span class="badge badge--new">New</span>
              </div>
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span class="price-old">15 <?php echo $currency; ?></span>
                <span class="price-new">13 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Cud miód i pokrzywa'; ?>
          <a href="<?php echo generate_product_url($title, 'cud-miod-i-pokrzywa'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-891.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>13,50 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Cud miód - jagoda 250 g'; ?>
          <a href="<?php echo generate_product_url($title, 'cud-miod-jagoda-250g'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-892.png" alt="<?php echo $title; ?>">
              <div class="product-card__badges">
                <span class="badge badge--sale">-10%</span>
              </div>
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Cud miód - miody z dodatkami</p>
              <div class="product-price">
                <span class="price-old">15 <?php echo $currency; ?></span>
                <span class="price-new">13 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Cud miód i brusznica'; ?>
          <a href="<?php echo generate_product_url($title, 'cud-miod-i-brusznica'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-893.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>12,50 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Cud miód i hibiskus z pomarańczą'; ?>
          <a href="<?php echo generate_product_url($title, 'cud-miod-i-hibiskus-z-pomarancza'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-894.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>12,50 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód wielokwiatowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-wielokwiatowy'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-895.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>14,00 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Cud miód - borówka 250 g'; ?>
          <a href="<?php echo generate_product_url($title, 'cud-miod-borowka-250g'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-896.png" alt="<?php echo $title; ?>">
              <div class="product-card__badges">
                <span class="badge badge--new">New</span>
              </div>
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Cud miód - miody z dodatkami</p>
              <div class="product-price">
                <span>13,00 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód lipowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-lipowy'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>rectangle-897.png" alt="<?php echo $title; ?>">
              <div class="product-card__badges">
                <span class="badge badge--sale">-10%</span>
              </div>
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span class="price-old">20 <?php echo $currency; ?></span>
                <span class="price-new">18 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Cud miód - pigwowiec japoński z dziką różą 250 g'; ?>
          <a href="<?php echo generate_product_url($title, 'cud-miod-pigwowiec-japonski-z-dzika-roza-250g'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image0.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Cud miód - miody z dodatkami</p>
              <div class="product-price">
                <span>13,00 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód akacjowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-akacjowy'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image1.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>16,50 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód spadziowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-spadziowy'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image2.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>22,00 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód malinowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-malinowy'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image3.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>19,50 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód lipowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-lipowy-2'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image4.png" alt="<?php echo $title; ?>">
              <div class="product-card__badges">
                <span class="badge badge--sale">-10%</span>
              </div>
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span class="price-old">20 <?php echo $currency; ?></span>
                <span class="price-new">18 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Cud miód - pigwowiec japoński z dziką różą 250 g'; ?>
          <a href="<?php echo generate_product_url($title, 'cud-miod-pigwowiec-japonski-z-dzika-roza-250g-2'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image5.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Cud miód - miody z dodatkami</p>
              <div class="product-price">
                <span>13,00 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód akacjowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-akacjowy-2'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image6.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>16,50 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

        <article class="product-card">
          <?php $title = 'Miód spadziowy'; ?>
          <a href="<?php echo generate_product_url($title, 'miod-spadziowy-2'); ?>" class="product-card__link">
            <div class="product-card__image-container">
              <img class="product-card__image" src="<?php w($w); ?>image7.png" alt="<?php echo $title; ?>">
            </div>
            <div class="product-card__content">
              <h3 class="product-card__title"><?php echo $title; ?></h3>
              <div class="product-card__rating">
                <img src="<?php w($w); ?>stars0.svg" alt="Ocena produktu: 5 na 5 gwiazdek">
              </div>
              <p class="product-card__category">Kategoria</p>
              <div class="product-price">
                <span>22,00 <?php echo $currency; ?></span>
              </div>
            </div>
          </a>
          <button class="product-card__add-to-cart">
            <img src="<?php w($w); ?>btn0.svg" alt="Dodaj do koszyka">
          </button>
        </article>

      </div>

      <nav class="pagination">
        <span class="pagination__info">Wyświetlono 1-16 z 25 produktów</span>
        <ul class="pagination__links">
          <?php
          $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $totalPages = 2; // Zmień na dynamiczną liczbę jeśli masz więcej stron
          ?>
          <?php if ($currentPage > 1): ?>
            <li><a href="?page=<?php echo $currentPage - 1; ?>" class="pagination__link pagination__link--prev"><img src="<?php w($w); ?>link6.svg" alt="Poprzednia strona"></a></li>
          <?php endif; ?>
          <li><a href="<?php echo ($currentPage == 1) ? '#' : '?page=1'; ?>" class="pagination__link<?php echo ($currentPage == 1) ? ' pagination__link--active' : ''; ?>">1</a></li>
          <li><a href="<?php echo ($currentPage == 2) ? '#' : '?page=2'; ?>" class="pagination__link<?php echo ($currentPage == 2) ? ' pagination__link--active' : ''; ?>">2</a></li>
          <?php if ($currentPage < $totalPages): ?>
            <li><a href="?page=<?php echo $currentPage + 1; ?>" class="pagination__link pagination__link--next"><img src="<?php w($w); ?>link6.svg" alt="Następna strona"></a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </section>
    <br>
    <br>
    <section class="banner">
      <a href="/kategoria/miody" class="banner-half banner-yellow view-all-link" style="text-decoration: none;"> <img class="banner-bg-texture" src="/img/honey-texture-30.png" alt=""> <img class="banner-promo-image" src="/img/honey0.png" alt="Miód"> <div class="banner-half-text"> <p>30% Rabatu na wszystko</p> <h2>Wiosenne słodkie rabaty</h2> <span class="link flex"><img src="/img/link-arrow1.svg" alt=""> zobacz wszystkie</span> </div> </a>
    </section>

  </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const grid = document.querySelector('.product-grid');
        if (!grid) return;
        const items = Array.from(grid.querySelectorAll('article.product-card'));
        for (let i = items.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            grid.appendChild(items[j]);
            items.splice(j, 1);
        }
        // Dodaj pozostały element (jeśli został)
        if (items.length) grid.appendChild(items[0]);
        // jeśli URL jest z parametrem ?page=2, to przewiń stronę na górę i wyświetl tylko 9 produktów
        if (window.location.search.includes('page=2')) {
            window.scrollTo(0, 0);
            const allProducts = document.querySelectorAll('.product-card');
            allProducts.forEach((product, index) => {
                if (index >= 9) product.style.display = 'none'; // Ukryj produkty od 10 wzwyż
            });
        }
    });
    // Podświetlanie aktywnej kategorii na podstawie URL
    document.addEventListener('DOMContentLoaded', function () {
        const currentPath = window.location.pathname;
        const categoryLinks = document.querySelectorAll('.category-list__item a');
        categoryLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.parentElement.classList.add('category-list__item--active');
            }
        });
        // Zapamiętaj tytuł aktywnej zakładki i ustaw go w .category-header__title
        const activeLink = document.querySelector('.category-list__item--active a');
        if (activeLink) {
            const title = activeLink.textContent;
            localStorage.setItem('activeCategoryTitle', title);
            const headerTitle = document.querySelector('.category-header__title');
            if (headerTitle) headerTitle.textContent = title;
        }
    });
</script>