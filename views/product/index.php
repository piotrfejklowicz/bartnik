<?php
$w = __DIR__;
$oldPrice = isset($_COOKIE['lastProductOldPrice']) ? $_COOKIE['lastProductOldPrice'] : '50';
$newPrice = isset($_COOKIE['lastProductNewPrice']) ? $_COOKIE['lastProductNewPrice'] : '32';
$nazwaProduktu = htmlspecialchars($_GET['t'] ?? 'Nazwa przykładowego produktu');
// Pobierz nazwę produktu z cookie, jeśli istnieje
if (isset($_COOKIE['lastProductName'])) {
  $nazwaProduktu = htmlspecialchars($_COOKIE['lastProductName']);
}

// jeśli w nazwie produktu jest słowo "Miód", to wyciągnij kolejne słowo z nazwy produktu i zapisz je w zmiennej $rodzajMiodu
if (stripos($nazwaProduktu, 'Miód') !== false) {
  $slowa = explode(' ', $nazwaProduktu);
  $indexMiodu = array_search('Miód', $slowa);
  if ($indexMiodu !== false && isset($slowa[$indexMiodu + 1])) {
    $rodzajMiodu = $slowa[$indexMiodu + 1];
  } else {
    $rodzajMiodu = '';
  }
}


?>
<link rel="stylesheet" href="<?php css($w, 'style.css'); ?>">

<div class="breadcrumbs container">
  <a href="/" class="breadcrumbs__item">Home</a>
  <span class="breadcrumbs__separator">/</span>
  <a href="#" class="breadcrumbs__item">Dla Mamy i Taty</a>
  <span class="breadcrumbs__separator">/</span>
  <span class="breadcrumbs__item breadcrumbs__item--active"><?php echo $nazwaProduktu; ?></span>
</div>
<section class="product-section">
  <div class="product-view">
    <div class="product-view__gallery">
      <div class="product-gallery">
        <div class="product-gallery__main-image-wrapper">
          <img class="product-gallery__main-image" src="<?php w($w); ?>IMG_0112 1.jpg" alt="Zdjęcie główne produktu: <?php echo $nazwaProduktu; ?>" />
        </div>
        <button class="product-gallery__nav-button product-gallery__nav-button--prev" aria-label="Poprzednie zdjęcie">
          <img src="<?php w($w); ?>btn0.svg" alt="Strzałka w lewo" />
        </button>
        <button class="product-gallery__nav-button product-gallery__nav-button--next" aria-label="Następne zdjęcie">
          <img src="<?php w($w); ?>btn1.svg" alt="Strzałka w prawo" />
        </button>
        <div class="product-gallery__thumbnails">
          <div class="product-gallery__thumbnail">
            <img src="<?php w($w); ?>IMG_0035 1.jpg" alt="Miniatura zdjęcia produktu 1" />
          </div>
          <div class="product-gallery__thumbnail">
            <img src="<?php w($w); ?>IMG_0035 1-1.jpg" alt="Miniatura zdjęcia produktu 2" />
          </div>
          <div class="product-gallery__thumbnail">
            <img src="<?php w($w); ?>IMG_0035 1-2.jpg" alt="Miniatura zdjęcia produktu 3" />
          </div>
          <div class="product-gallery__thumbnail product-gallery__thumbnail--active">
            <img src="<?php w($w); ?>IMG_0112 1.jpg" alt="Miniatura zdjęcia produktu 4" />
          </div>
        </div>
      </div>
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              const mainImage = document.querySelector('.product-gallery__main-image');
              const thumbnails = document.querySelectorAll('.product-gallery__thumbnail img');
              const thumbnailWrappers = document.querySelectorAll('.product-gallery__thumbnail');

              thumbnails.forEach((thumb, idx) => {
                  thumb.addEventListener('click', function() {
                      mainImage.src = thumb.src;
                      // Zmień aktywną miniaturkę
                      thumbnailWrappers.forEach(w => w.classList.remove('product-gallery__thumbnail--active'));
                      thumbnailWrappers[idx].classList.add('product-gallery__thumbnail--active');
                  });
              });
          });
      </script>
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              const mainImage = document.querySelector('.product-gallery__main-image');
              const thumbnails = document.querySelectorAll('.product-gallery__thumbnail img');
              const thumbnailWrappers = document.querySelectorAll('.product-gallery__thumbnail');
              const prevBtn = document.querySelector('.product-gallery__nav-button--prev');
              const nextBtn = document.querySelector('.product-gallery__nav-button--next');
              let currentIdx = Array.from(thumbnailWrappers).findIndex(w => w.classList.contains('product-gallery__thumbnail--active'));
              if (currentIdx === -1) currentIdx = 0;

              function setActive(idx) {
                  mainImage.src = thumbnails[idx].src;
                  thumbnailWrappers.forEach(w => w.classList.remove('product-gallery__thumbnail--active'));
                  thumbnailWrappers[idx].classList.add('product-gallery__thumbnail--active');
                  currentIdx = idx;
              }

              thumbnails.forEach((thumb, idx) => {
                  thumb.addEventListener('click', function() {
                      setActive(idx);
                  });
              });

              prevBtn.addEventListener('click', function() {
                  let idx = (currentIdx - 1 + thumbnails.length) % thumbnails.length;
                  setActive(idx);
              });

              nextBtn.addEventListener('click', function() {
                  let idx = (currentIdx + 1) % thumbnails.length;
                  setActive(idx);
              });
          });
      </script>
      <div class="product-gallery__badges">
        <div class="badge badge--sale">-10%</div>
        <div class="badge badge--new">New</div>
      </div>
    </div>

    <div class="product-view__details">
      <div class="product-details__header">
        <h1 class="product-details__title"><?php echo $nazwaProduktu; ?></h1>
        <p class="product-details__subtitle">Ten upominek na pewno sprawi wiele radości. Wybierz zawieszkę, a my zadbamy o resztę!</p>
        <div class="product-details__status-labels">
          <span class="status-label status-label--available">dostępny</span>
<!--          <span class="status-label status-label--code">kod produktu: 75622</span>-->
          <span class="status-label status-label--code">kod produktu: <?php echo str_pad(abs(crc32($_SERVER['REQUEST_URI'])) % 100000, 5, '0', STR_PAD_LEFT); ?></span>
        </div>
      </div>

      <div class="product-details__options">
        <div class="product-options__row">
          <span class="product-options__label">Specyfikacja:</span>
          <span class="product-options__value">zwykły tekst</span>
        </div>
<!--        <div class="product-options__row">-->
<!--          <label for="smak" class="product-options__label">Smak:</label>-->
<!--          <div class="product-options__select">-->
<!--            <span>miód lipowy</span>-->
<!--            <img class="product-options__select-icon" src="--><?php //w($w); ?><!--arrow-down0.svg" alt="Rozwiń listę" />-->
<!--          </div>-->
<!--        </div>-->
        <div class="product-options__row">
          <label for="smak" class="product-options__label">Smak:</label>
          <div class="product-options__select">
            <select id="smak" name="smak" class="product-options__select-dropdown">
              <option value="1">miód <?php echo $rodzajMiodu ?? ''; ?></option>
              <option value="lipowy">miód lipowy</option>
              <option value="spadziowy">miód spadziowy</option>
              <option value="gryczany">miód gryczany</option>
            </select>
            <img class="product-options__select-icon" src="<?php w($w); ?>arrow-down0.svg" alt="Rozwiń listę" />
          </div>
        </div>
<!--        <div class="product-options__row">-->
<!--          <span class="product-options__label">Kolor opakowania:</span>-->
<!--          <div class="product-options__color-swatches">-->
<!--            <div class="color-swatch color-swatch--blue color-swatch--active"></div>-->
<!--            <div class="color-swatch color-swatch--black"></div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="product-options__row">-->
<!--          <span class="product-options__label">Wersja:</span>-->
<!--          <div class="product-options__buttons">-->
<!--            <button class="option-button option-button--active">dla Mamy</button>-->
<!--            <button class="option-button">dla Taty</button>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="product-options__row">-->
<!--          <span class="product-options__label">Gramatura miodu:</span>-->
<!--          <div class="product-options__buttons">-->
<!--            <button class="option-button option-button--active">40g</button>-->
<!--            <button class="option-button">1000g</button>-->
<!--            <button class="option-button">1200g</button>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

        <div class="product-options__row">
          <span class="product-options__label">Kolor opakowania:</span>
          <div class="product-options__color-swatches" id="color-swatches">
            <div class="color-swatch color-swatch--blue color-swatch--active" data-color="blue"></div>
            <div class="color-swatch color-swatch--black" data-color="black"></div>
          </div>
        </div>
        <div class="product-options__row">
          <span class="product-options__label">Wersja:</span>
          <div class="product-options__buttons" id="version-buttons">
            <button class="option-button option-button--active" data-version="mama">dla Mamy</button>
            <button class="option-button" data-version="tata">dla Taty</button>
          </div>
        </div>
        <div class="product-options__row">
          <span class="product-options__label">Gramatura miodu:</span>
          <div class="product-options__buttons" id="weight-buttons">
            <button class="option-button option-button--active" data-weight="40g">40g</button>
            <button class="option-button" data-weight="1000g">1000g</button>
            <button class="option-button" data-weight="1200g">1200g</button>
          </div>
        </div>
      </div>
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              // Kolor opakowania
              const swatches = document.querySelectorAll('#color-swatches .color-swatch');
              swatches.forEach(swatch => {
                  swatch.addEventListener('click', function() {
                      swatches.forEach(s => s.classList.remove('color-swatch--active'));
                      swatch.classList.add('color-swatch--active');
                  });
              });

              // Wersja
              const versionBtns = document.querySelectorAll('#version-buttons .option-button');
              versionBtns.forEach(btn => {
                  btn.addEventListener('click', function() {
                      versionBtns.forEach(b => b.classList.remove('option-button--active'));
                      btn.classList.add('option-button--active');
                  });
              });

              // Gramatura miodu
              const weightBtns = document.querySelectorAll('#weight-buttons .option-button');
              weightBtns.forEach(btn => {
                  btn.addEventListener('click', function() {
                      weightBtns.forEach(b => b.classList.remove('option-button--active'));
                      btn.classList.add('option-button--active');
                  });
              });
          });
      </script>


      <div class="product-details__price-section">
        <?php if ($oldPrice) { ?>
          <span class="price-section__old-price"><?php echo (float)$oldPrice; ?> <?php echo $currency; ?></span>
        <?php } ?>
        <div class="price-section__main">
          <span class="price-section__current-price"><?php echo number_format((float)str_replace(',','.', $newPrice), 2, ',',''); ?> <?php echo $currency; ?></span>
          <?php if ($oldPrice) { ?>
          <span class="badge badge--sale">10% rabatu</span>
          <?php } ?>
        </div>
        <?php if ($oldPrice) { ?>
        <p class="price-section__legal-note">Najniższa cena przed rabatem z ostatnich 30 dni: 50<?php echo $currency; ?></p>
        <?php } ?>
      </div>

      <div class="product-details__actions">
        <label class="product-actions__quantity-label">Ilość:</label>
        <div class="product-actions__controls">
          <div class="quantity-selector">
            <button class="quantity-selector__button quantity-selector__button--decrement" aria-label="Zmniejsz ilość">-</button>
            <input type="text" value="1" class="quantity-selector__input" aria-label="Ilość produktu">
            <button class="quantity-selector__button quantity-selector__button--increment" aria-label="Zwiększ ilość">+</button>
          </div>
          <button class="add-to-cart-button button-add-to-cart">
            <img class="add-to-cart-button__icon" src="<?php w($w); ?>shopping-cart-3596860.svg" alt="" />
            <span class="add-to-cart-button__text">Dodaj do koszyka</span>
          </button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const decrementBtn = document.querySelector('.quantity-selector__button--decrement');
                const incrementBtn = document.querySelector('.quantity-selector__button--increment');
                const input = document.querySelector('.quantity-selector__input');

                decrementBtn.addEventListener('click', function() {
                    let value = parseInt(input.value, 10) || 1;
                    if (value > 1) input.value = value - 1;
                });

                incrementBtn.addEventListener('click', function() {
                    let value = parseInt(input.value, 10) || 1;
                    input.value = value + 1;
                });

                input.addEventListener('input', function() {
                    let value = parseInt(input.value, 10);
                    if (isNaN(value) || value < 1) input.value = 1;
                });
            });
        </script>
      </div>

      <div class="product-details__share">
        <span class="product-share__label">udostępnij:</span>
        <div class="product-share__icons">
          <a href="#" class="share-icon"><img src="<?php w($w); ?>group0.svg" alt="Udostępnij na Facebooku" /></a>
          <a href="#" class="share-icon"><img src="<?php w($w); ?>group1.svg" alt="Udostępnij na Twitterze" /></a>
          <a href="#" class="share-icon"><img src="<?php w($w); ?>group2.svg" alt="Udostępnij na Pintereście" /></a>
        </div>
      </div>

      <div class="product-details__usp">
        <div class="usp__item">
          <img class="usp__icon" src="<?php w($w); ?>shopping-online-65403530.svg" alt="Ikona zwrotów" />
          <p class="usp__text">Łatwa polityka zwrotów bez zadawania pytań</p>
        </div>
        <div class="usp__item">
          <img class="usp__icon" src="<?php w($w); ?>delivery-truck-151736160.svg" alt="Ikona dostawy" />
          <p class="usp__text">Zamów przed godziną 18:00, aby otrzymać ekspresową dostawę</p>
        </div>
        <div class="usp__item">
          <img class="usp__icon" src="<?php w($w); ?>quality-assurance-92857230.svg" alt="Ikona jakości" />
          <p class="usp__text">Dostarczamy najlepszej jakości, ręcznie wybierane produkty</p>
        </div>
      </div>
    </div>
  </div>

<!--  <div class="product-description-section">-->
<!--    <div class="product-description__tabs">-->
<!--      <button class="product-description__tab product-description__tab--active">Opis produktu</button>-->
<!--      <button class="product-description__tab">Szczegółowy opis</button>-->
<!--    </div>-->
<!--    <div class="product-description__content">-->
<!--      <div class="product-description__column">-->
<!--        <h2 class="product-description__heading">Bo za troskę, czułość i obecność nie sposób wystarczająco podziękować…</h2>-->
<!--        <p class="product-description__paragraph">Ten zestaw* to coś więcej niż słodki upominek – to gest wdzięczności. Dla Mamy, która zawsze była obok. Dla Taty, który wspierał w każdej chwili. Wybierz spośród 21 rodzajów cud miodów – naturalnych kompozycji miodu z liofilizowanymi owocami i aromatycznymi przyprawami. Naturalny, delikatny miód z dodatkami liofilizowanych owoców – piękne nie tylko w smaku, ale i w formie.</p>-->
<!--        <p class="product-description__paragraph">A na koniec przewiązaliśmy <strong>różową lub niebieską wstążką</strong> do wyboru – z zawieszkami dobranymi kolorystycznie - bo detale mają znaczenie, a prezent ma cieszyć już od pierwszego spojrzenia.</p>-->
<!--        <p class="product-description__paragraph"><strong>Dla Mamy</strong> – za czułość, troskę i bezwarunkową obecność<br><strong>Dla Taty</strong> – za siłę, spokój i niezawodne wsparcie<br>Zapakowany w eleganckie pudełko z tektury, przewiązane <strong>wstążkami</strong>, stanie się symbolicznym „dziękuję” – za wszystko, co niewypowiedziane.</p>-->
<!--      </div>-->
<!--      <div class="product-description__column">-->
<!--        <div class="options-list">-->
<!--          <h3 class="options-list__heading">Wybierz spośród:</h3>-->
<!--          <ul class="options-list__list">-->
<!--            <li class="options-list__item">cud miód - hibiskus z pomarańczą 250g</li>-->
<!--            <li class="options-list__item">cud miód - szarlotka jabłko z cynamonem 250g</li>-->
<!--            <li class="options-list__item">cud miód - pokrzywa 250g</li>-->
<!--          </ul>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="product-description__column">-->
<!--        <div class="video-section">-->
<!--          <h3 class="video-section__heading">Można tu dać zdjecie bądź wideo</h3>-->
<!--          <div class="video-player">-->
<!--            <img class="video-player__thumbnail" src="--><?php //w($w); ?><!--image-850.png" alt="Miniatura wideo produktu" />-->
<!--            <button class="video-player__play-button" aria-label="Odtwórz wideo">-->
<!--              <img src="--><?php //w($w); ?><!--button-play-svg0.svg" alt="Ikona Play" />-->
<!--            </button>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->

  <div class="product-description-section">
    <div class="product-description__tabs">
      <button class="product-description__tab product-description__tab--active" data-tab="opis">Opis produktu</button>
      <button class="product-description__tab" data-tab="szczegoly">Szczegółowy opis</button>
    </div>
    <div class="product-description__content">
      <div class="product-description__column tab-content tab-content--opis" style="display: block;">
        <h2 class="product-description__heading">Bo za troskę, czułość i obecność nie sposób wystarczająco podziękować…</h2>
        <p class="product-description__paragraph">Ten zestaw* to coś więcej niż słodki upominek – to gest wdzięczności. Dla Mamy, która zawsze była obok. Dla Taty, który wspierał w każdej chwili. Wybierz spośród 21 rodzajów cud miodów – naturalnych kompozycji miodu z liofilizowanymi owocami i aromatycznymi przyprawami. Naturalny, delikatny miód z dodatkami liofilizowanych owoców – piękne nie tylko w smaku, ale i w formie.</p>
        <p class="product-description__paragraph">A na koniec przewiązaliśmy <strong>różową lub niebieską wstążką</strong> do wyboru – z zawieszkami dobranymi kolorystycznie - bo detale mają znaczenie, a prezent ma cieszyć już od pierwszego spojrzenia.</p>
        <p class="product-description__paragraph"><strong>Dla Mamy</strong> – za czułość, troskę i bezwarunkową obecność<br><strong>Dla Taty</strong> – za siłę, spokój i niezawodne wsparcie<br>Zapakowany w eleganckie pudełko z tektury, przewiązane <strong>wstążkami</strong>, stanie się symbolicznym „dziękuję” – za wszystko, co niewypowiedziane.</p>
      </div>
      <div class="product-description__column tab-content tab-content--szczegoly" style="display: none;">
        <h2 class="product-description__heading">Bo za troskę, czułość i obecność nie sposób wystarczająco podziękować…</h2>
        <p class="product-description__paragraph">Ten zestaw* to coś więcej niż słodki upominek – to gest wdzięczności. Dla Mamy, która zawsze była obok. Dla Taty, który wspierał w każdej chwili. Wybierz spośród 21 rodzajów cud miodów – naturalnych kompozycji miodu z liofilizowanymi owocami i aromatycznymi przyprawami. Naturalny, delikatny miód z dodatkami liofilizowanych owoców – piękne nie tylko w smaku, ale i w formie.</p>
        <p class="product-description__paragraph">A na koniec przewiązaliśmy <strong>różową lub niebieską wstążką</strong> do wyboru – z zawieszkami dobranymi kolorystycznie - bo detale mają znaczenie, a prezent ma cieszyć już od pierwszego spojrzenia.</p>
        <p class="product-description__paragraph"><strong>Dla Mamy</strong> – za czułość, troskę i bezwarunkową obecność<br><strong>Dla Taty</strong> – za siłę, spokój i niezawodne wsparcie<br>Zapakowany w eleganckie pudełko z tektury, przewiązane <strong>wstążkami</strong>, stanie się symbolicznym „dziękuję” – za wszystko, co niewypowiedziane.</p>
      </div>
      <div class="product-description__column tab-content tab-content--wybor" style="display: block;">
        <div class="options-list">
          <h3 class="options-list__heading">Wybierz spośród:</h3>
          <ul class="options-list__list">
            <li class="options-list__item">cud miód - hibiskus z pomarańczą 250g</li>
            <li class="options-list__item">cud miód - szarlotka jabłko z cynamonem 250g</li>
            <li class="options-list__item">cud miód - pokrzywa 250g</li>
          </ul>
        </div>
      </div>
      <div class="product-description__column tab-content tab-content--wideo" style="display: block;">
        <div class="video-section">
          <h3 class="video-section__heading">Można tu dać zdjecie bądź wideo</h3>
          <div class="video-player">
            <img class="video-player__thumbnail" src="<?php w($w); ?>image-850.png" alt="Miniatura wideo produktu" />
            <button class="video-player__play-button" aria-label="Odtwórz wideo">
              <img src="<?php w($w); ?>button-play-svg0.svg" alt="Ikona Play" />
            </button>
          </div>
        </div>
      </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.product-description__tab');
            const opis = document.querySelector('.tab-content--opis');
            const szczegoly = document.querySelector('.tab-content--szczegoly');
            const wybor = document.querySelector('.tab-content--wybor');
            const wideo = document.querySelector('.tab-content--wideo');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('product-description__tab--active'));
                    tab.classList.add('product-description__tab--active');
                    if (tab.dataset.tab === 'opis') {
                        opis.style.display = 'block';
                        wybor.style.display = 'block';
                        wideo.style.display = 'block';
                        szczegoly.style.display = 'none';
                    } else {
                        opis.style.display = 'none';
                        szczegoly.style.display = 'block';
                        wybor.style.display = 'none';
                        wideo.style.display = 'none';
                    }
                });
            });
        });
    </script>
  </div>


  <div class="product-comments-section">
    <h2 class="product-comments__title">
      <img class="product-comments__icon" src="<?php w($w); ?>icon1.svg" alt="" />
      Komentarze (3)
    </h2>

    <div class="comment-item">
      <div class="comment-item__author-info">
        <img class="comment-author__rating" src="<?php w($w); ?>stars0.svg" alt="Ocena: 5 na 5 gwiazdek" />
        <div class="comment-author__meta">
          17.07.2025, 16:15<br>
          przez: Awokado12
        </div>
      </div>
      <div class="comment-item__body">
        <h4 class="comment-body__title">Bardzo dobry produkt i szybka wysyłka</h4>
        <p class="comment-body__text">Magna dui sodales cras hendrerit massa netus non purus neque. Tristique consectetur ac ut eget. Iaculis in orci sed etiam turpis quis amet. Hac eget laoreet quisque nisl. Quam ullamcorper euismod urna fusce egestas arcu. Eros lacus arcu sed egestas imperdiet varius. Amet ut enim scelerisque nec faucibus ipsum. Rutrum volutpat enim amet nam neque mi egestas bibendum. Adipiscing id imperdiet quam aliquet odio amet.</p>
        <div class="comment-body__actions">
          <button class="comment-action"><img src="<?php w($w); ?>icon2.svg" alt="Lubię to" /> 0</button>
          <button class="comment-action"><img src="<?php w($w); ?>icon3.svg" alt="Nie lubię tego" /> 0</button>
          <button class="comment-action"><img src="<?php w($w); ?>icon4.svg" alt="Odpowiedz" /></button>
        </div>
      </div>
    </div>

    <div class="comment-item">
      <div class="comment-item__author-info">
        <img class="comment-author__rating" src="<?php w($w); ?>stars0.svg" alt="Ocena: 5 na 5 gwiazdek" />
        <div class="comment-author__meta">
          18.07.2025, 11:18<br>
          przez: Awokado12
        </div>
      </div>
      <div class="comment-item__body">
        <h4 class="comment-body__title">Wysokiej Jakości Produkt W Najlepszej Cenie</h4>
        <p class="comment-body__text">Nunc morbi fermentum id odio vulputate dolor in. Tellus lectus mollis sed id nibh. Laoreet arcu pellentesque iaculis proin. Ultricies vitae rhoncus non in proin. Neque purus et praesent amet cursus egestas adipiscing ornare. Tellus sit tortor dolor vel morbi sit ipsum ullamcorper. Nunc phasellus ipsum nulla sit pulvinar mi amet.</p>
        <div class="comment-body__actions">
          <button class="comment-action"><img src="<?php w($w); ?>icon2.svg" alt="Lubię to" /> 0</button>
          <button class="comment-action"><img src="<?php w($w); ?>icon3.svg" alt="Nie lubię tego" /> 0</button>
          <button class="comment-action"><img src="<?php w($w); ?>icon4.svg" alt="Odpowiedz" /></button>
        </div>
      </div>
    </div>
    <div class="comment-item">
      <div class="comment-item__author-info">
        <img class="comment-author__rating" src="<?php w($w); ?>stars0.svg" alt="Ocena: 5 na 5 gwiazdek" />
        <div class="comment-author__meta">
          27.08.2025, 13:22<br>
          przez: Awokado12
        </div>
      </div>
      <div class="comment-item__body">
        <h4 class="comment-body__title">Świetny produkt 👍✨</h4>
        <p class="comment-body__text">Eu nunc pulvinar mauris id. Vestibulum eget amet eget sed sed vitae quis porta. Eu enim nec nunc dapibus mattis mauris consectetur amet consequat. Diam enim nisi aliquam cursus ut egestas scelerisque eget pellentesque. Posuere consequat lectus ut urna volutpat purus faucibus id sapien. Urna quis auctor dolor vitae lorem. Placerat tellus sed tincidunt urna. </p>
        <div class="comment-body__actions">
          <button class="comment-action"><img src="<?php w($w); ?>icon2.svg" alt="Lubię to" /> 0</button>
          <button class="comment-action"><img src="<?php w($w); ?>icon3.svg" alt="Nie lubię tego" /> 0</button>
          <button class="comment-action"><img src="<?php w($w); ?>icon4.svg" alt="Odpowiedz" /></button>
        </div>
      </div>
    </div>

  </div>

<div class="container">
  <?php include PART . 'slider-products.php'; ?>
  <br>
  <br>
  <br>
</div>

</section>