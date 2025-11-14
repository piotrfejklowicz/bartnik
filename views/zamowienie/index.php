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

//function generate_product_url($title, $slug) {
//  return '/product/' . $slug . '?t=' . urlencode($title);
//}


$viewMode = $_COOKIE['productViewMode'] ?? 'grid';


?>
<link rel="stylesheet" href="<?php css($w, 'style.css'); ?>">
<!--<link rel="stylesheet" href="--><?php //css($w, 'style-lg-.css'); echo VERSION; ?><!--" media="screen and (min-width: 66.01rem)">-->
<link rel="stylesheet" href="<?php css($w, 'style-md.css'); echo VERSION; ?>" media="screen and (max-width: 66rem)">
<!--<link rel="stylesheet" href="--><?php //css($w, 'style-t.css'); echo VERSION; ?><!--" media="screen and (min-width: 44.01rem) and (max-width: 66rem)">-->
<link rel="stylesheet" href="<?php css($w, 'style-sm.css'); echo VERSION; ?>" media="screen and (max-width: 44rem)">


<div class="page-checkout">
  <header class="page-header">
    <div class="container page-wrapper">
      <img class="page-header__background" src="<?php w($w); ?>honey-shape0.svg" alt="Tło w kształcie plastra miodu">
      <h1 class="page-header__title">Zamówienie</h1>
    </div>
  </header>
  <div class="page-wrapper">
    <form id="checkout-form">
      <main class="checkout-container">
        <div class="checkout-main">
          <div class="checkout-tabs">
            <section id="step-1" class="checkout-step">
              <header class="checkout-step__header" data-step="1">
                <img src="<?php w($w); ?>check0.svg" alt="Check icon" class="header-check">
                <h2>1. Dane osobowe</h2>
              </header>
              <div class="checkout-step__content">
                <div class="auth-options">
                  <a href="#" class="auth-option">Zamówienie jako gość</a>
                  <span class="auth-separator"></span>
                  <a href="/moje-konto" class="auth-option auth-option--highlight">Zaloguj się</a>
                </div>
                <div class="form-row">
                  <label class="form-label">Tytuł</label>
                  <div class="radio-group">
                    <label class="radio-label"><input type="radio" name="personal_data[title]" value="pan"> Pan</label>
                    <label class="radio-label"><input type="radio" name="personal_data[title]" value="pani" checked> Pani</label>
                  </div>
                </div>
                <div class="form-row">
                  <label class="form-label" for="first_name">Imię*</label>
                  <input type="text" id="first_name" name="personal_data[first_name]" class="form-control" required>
                </div>
                <div class="form-row">
                  <label class="form-label" for="last_name">Nazwisko*</label>
                  <input type="text" id="last_name" name="personal_data[last_name]" class="form-control" required>
                </div>
                <div class="form-row">
                  <label class="form-label" for="email">E-mail*</label>
                  <input type="email" id="email" name="personal_data[email]" class="form-control" required>
                </div>
                <div class="form-row">
                  <label class="form-label" for="password">Hasło (opcjonalnie)</label>
                  <div class="wrapper">
                    <div class="password-wrapper">
                      <input type="password" id="password" name="personal_data[password]" class="form-control">
                      <button type="button" class="password-toggle">pokaż</button>
                    </div>

                    <div class="checkboxes">
                      <div class="form-row">
                        <label class="checkbox-label"><input type="checkbox" name="personal_data[offers]"> Otrzymuj oferty od naszych partnerów</label>
                      </div>
                      <div class="form-row">
                        <label class="checkbox-label"><input type="checkbox" name="personal_data[newsletter]"> Zapisz się do newslettera</label>
                        <p class="form-hint">Możesz zrezygnować z subskrypcji w dowolnym momencie.</p>
                      </div>
                      <div class="form-row">
                        <label class="checkbox-label"><input type="checkbox" name="personal_data[terms]" required> Zgadzam się z <a href="#">regulaminem</a> i <a href="#">polityką prywatności</a>.</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="button" class="button-primary next-step-btn" data-next="2">Dalej</button>
                </div>
              </div>
            </section>

            <section id="step-2" class="checkout-step">
              <header class="checkout-step__header" data-step="2">
                <img src="<?php w($w); ?>check0.svg" alt="Check icon" class="header-check">
                <h2>2. Adresy</h2>
              </header>
              <div class="checkout-step__content">
                <p class="form-hint">Wybrany adres będzie stosowany zarówno jako adres osobisty (do faktury) i jako adres dostawy.</p>
                <div class="form-row">
                  <label class="form-label" for="address">Adres*</label>
                  <input type="text" id="address" name="address_data[address]" class="form-control" required>
                </div>
                <div class="form-row">
                  <label class="form-label" for="address_complement">Uzupełnienie adresu</label>
                  <input type="text" id="address_complement" name="address_data[address_complement]" class="form-control">
                </div>
                <div class="form-row">
                  <label class="form-label" for="postcode">Kod pocztowy*</label>
                  <input type="text" id="postcode" name="address_data[postcode]" class="form-control" required>
                </div>
                <div class="form-row">
                  <label class="form-label" for="city">Miasto*</label>
                  <input type="text" id="city" name="address_data[city]" class="form-control" required>
                </div>
                <div class="form-row">
                  <label class="form-label" for="country">Państwo*</label>
                  <select id="country" name="address_data[country]" class="form-control" required>
                    <option value="Polska">Polska</option>
                  </select>
                </div>
                <div class="form-row">
                  <label class="form-label" for="phone">Telefon</label>
                  <input type="tel" id="phone" name="address_data[phone]" class="form-control">
                </div>
                <div class="form-actions">
                  <button type="button" class="button-primary next-step-btn" data-next="3">Dalej</button>
                </div>
              </div>
            </section>

            <section id="step-3" class="checkout-step">
              <header class="checkout-step__header" data-step="3">
                <img src="<?php w($w); ?>check0.svg" alt="Check icon" class="header-check">
                <h2>3. Sposób dostawy</h2>
              </header>
              <div class="checkout-step__content">
                <div class="shipping-options">
                  <label class="shipping-option">
                    <input type="radio" name="shipping_method" value="dhl" checked>
                    <span class="shipping-option__details">
                                            <strong>DHL</strong>
                                            <span>Dostawa <?php
                                              // Oblicz 2. najbliższy dzień roboczy od dziś
                                              $date = new DateTime();
                                              $businessDays = 0;
                                              while ($businessDays < 2) {
                                                $date->modify('+1 day');
                                                if (!in_array($date->format('N'), [6,7])) { // 6 = sobota, 7 = niedziela
                                                  $businessDays++;
                                                }
                                              }
                                              // Polskie miesiące
                                              $months = [
                                                1 => 'Stycznia', 2 => 'Lutego', 3 => 'Marca', 4 => 'Kwietnia', 5 => 'Maja', 6 => 'Czerwca',
                                                7 => 'Lipca', 8 => 'Sierpnia', 9 => 'Września', 10 => 'Października', 11 => 'Listopada', 12 => 'Grudnia'
                                              ];
                                              echo $date->format('j') . ' ' . $months[(int)$date->format('n')] . ' ' . $date->format('Y');
                                            ?></span>
                                        </span>
                    <span class="shipping-option__price">15,00 zł</span>
                  </label>
                  <label class="shipping-option">
                    <input type="radio" name="shipping_method" value="inpost">
                    <span class="shipping-option__details">
                                            <strong>Inpost</strong>
                                            <span>Dostawa następnego dnia!</span>
                                        </span>
                    <span class="shipping-option__price">14,99 zł</span>
                  </label>
                </div>
                <div class="form-actions">
                  <button type="button" class="button-primary next-step-btn" data-next="4">Dalej</button>
                </div>
              </div>
            </section>

            <section id="step-4" class="checkout-step">
              <header class="checkout-step__header" data-step="4">
                <img src="<?php w($w); ?>check0.svg" alt="Check icon" class="header-check">
                <h2>4. Płatność</h2>
              </header>
              <div class="checkout-step__content">
                <div class="payment-options">
                  <label class="payment-option">
                    <input type="radio" name="payment_method" value="card">
                    <span>Zapłać kartą</span>
                  </label>
                  <label class="payment-option">
                    <input type="radio" name="payment_method" value="transfer">
                    <span>Zapłać przelewem</span>
                  </label>
                  <label class="payment-option">
                    <input type="radio" name="payment_method" value="cash" checked>
                    <div class="payment-option__details">
                      <strong>Zapłać gotówką przy odbiorze</strong>
                      <span>Płacisz za towar przy dostawie</span>
                    </div>
                  </label>
                </div>
                <div class="form-row">
                  <label class="checkbox-label">
                    <input type="checkbox" name="terms_final" required> Zgadzam się z <a href="#">warunkami świadczenia usług</a>.
                  </label>
                </div>
                <div class="form-actions">
                  <button type="submit" class="button-primary">Złóż zamówienie</button>
                </div>
              </div>
            </section>
          </div>
        </div>

        <aside class="checkout-sidebar">
          <?php
          // --- POCZĄTEK LOGIKI PHP ---

          // Załóżmy, że te zmienne są dostępne; jeśli nie, zdefiniuj je
          if (!isset($w)) $w = __DIR__;
          if (!isset($currency)) $currency = 'zł';

          // Stała dla kosztu wysyłki, łatwa do zmiany w jednym miejscu
          define('SHIPPING_COST', 14.99);

          // Pobierz dane koszyka z ciasteczka lub utwórz pustą tablicę
          $cart = isset($_COOKIE['cartProducts']) ? json_decode(urldecode($_COOKIE['cartProducts']), true) : [];
          if (!is_array($cart)) {
            $cart = [];
          }

          // Funkcja do poprawnej odmiany słowa "produkt"
          function getProductPlural(int $count): string {
            if ($count === 1) return 'produkt';
            $lastDigit = $count % 10;
            $lastTwoDigits = $count % 100;
            if ($lastDigit >= 2 && $lastDigit <= 4 && ($lastTwoDigits < 12 || $lastTwoDigits > 14)) {
              return 'produkty';
            }
            return 'produktów';
          }

          // Inicjalizacja zmiennych do obliczeń
          $productsSubtotal = 0;
          $totalItems = 0;

          // Oblicz sumy na podstawie zawartości koszyka
          if (!empty($cart)) {
            foreach ($cart as $product) {
              $quantity = (int)$product['quantity'];
              $priceStr = explode('|', $product['price'])[1]; // Bierzemy nową cenę
              $priceForCalc = (float)str_replace(',', '.', preg_replace('/[^\d,]/', '', $priceStr));

              $productsSubtotal += $priceForCalc * $quantity;
              $totalItems += $quantity;
            }
          }

          $grandTotal = $productsSubtotal + SHIPPING_COST;

          // --- KONIEC LOGIKI PHP ---
          ?>

          <?php if (empty($cart)): ?>
            <p>Twój koszyk jest pusty. Nie możesz złożyć zamówienia.</p>
          <?php else: ?>
            <div class="order-summary">
              <div class="order-summary__header">
                <h3><?php echo $totalItems; ?> <?php echo getProductPlural($totalItems); ?></h3>
                <button type="button" id="toggle-details" class="details-toggle">pokaż szczegóły <img src="<?php w($w); ?>arrow-down0.svg" alt="Rozwiń szczegóły"></button>
              </div>

              <div id="summary-details" class="order-summary__details">
                <?php foreach ($cart as $product): ?>
                  <?php
                  // Oblicz cenę dla pojedynczej pozycji
                  $quantity = (int)$product['quantity'];
                  $priceStr = explode('|', $product['price'])[1];
                  $priceFormatted = htmlspecialchars($priceStr);
                  ?>
                  <div class="summary-product">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="summary-product__image">
                    <div class="summary-product__info">
                      <p><?php echo htmlspecialchars($product['name']); ?> x<?php echo $quantity; ?></p>
                      <p class="price__current"><?php echo $priceFormatted; ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="order-summary__totals">
                <div class="summary-row">
                  <span>Produkty</span>
                  <span><?php echo number_format($productsSubtotal, 2, ',', ' '); ?> <?php echo $currency; ?></span>
                </div>
                <div class="summary-row">
                  <span>Wysyłka</span>
                  <span><?php echo number_format(SHIPPING_COST, 2, ',', ' '); ?> <?php echo $currency; ?></span>
                </div>
                <hr>
                <div class="summary-row summary-row--total">
                  <strong>Suma (brutto)</strong>
                  <strong><?php echo number_format($grandTotal, 2, ',', ' '); ?> <?php echo $currency; ?></strong>
                </div>
              </div>
            </div>

            <script>
                // Prosty skrypt do przełączania widoczności szczegółów zamówienia
                const toggleButton = document.getElementById('toggle-details');
                const detailsContainer = document.getElementById('summary-details');
                const toggleImage = toggleButton.querySelector('img');

                if (toggleButton && detailsContainer) {
                    toggleButton.addEventListener('click', () => {
                        const isHidden = detailsContainer.style.display === 'none';
                        detailsContainer.style.display = isHidden ? 'block' : 'none';
                        toggleButton.childNodes[0].nodeValue = isHidden ? 'ukryj szczegóły ' : 'pokaż szczegóły ';
                        toggleImage.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                    });
                }
            </script>
          <?php endif; ?>



          <div class="usp-blocks">
            <div class="usp-block">
              <img class="usp-block__icon" src="<?php w($w); ?>shopping-online-65403530.svg" alt="Ikona polityki zwrotów">
              <div class="usp-block__text">
                <h4>Polityka zwrotów</h4>
                <p>Łatwa polityka zwrotów bez zadawania pytań</p>
              </div>
            </div>
            <div class="usp-block">
              <img class="usp-block__icon" src="<?php w($w); ?>delivery-truck-151736160.svg" alt="Ikona dostawy">
              <div class="usp-block__text">
                <h4>Dostawa</h4>
                <p>Zamów przed godziną 18:00, aby otrzymać ekspresową dostawę</p>
              </div>
            </div>
          </div>
        </aside>
      </main>
    </form>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('checkout-form');
        const steps = document.querySelectorAll('.checkout-step');
        const stepHeaders = document.querySelectorAll('.checkout-step__header');
        const nextButtons = document.querySelectorAll('.next-step-btn');
        const STORAGE_KEY = 'checkoutFormData';

        /**
         * Zapisuje cały stan formularza do localStorage.
         */
        const saveData = () => {
            const data = {
                personal_data: {},
                address_data: {},
                shipping_method: '',
                payment_method: '',
                current_step: 1
            };

            const formData = new FormData(form);
            for (const [key, value] of formData.entries()) {
                const matchPersonal = key.match(/^personal_data\[(.*?)\]$/);
                if (matchPersonal) {
                    data.personal_data[matchPersonal[1]] = value;
                    continue;
                }

                const matchAddress = key.match(/^address_data\[(.*?)\]$/);
                if (matchAddress) {
                    data.address_data[matchAddress[1]] = value;
                    continue;
                }

                if (key === 'shipping_method' || key === 'payment_method') {
                    data[key] = value;
                }
            }

            // Zapisz zaznaczenie checkboxów
            form.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                const matchPersonal = checkbox.name.match(/^personal_data\[(.*?)\]$/);
                if(matchPersonal) {
                    data.personal_data[matchPersonal[1]] = checkbox.checked;
                }
            });


            const activeStepEl = document.querySelector('.checkout-step.active');
            data.current_step = activeStepEl ? parseInt(activeStepEl.dataset.step || activeStepEl.id.split('-')[1]) : 1;

            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        };

        /**
         * Wczytuje dane z localStorage i uzupełnia formularz.
         */
        const loadData = () => {
            const savedDataJSON = localStorage.getItem(STORAGE_KEY);
            if (!savedDataJSON) {
                updateStepDisplay(1);
                return;
            }

            const data = JSON.parse(savedDataJSON);

            // Uzupełnij dane osobowe
            if (data.personal_data) {
                for (const key in data.personal_data) {
                    const field = form.querySelector(`[name="personal_data[${key}]"]`);
                    if (field) {
                        if (field.type === 'radio') {
                            const radioToSelect = form.querySelector(`[name="personal_data[${key}]"][value="${data.personal_data[key]}"]`);
                            if(radioToSelect) radioToSelect.checked = true;
                        } else if (field.type === 'checkbox') {
                            field.checked = data.personal_data[key];
                        } else {
                            field.value = data.personal_data[key];
                        }
                    }
                }
            }

            // Uzupełnij dane adresowe
            if (data.address_data) {
                for (const key in data.address_data) {
                    const field = form.querySelector(`[name="address_data[${key}]"]`);
                    if(field) field.value = data.address_data[key];
                }
            }

            // Zaznacz metody dostawy i płatności
            if (data.shipping_method) {
                form.querySelector(`[name="shipping_method"][value="${data.shipping_method}"]`).checked = true;
            }
            if (data.payment_method) {
                form.querySelector(`[name="payment_method"][value="${data.payment_method}"]`).checked = true;
            }

            updateStepDisplay(data.current_step || 1);
        };

        /**
         * Aktualizuje, który krok jest widoczny.
         */
        const updateStepDisplay = (currentStepNum) => {
            steps.forEach(step => {
                const stepNum = parseInt(step.id.split('-')[1]);
                const header = document.querySelector(`.checkout-step__header[data-step="${stepNum}"]`);

                if (stepNum === currentStepNum) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }

                if (stepNum < currentStepNum) {
                    header.classList.add('completed');
                } else {
                    header.classList.remove('completed');
                }
            });
            saveData();
        };

        // --- Pozostałe skrypty UI ---

        const toggleButton = document.getElementById('toggle-details');
        const detailsPanel = document.getElementById('summary-details');
        if (toggleButton && detailsPanel) {
            toggleButton.addEventListener('click', function() {
                const isHidden = detailsPanel.style.display === 'none';
                detailsPanel.style.display = isHidden ? 'block' : 'none';
                this.querySelector('img').style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                this.firstChild.textContent = isHidden ? 'ukryj szczegóły ' : 'pokaż szczegóły ';
            });
            toggleButton.click();
        }

        const passwordToggles = document.querySelectorAll('.password-toggle');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.textContent = 'ukryj';
                } else {
                    passwordInput.type = 'password';
                    this.textContent = 'pokaż';
                }
            });
        });

        // --- GŁÓWNE EVENT LISTENERY ---

        form.addEventListener('input', saveData);

        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                const nextStep = parseInt(button.dataset.next);
                updateStepDisplay(nextStep);
            });
        });

        stepHeaders.forEach(header => {
            header.addEventListener('click', function() {
                // Pozwól na nawigację tylko do ukończonych kroków
                if (this.classList.contains('completed')) {
                    const stepToShow = parseInt(this.dataset.step);
                    updateStepDisplay(stepToShow);
                }
            });
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            saveData(); // Zapisz ostatnie zmiany przed wysłaniem
            const finalData = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');

            console.log('--- ZAMÓWIENIE ZŁOŻONE ---');
            console.log('Dane do wysłania na serwer:', finalData);
            alert('Zamówienie zostało złożone! Sprawdź konsolę przeglądarki (F12), aby zobaczyć dane.');

            localStorage.removeItem(STORAGE_KEY);
            window.location.reload();
        });

        // --- INICJALIZACJA ---
        loadData();
    });
</script>

