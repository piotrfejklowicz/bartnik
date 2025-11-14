<img class="scroll-indicator" src="/img/scroll0.svg" alt="">
<footer class="footer">
  <div class="footer-perks">
    <div class="perk">
      <img src="/img/return0.svg" alt="">
      <p>*10-dniowa polityka zwrotów</p>
    </div>
    <div class="perk">
      <img src="/img/fast-delivery0.svg" alt="">
      <p>BEZPŁATNA WYSYŁKA przy zakupach powyżej 250 PLN!</p>
    </div>
    <div class="perk">
      <img src="/img/award0.svg" alt="">
      <p>Produkty sprawdzone pod kątem jakości</p>
    </div>
    <div class="perk">
      <img src="/img/credit-card0.svg" alt="">
      <p>Bezpieczny system płatności</p>
    </div>
  </div>
  <div class="footer-main">
    <img class="footer-bg-shape" src="/img/honey-shape0.svg" alt="">
    <div class="footer-columns">
      <div class="footer-column">
        <h3>Bartnik</h3>
        <ul>
          <li><img src="/img/pin0.svg" alt=""> Gospodarstwo Pasieczne“Sądecki Bartnik”<br>sp. z o.o.33-331 Stróże 235, Polska</li>
          <li><img src="/img/phones0.svg" alt=""> 18 414 05 50 / +48 666 378 629</li>
          <li><img src="/img/email1.svg" alt=""> sklep@bartnik.pl</li>
        </ul>

        <div class="footer-box socialicons">
          <a href="https://www.facebook.com/sadecki.bartnik/" class="facebook" target="_blank" rel="nofollow noopener noreferrer" aria-label="facebook">
            <span class="svg" style="--mask: url(/img/facebook.svg)"></span>
          </a>
          <a href="https://www.instagram.com/miodysadeckibartnik/" class="instagram" target="_blank" rel="nofollow noopener noreferrer" aria-label="instagram">
            <span class="svg" style="--mask: url(/img/instagram.svg)"></span>
          </a>
          <a href="https://www.youtube.com/user/sadeckibartnik" class="youtube" target="_blank" rel="nofollow noopener noreferrer" aria-label="youtube">
            <span class="svg" style="--mask: url(/img/youtube.svg)"></span>
          </a>
        </div>
      </div>
      <div class="footer-column">
        <h3>Popularne</h3>
        <ul>
          <li><a href="#">Bestsellery</a></li>
          <li><a href="#">MEGA okazje</a></li>
          <li><a href="#">Promocje</a></li>
          <li><a href="#">Świeczki z wosku</a></li>
          <li><a href="#">Propolis - krople</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Informacje</h3>
        <ul>
          <li><a href="#">Wysyłka i zwroty</a></li>
          <li><a href="/polityka-prywatnosci">Polityka prywatności</a></li>
          <li><a href="#">Regulamin</a></li>
          <li><a href="#">O nas</a></li>
          <li><a href="#">Kontakt</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <img class="vet-logo" src="/img/image-810.png" alt="Logo inspekcji weterynaryjnej">
        <a href="#">www.wiw.krakow.pl</a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
      <?php $date = date('Y') === '2025' ? date('Y') : '2025 - ' . date('Y'); ?>
    <p class="copyright">&copy; <?php echo $date; ?> Copyright Sklep Bartnik.. All rights reserved. Designed by Diamond Creators</p>
    <!-- Designed by Diamond Creators and Development by CyberDream -->
    <img src="/img/frame-17580.svg" alt="Akceptowane metody płatności">
  </div>

</footer>
  <div id="cart-modal-container" class="modal-overlay">
  <?php include PART.'cart-modal/index.php'; ?>
  </div>
</div>  <!-- .page-wrapper-->



<!-- Koszyk -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // =========================================================================
        // SEKCJA 1: GŁÓWNA LOGIKA KOSZYKA I MODALA
        // =========================================================================

        // --- Funkcje pomocnicze i zarządzanie stanem ---
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            const safeValue = encodeURIComponent(JSON.stringify(value || ""));
            document.cookie = name + "=" + safeValue + expires + "; path=/";
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) {
                    const value = c.substring(nameEQ.length, c.length);
                    if (!value) return [];
                    try { return JSON.parse(decodeURIComponent(value)); } catch (e) { return []; }
                }
            }
            return [];
        }

        let cartState = getCookie('cartProducts');

        // --- Funkcje do obsługi Modala ---
        function showCartModal(addedProduct) {
            const modalContainer = document.getElementById('cart-modal-container');
            if (!modalContainer) return;
            const imgElem = modalContainer.querySelector('.product-info__image');
            const titleElem = modalContainer.querySelector('.product-info__title');
            const priceElem = modalContainer.querySelector('.product-info__price');
            const [oldPrice, newPrice] = (addedProduct.price || '0|0').split('|');
            imgElem.src = addedProduct.image || '/img/placeholder.png';
            imgElem.alt = addedProduct.name;
            titleElem.innerText = addedProduct.name;
            priceElem.innerText = newPrice;
            let totalBrutto = 0, totalItems = 0;
            const shippingCost = 14.99, VAT_RATE = 1.23;
            cartState.forEach(p => {
                if(p && p.price && p.quantity) {
                    const priceForCalc = parseFloat(p.price.split('|')[1].replace(',', '.'));
                    totalBrutto += priceForCalc * parseInt(p.quantity, 10);
                    totalItems += parseInt(p.quantity, 10);
                }
            });
            const totalNetto = (totalBrutto + shippingCost) / VAT_RATE;
            const grandTotal = totalBrutto + shippingCost;
            const getProductPlural = c => c === 1 ? 'produkt' : (c % 10 >= 2 && c % 10 <= 4 && (c % 100 < 12 || c % 100 > 14) ? 'produkty' : 'produktów');
            modalContainer.querySelector('.summary__title').innerText = `Masz w koszyku ${totalItems} ${getProductPlural(totalItems)}.`;
            modalContainer.querySelector('.summary__subtotal').innerText = `${totalBrutto.toFixed(2).replace('.', ',')} zł`;
            modalContainer.querySelector('.summary__netto').innerText = `${totalNetto.toFixed(2).replace('.', ',')} zł`;
            modalContainer.querySelector('.summary__brutto').innerText = `${grandTotal.toFixed(2).replace('.', ',')} zł`;
            modalContainer.style.display = 'flex';
            przeliczWszystkieCenyNaEUR([
                '._13-z',
                '._15-z',
                '._12-50-z',
                '._51-50-z',
                '.cart-modal__summary .summary-row span',
                '.cart-modal__summary .summary-row strong'
            ]);
            document.body.classList.add('modal-open');
        }

        function hideCartModal() {
            const modalContainer = document.getElementById('cart-modal-container');
            if (modalContainer) {
                modalContainer.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        }

        // --- Funkcje odświeżające UI ---
        function refreshMiniCart() {
            const cartContainer = document.getElementById('mini-cart-container');
            if (!cartContainer) return;
            let cartProductsHTML = '', totalSum = 0, totalItems = 0;
            const currency = 'zł';
            if (Array.isArray(cartState) && cartState.length > 0) {
                cartState.forEach(product => {
                    if (!product || !product.id || !product.name || !product.price) return;
                    const quantity = parseInt(product.quantity || 1, 10);
                    const [oldPriceStr, newPriceStr] = (product.price || '0|0').split('|');
                    const priceForCalc = parseFloat(newPriceStr.replace(',', '.'));
                    totalSum += priceForCalc * quantity;
                    totalItems += quantity;
                    cartProductsHTML += `<a href="${product.link || '#'}" class="product-link-wrapper" data-id="${product.id}" style="text-decoration: none; color: inherit;"><div class="product-01"><img class="image" src="${product.image || '/img/placeholder.png'}" alt="${product.name}" />${product.discount ? `<div class="frame-1756"><div class="label"><div class="_10">${product.discount}</div></div></div>` : ''}<div class="descp"><div class="cud-mi-d-jagoda-250-g">${product.name} (x${quantity})</div>${parseFloat(oldPriceStr) > 0 ? `<div class="price"><div class="_15-z">${oldPriceStr}</div><div class="_13-z">${newPriceStr}</div></div>` : `<div class="_12-50-z">${newPriceStr}</div>`}</div><img class="delete" src="/img/mini-cart/delete0.svg" alt="Usuń produkt"/></div></a>`;
                });
            }
            if (cartProductsHTML === '') cartProductsHTML = '<p style="text-align: center; padding: 20px;">Twój koszyk jest pusty.</p>';
            const fullMiniCartHTML = `<div class="mini-cart"><div class="buttons"><a href="/koszyk" class="button" style="text-decoration: none;"><div class="zobacz-koszyk">Zobacz koszyk</div></a><a href="/zamowienie" class="button2" style="text-decoration: none;"><div class="z-zam-wienie">Złóż zamówienie</div></a></div><div class="summary"><div class="suma">Suma:</div><div class="_51-50-z">${totalSum.toFixed(2).replace('.', ',')} ${currency}</div></div><div class="horizontal-divider"></div><div class="horizontal-divider2"></div><div class="products">${cartProductsHTML}</div></div>`;
            cartContainer.innerHTML = fullMiniCartHTML;
            const cartCounter = document.querySelector('.cart-trigger > span');
            if (cartCounter) cartCounter.innerText = totalItems;
        }

        function refreshCartPageSummary() {
            const summaryContainer = document.querySelector('.cart-summary');
            if (!summaryContainer) return;
            let totalBrutto = 0;
            const productCount = Array.isArray(cartState) ? cartState.length : 0;
            const VAT_RATE = 1.23;
            if (Array.isArray(cartState)) {
                cartState.forEach(p => {
                    if(p && p.price && typeof p.quantity !== 'undefined') {
                        const priceForCalc = parseFloat(p.price.split('|')[1].replace(',', '.'));
                        totalBrutto += priceForCalc * parseInt(p.quantity, 10);
                    }
                });
            }
            const totalNetto = totalBrutto / VAT_RATE;
            const getProductPlural = count => {
                if (count === 1) return 'produkt';
                const lastDigit = count % 10; const lastTwoDigits = count % 100;
                if (lastDigit >= 2 && lastDigit <= 4 && (lastTwoDigits < 12 || lastTwoDigits > 14)) return 'produkty';
                return 'produktów';
            };
            const summaryTitle = summaryContainer.querySelector('.cart-summary__title');
            const summaryTotal = summaryContainer.querySelector('.cart-summary__total');
            const summaryNetto = summaryContainer.querySelector('.summary-netto');
            const summaryBrutto = summaryContainer.querySelector('.summary-brutto');
            if (productCount > 0) {
                summaryContainer.closest('.cart-sidebar').style.display = 'block';
                if(summaryTitle) summaryTitle.innerText = `Masz w koszyku ${productCount} ${getProductPlural(productCount)}.`;
                if(summaryTotal) summaryTotal.innerText = `${totalBrutto.toFixed(2).replace('.', ',')} zł`;
                if(summaryNetto) summaryNetto.innerText = `${totalNetto.toFixed(2).replace('.', ',')} zł`;
                if(summaryBrutto) summaryBrutto.innerText = `${totalBrutto.toFixed(2).replace('.', ',')} zł`;
            } else {
                const itemsContainer = document.querySelector('.cart-items');
                if (itemsContainer) itemsContainer.innerHTML = '<p class="cart-empty-message">Twój koszyk jest pusty.</p>';
                const sidebar = document.querySelector('.cart-sidebar');
                if (sidebar) sidebar.style.display = 'none';
            }
        }

        function saveCartAndRefreshUI(newCart, addedProduct = null) {
            cartState = Array.isArray(newCart) ? newCart : [];
            setCookie('cartProducts', cartState, 30);
            refreshMiniCart();
            refreshCartPageSummary();
            if (addedProduct) {
                showCartModal(addedProduct);
            }
        }

        // --- Event Listenery dla koszyka i modala ---
        document.body.addEventListener('click', function(e) {
            if (e.target.closest('.cart-modal__close-btn') || e.target.id === 'cart-modal-container') {
                e.preventDefault();
                hideCartModal();
                return;
            }
            const removeBtn = e.target.closest('.delete, .cart-item__remove-button');
            const quantityBtn = e.target.closest('.quantity-selector__button');
            const addBtn = e.target.closest('.button-add-to-cart');

            if (removeBtn) {
                e.preventDefault();
                const productElement = removeBtn.closest('[data-id]');
                if (!productElement) return;
                const productIdToRemove = productElement.dataset.id;
                const newCart = cartState.filter(p => decodeURIComponent(p.id) !== decodeURIComponent(productIdToRemove));
                productElement.remove();
                saveCartAndRefreshUI(newCart);
            } else if (quantityBtn) {
                e.preventDefault();
                const productElement = quantityBtn.closest('[data-id]');
                if (!productElement) return;
                const productId = productElement.dataset.id;
                const quantityInput = productElement.querySelector('.quantity-selector__input');
                let currentQuantity = parseInt(quantityInput.value, 10);
                if (quantityBtn.classList.contains('quantity-selector__button--increment')) {
                    currentQuantity++;
                } else {
                    currentQuantity = Math.max(1, currentQuantity - 1);
                }
                quantityInput.value = currentQuantity;
                const newCart = cartState.map(p => decodeURIComponent(p.id) === decodeURIComponent(productId) ? { ...p, quantity: currentQuantity } : p);
                saveCartAndRefreshUI(newCart);
                const pricePerItem = parseFloat(productElement.dataset.price);
                productElement.querySelector('.cart-item__total-price').innerText = `${(pricePerItem * currentQuantity).toFixed(2).replace('.', ',')} zł`;
            }

            // --- KLUCZOWA ZMIANA: Logika "Dodaj do koszyka" ---
            else if (addBtn) {
                e.preventDefault();

                let newProductData;
                const productCard = addBtn.closest('.product-card, .product-card-list');
                const productView = addBtn.closest('.product-view'); // Sprawdzamy, czy jesteśmy na stronie produktu

                if (productCard) {
                    // Logika dla list produktów (slider, kategorie)
                    let priceToUseElem = productCard.querySelector('.price-new');
                    if (!priceToUseElem) priceToUseElem = productCard.querySelector('.product-price');
                    const linkElement = productCard.querySelector('.product-card__link');
                    const nameElement = productCard.querySelector('.product-info h3, .product-card__content h3');
                    const productId = linkElement ? linkElement.getAttribute('href') : null;
                    const productName = nameElement ? nameElement.innerText : null;
                    const priceToUse = priceToUseElem ? priceToUseElem.innerText : null;

                    if (!productId || !productName || !priceToUse || productId === '#') {
                        alert('Wystąpił błąd. Nie można dodać tego produktu do koszyka.'); return;
                    }

                    const oldPrice = productCard.querySelector('.price-old')?.innerText || '0';
                    newProductData = {
                        id: productId, name: productName, price: `${oldPrice}|${priceToUse}`,
                        quantity: 1, // Domyślnie dodajemy 1 sztukę z listy
                        discount: productCard.querySelector('.badge.badge--sale')?.innerText || null,
                        image: productCard.querySelector('.product-image-container img')?.getAttribute('src') || '',
                        link: productId
                    };
                } else if (productView) {
                    // Logika dla strony pojedynczego produktu
                    const titleElem = productView.querySelector('.product-details__title');
                    const oldPriceElem = productView.querySelector('.price-section__old-price');
                    const newPriceElem = productView.querySelector('.price-section__current-price');
                    const quantityInput = productView.querySelector('.quantity-selector__input');
                    const imageElem = productView.querySelector('.product-gallery__main-image');

                    const productId = window.location.href; // Używamy URL strony jako ID
                    const productName = titleElem ? titleElem.innerText : 'Brak nazwy';
                    const priceToUse = newPriceElem ? newPriceElem.innerText : '0';
                    const oldPrice = oldPriceElem ? oldPriceElem.innerText : '0';

                    newProductData = {
                        id: productId, name: productName, price: `${oldPrice}|${priceToUse}`,
                        quantity: quantityInput ? parseInt(quantityInput.value, 10) : 1,
                        discount: productView.querySelector('.badge.badge--sale')?.innerText || null,
                        image: imageElem ? imageElem.getAttribute('src') : '',
                        link: productId
                    };
                } else {
                    return; // Nie znaleziono kontekstu produktu
                }

                // Wspólna logika aktualizacji koszyka
                let newCart;
                const existingProductIndex = cartState.findIndex(p => p && decodeURIComponent(p.id) === decodeURIComponent(newProductData.id));
                if (existingProductIndex > -1) {
                    newCart = cartState.map((p, index) => index === existingProductIndex ? { ...p, quantity: p.quantity + newProductData.quantity } : p);
                } else {
                    newCart = [...cartState, newProductData];
                }
                saveCartAndRefreshUI(newCart, newProductData);
            }
        });

        document.body.addEventListener('change', function(e) { /* ... bez zmian ... */ });

        // Inicjalizacja na starcie
        refreshMiniCart();
        refreshCartPageSummary();
    });
</script>






<!-- Dodany skrypt JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Funkcje pomocnicze do obsługi Ciasteczek ---
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // --- Logika przełączania motywu ---
        const themeToggle = document.querySelector('.theme-toggle');
        const body = document.body;

        // Zastosuj motyw z ciasteczka przy ładowaniu strony
        const savedTheme = getCookie('theme');
        if (savedTheme === 'dark') {
            body.setAttribute('data-theme', 'dark');
        }

        themeToggle.addEventListener('click', () => {
            if (body.hasAttribute('data-theme')) {
                body.removeAttribute('data-theme');
                setCookie('theme', 'light', 365); // Lub usuń ciasteczko
            } else {
                body.setAttribute('data-theme', 'dark');
                setCookie('theme', 'dark', 365);
            }
        });

        // --- Logika zmiany rozmiaru czcionki ---
        const fontSizeChanger = document.querySelector('.font-size-changer');
        const fontSpans = fontSizeChanger.querySelectorAll('span');
        const htmlElement = document.documentElement;
        const fontSizes = ['100%', '105%', '110%'];
        const zoomLevels = ['100%', '102%', '104%'];
        let currentSizeIndex = <?php echo isset($_COOKIE['currentSizeIndex']) ? $_COOKIE['currentSizeIndex'] ?: 0 : '0'; ?>;

        // Zastosuj rozmiar czcionki z ciasteczka
        // const savedSize = getCookie('fontSize');
        // if (savedSize && fontSizes.includes(savedSize)) {
        //     htmlElement.style.fontSize = savedSize;
        //     currentSizeIndex = fontSizes.indexOf(savedSize);
        // }

        // Funkcja do aktualizacji aktywnego 'span'
        function updateActiveFontSpan() {
            const mainElement = document.querySelector('html');
            if (mainElement) {
                mainElement.style.zoom = zoomLevels[currentSizeIndex];
            }
            fontSpans.forEach((span, index) => {
                if(index === currentSizeIndex) {
                    span.classList.add('active');
                } else {
                    span.classList.remove('active');
                }
            });

        }

        // Zastosuj aktywną klasę na starcie
        updateActiveFontSpan();

        fontSizeChanger.addEventListener('click', () => {
            currentSizeIndex = (currentSizeIndex + 1) % fontSizes.length;
            const mainElement = document.querySelector('html');
            mainElement.style.zoom = zoomLevels[currentSizeIndex];
            const newSize = fontSizes[currentSizeIndex];
            htmlElement.style.fontSize = newSize;
            // dodaj newZoom do ciasteczka
            const newZoom = zoomLevels[currentSizeIndex];
            // Zwiększ indeks rozmiaru czcionki
            // fontSpans.forEach(span => span.classList.remove('active'));
            // Zwiększ indeks rozmiaru czcionki i zresetuj do 0

            setCookie('fontSize', newSize, 365);
            setCookie('pageZoom', newZoom, 365);
            setCookie('currentSizeIndex', currentSizeIndex, 365);
            updateActiveFontSpan();
        });


        // --- Scroll Indicator ---
        const scrollIndicator = document.querySelector('.scroll-indicator');
        const footer = document.querySelector('.footer');

        function isFooterVisible() {
            if (!footer) return false;
            const rect = footer.getBoundingClientRect();
            const visibleHeight = Math.min(rect.bottom, window.innerHeight) - Math.max(rect.top, 0);
            return visibleHeight >= rect.height * 0.95;
        }

        function updateScrollIndicatorRotation() {
            if (isFooterVisible()) {
                scrollIndicator.style.transform = 'rotate(180deg)';
            } else {
                scrollIndicator.style.transform = 'rotate(0deg)';
            }
        }

        if (scrollIndicator && footer) {
            // Obsługa kliknięcia
            scrollIndicator.addEventListener('click', () => {
                if (isFooterVisible()) {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    window.scrollBy({ top: window.innerHeight * 0.78, behavior: 'smooth' });
                }
            });

            // Aktualizuj obrót przy scrollu i resize
            window.addEventListener('scroll', updateScrollIndicatorRotation);
            window.addEventListener('resize', updateScrollIndicatorRotation);
            updateScrollIndicatorRotation();
        }


    });
</script>





  <script src="/assets/vanilla-tilt.min.js"></script>
  <script src="/assets/animations.js"></script>
  <script>

      var html_element = document.querySelector('html');

      var ddApp = document.querySelector('html');
      var siteHeader = document.querySelector('.page-header');

      let lastScrollY = window.pageYOffset;
      // NOWA ZMIANA: Definicja klas kierunku
      const SCROLL_DOWN_CLASS = 'scrolling-down';
      const SCROLL_UP_CLASS = 'scrolling-up';

      function ddStickyHeader() {

          // Zakładamy, że 'siteHeader' i 'ddApp' są zdefiniowane gdzieś wyżej
          if (siteHeader) {

              // Pobranie aktualnej pozycji
              const currentScrollY = window.pageYOffset;

              // --- Oryginalna logika "sticky" ---
              // aby poprawnie usuwać sticky także poniżej 200px.
              if (currentScrollY >= 380 && window.innerWidth >= 1080) {
                  if (!ddApp.classList.contains('sticky-header')) {
                      // do body dodaj wysokość #header
                      ddApp.classList.add('sticky-header');
                      // dodaj padding do body, aby uniknąć przesunięcia treści
                      document.body.style.paddingTop = siteHeader.offsetHeight + 'px';

                      // przenieś .top-bar-main na koniec .main-header
                      var topBarMain = document.querySelector('.top-bar-main');
                      if (topBarMain) {
                          var mainHeader = document.querySelector('.main-header');
                          if (mainHeader) {
                              mainHeader.appendChild(topBarMain);
                          }
                      }
                  }
                  siteHeader.classList.add("sticky");
              } else if (currentScrollY <= 232 || window.innerWidth < 1080) {
                  // usuń padding z body
                  if (ddApp.classList.contains('sticky-header')) {
                      ddApp.classList.remove('sticky-header');
                      document.body.style.paddingTop = '0px';
                      // przenieś .top-bar-main z powrotem przed .main-header
                      var topBarMain = document.querySelector('.top-bar-main');
                      if (topBarMain) {
                          var header = document.querySelector('.page-header');
                          if (header) {
                              header.insertBefore(topBarMain, header.firstChild);
                          }
                      }
                  }
                  siteHeader.classList.remove("sticky");
              }

              // --- ZMODYFIKOWANA Logika kierunku scrolla (ŻĄDANIE 200px) ---

              // Warunek: Stosuj klasy kierunku TYLKO jeśli scroll przekroczył
              if (currentScrollY > lastScrollY) {
                  // Scroll w dół (warunek > 0 jest już spełniony przez > 200)
                  siteHeader.classList.add(SCROLL_DOWN_CLASS);
                  siteHeader.classList.remove(SCROLL_UP_CLASS);
              } else if (currentScrollY < lastScrollY) {
                  // Scroll w górę
                  siteHeader.classList.add(SCROLL_UP_CLASS);
                  siteHeader.classList.remove(SCROLL_DOWN_CLASS);
              }

              // Zaktualizuj ostatnią pozycję scrolla na sam koniec
              // TO MUSI BYĆ WYKONYWANE ZAWSZE, niezależnie od progu 200px
              lastScrollY = currentScrollY;
          }
      }

      setTimeout(function () {
          ddStickyHeader();
      }, 144);
      setTimeout(function () {
          ddStickyHeader();
      }, 330);

      window.onscroll = function () {
          ddStickyHeader();
      };


      const main_menu__toggle =  function () {
          const main_menu = document.querySelector('.main-menu');
          if (main_menu) {
              // dodaj animację do menu
              main_menu.classList.toggle('animating');
              // przełącz klasę aktywną na menu
              setTimeout(function() {
                  main_menu.classList.toggle('active');
              }, 10);
              setTimeout(function() {
                  main_menu.classList.toggle('animating');
              }, 300);
              // dodaj animację do przycisku
              main_menu__toggle_btn.classList.toggle('active');
              // dodaj klasę do html, aby zablokować przewijanie
              document.body.parentElement.classList.toggle('mobile-no-scroll');
          }
      };
      html_element.addEventListener('click', function (e) {
          if (
              !(
                  e.target.closest('.main-menu__toggle')
                  // || e.target.closest('.main-menu__item')
                  // || e.target.closest('.main-menu__link')
              ) && html_element.classList.contains('mobile-no-scroll')
          ) {
              main_menu__toggle();
          }
      });
      const main_menu__toggle_btn = document.querySelector('.main-menu__toggle');
      if (main_menu__toggle_btn) {
          main_menu__toggle_btn.addEventListener('click', function () {main_menu__toggle()});
      }


  </script>


<script>

    /* Zapisz ceny ostatnio klikniętego produktu do localStorage
       aby można było je wykorzystać na stronie koszyka lub innych stronach */
        document.querySelectorAll('.product-card__link').forEach(function(link) {
        link.addEventListener('click', function() {
            var oldPrice = link.querySelector('.price-old') ? link.querySelector('.price-old').innerText : null;
            var newPrice = link.querySelector('.price-new') ? link.querySelector('.price-new').innerText : null;
            if (oldPrice && newPrice) {
                document.cookie = "lastProductOldPrice=" + encodeURIComponent(oldPrice) + "; path=/";
                document.cookie = "lastProductNewPrice=" + encodeURIComponent(newPrice) + "; path=/";
            } else {
                var price = link.querySelector('.product-price') ? link.querySelector('.product-price').innerText : null;
                if (price) {
                    document.cookie = "lastProductOldPrice=" + encodeURIComponent('0') + "; path=/";
                    document.cookie = "lastProductNewPrice=" + encodeURIComponent(price) + "; path=/";
                }
            }
            // niech zapisuje też nazwę produktu
            var productName = link.querySelector('.product-info h3') ? link.querySelector('.product-info h3').innerText : null;
            if (!productName) {
                productName = link.querySelector('.product-card__content h3') ? link.querySelector('.product-card__content h3').innerText : null;
            }
            if (productName) {
                document.cookie = "lastProductName=" + encodeURIComponent(productName) + "; path=/";
            }
        });
    });
    // zapisz tablicę produktów do ciasteczka po kliknięciu przycisku "Dodaj do koszyka" .button-add-to-cart
    // document.querySelectorAll('.button-add-to-cart').forEach(function(button) {
    //     button.addEventListener('click', function() {
    //         var productIds = [];
    //         var productNames = [];
    //         var productPrices = [];
    //         var productQuantities = [];
    //         var productDiscounts = [];
    //         var productImages = []; // NOWE: Tablica na obrazki
    //         var productLinks = [];  // NOWE: Tablica na linki
    //
    //         // znajdź najbliższy element .product-card lub .product-card-list
    //         var productCard = button.closest('.product-card') || button.closest('.product-card-list');
    //         if (productCard) {
    //             var productId = productCard.getAttribute('data-product-id');
    //             if (productId) {
    //                 productIds.push(productId);
    //             }
    //             var productName = productCard.querySelector('.product-info h3') ? productCard.querySelector('.product-info h3').innerText : null;
    //             if (!productName) {
    //                 productName = productCard.querySelector('.product-card__content h3') ? productCard.querySelector('.product-card__content h3').innerText : null;
    //             }
    //             if (productName) {
    //                 productNames.push(productName);
    //             }
    //
    //             // NOWE: Pobierz URL obrazka
    //             var imageElement = productCard.querySelector('.product-image-container img');
    //             if (imageElement) {
    //                 productImages.push(imageElement.getAttribute('src'));
    //             } else {
    //                 productImages.push(''); // Zapisz pusty string, jeśli nie ma obrazka
    //             }
    //
    //             // NOWE: Pobierz link do produktu
    //             var linkElement = productCard.querySelector('.product-card__link');
    //             if (linkElement) {
    //                 productLinks.push(linkElement.getAttribute('href'));
    //             } else {
    //                 productLinks.push(''); // Zapisz pusty string, jeśli nie ma linku
    //             }
    //
    //             var oldPrice = productCard.querySelector('.price-old') ? productCard.querySelector('.price-old').innerText : null;
    //             var newPrice = productCard.querySelector('.price-new') ? productCard.querySelector('.price-new').innerText : null;
    //             if (oldPrice && newPrice) {
    //                 productPrices.push(oldPrice + '|' + newPrice);
    //             } else {
    //                 var price = productCard.querySelector('.product-price') ? productCard.querySelector('.product-price').innerText : null;
    //                 if (price) {
    //                     productPrices.push('0|' + price);
    //                 }
    //             }
    //             var quantityInput = productCard.querySelector('input[type="number"]');
    //             var quantity = quantityInput ? quantityInput.value : '1';
    //             productQuantities.push(quantity);
    //
    //             var discount = productCard.querySelector('.badge--sale') ? productCard.querySelector('.badge--sale').innerText : null;
    //             if (discount) {
    //                 productDiscounts.push(discount);
    //             }
    //         }
    //         var products = {
    //             ids: productIds,
    //             names: productNames,
    //             prices: productPrices,
    //             quantities: productQuantities,
    //             discounts: productDiscounts,
    //             images: productImages, // NOWE: Dodaj obrazy do obiektu
    //             links: productLinks    // NOWE: Dodaj linki do obiektu
    //         };
    //         document.cookie = "cartProducts=" + encodeURIComponent(JSON.stringify(products)) + "; path=/";
    //     });
    // });

    // odczytaj ciasteczko cartProducts i wyświetl w konsoli
    // var cartProducts = getCookie('cartProducts');
    // if (cartProducts) {
    //     console.log(JSON.parse(decodeURIComponent(cartProducts)));
    // }

<?php if (isset($_COOKIE['currency']) && $_COOKIE['currency'] == 'EUR') { ?>
    // /**
    //  * Funkcja pomocnicza do pobierania aktualnego kursu EUR z NBP.
    //  * @returns {Promise<number>} Zwraca obietnicę (Promise), która rozwiązuje się do kursu (float).
    //  */
    // async function pobierzKursEUR() {
    //     const url = 'https://api.nbp.pl/api/exchangerates/rates/a/eur/';
    //
    //     try {
    //         const response = await fetch(url, {
    //             headers: { 'Accept': 'application/json' }
    //         });
    //
    //         if (!response.ok) {
    //             throw new Error(`Błąd NBP API: ${response.status} ${response.statusText}`);
    //         }
    //
    //         const data = await response.json();
    //
    //         if (data.rates && data.rates[0] && data.rates[0].mid) {
    //             console.log(`Pobrano aktualny kurs EUR: ${data.rates[0].mid}`);
    //             return data.rates[0].mid; // Zwraca kurs jako liczbę, np. 4.29
    //         } else {
    //             throw new Error("Nie znaleziono kursu 'mid' w odpowiedzi API NBP.");
    //         }
    //     } catch (error) {
    //         console.error("Błąd podczas pobierania kursu EUR:", error);
    //         throw error; // Rzuć błąd dalej, aby główna funkcja go złapała
    //     }
    // }
    //
    // /**
    //  * Funkcja pomocnicza do "czyszczenia" tekstu ceny i zamiany go na liczbę.
    //  * Przykład: "1 499,99 zł" -> 1499.99
    //  * @param {string} tekstCeny - Tekst z elementu HTML.
    //  * @returns {number|null} Zwraca cenę jako liczbę (float) lub null, jeśli nie da się sparsować.
    //  */
    // function parsujCenePLN(tekstCeny) {
    //     if (!tekstCeny) {
    //         return null;
    //     }
    //
    //     let czystyTekst = tekstCeny
    //         .replace(/zł|pln/gi, '')  // Usuń "zł" lub "pln" (bez względu na wielkość liter)
    //         .replace(',', '.')          // Zamień przecinek na kropkę (standard JS)
    //         .replace(/\s/g, '')         // Usuń wszystkie spacje (np. separatory tysięcy "1 000")
    //         .trim();                    // Usuń białe znaki z początku i końca
    //
    //     const cena = parseFloat(czystyTekst);
    //
    //     // Zwróć cenę tylko jeśli jest poprawną liczbą
    //     return isNaN(cena) ? null : cena;
    // }
    //
    // /**
    //  * Główna funkcja, która pobiera kurs i przelicza wszystkie ceny.
    //  */
    // async function przeliczWszystkieCenyNaEUR(selektoryCen) {
    //     // 1. Zdefiniuj wszystkie selektory, których szukasz
    //     // ZMIANA TUTAJ: Sprawdzenie, czy selektory zostały przekazane
    //     if (!selektoryCen || !Array.isArray(selektoryCen) || selektoryCen.length === 0) {
    //         console.warn("Nie przekazano żadnych selektorów do przeliczenia. Przerywam.");
    //         return;
    //     }
    //
    //     // 2. Połącz selektory w jeden string dla querySelectorAll
    //     const zapytanie = selektoryCen.join(', ');
    //
    //     try {
    //         // 3. Pobierz kurs EUR (czekaj na wynik)
    //         const kursEUR = await pobierzKursEUR();
    //
    //         // 4. Znajdź wszystkie elementy pasujące do selektorów
    //         const elementyDoPrzeliczenia = document.querySelectorAll(zapytanie);
    //
    //         if (elementyDoPrzeliczenia.length === 0) {
    //             console.warn("Nie znaleziono na stronie żadnych elementów pasujących do selektorów cen.");
    //             return;
    //         }
    //
    //         console.log(`Znaleziono ${elementyDoPrzeliczenia.length} elementów do przeliczenia.`);
    //
    //         // 5. Przejdź pętlą przez każdy znaleziony element
    //         elementyDoPrzeliczenia.forEach(element => {
    //             const oryginalnyTekst = element.textContent;
    //
    //             // 6. Sparsuj cenę z tekstu
    //             const cenaPLN = parsujCenePLN(oryginalnyTekst);
    //
    //             // 7. Jeśli parsowanie się powiodło (tekst zawierał cenę)
    //             if (cenaPLN !== null) {
    //                 // 8. Oblicz cenę w EUR
    //                 const cenaEUR = cenaPLN / kursEUR;
    //
    //                 // 9. Sformatuj nową cenę (np. "23,45 €")
    //                 // .toFixed(2) daje 2 miejsca po przecinku
    //                 // .replace('.', ',') zamienia kropkę na przecinek
    //                 const sformatowanaCenaEUR = cenaEUR.toFixed(2).replace('.', ',') + ' €';
    //
    //                 // 10. Podmień tekst w elemencie HTML
    //                 element.textContent = sformatowanaCenaEUR;
    //
    //                 // Opcjonalnie: Zapisz starą cenę na wypadek, gdyby była potrzebna
    //                 element.dataset.originalPln = oryginalnyTekst;
    //
    //             } else {
    //                 // Jeśli w elemencie był tekst, którego nie dało się sparsować
    //                 console.warn(`Nie można było sparsować ceny z: "${oryginalnyTekst}"`, element);
    //             }
    //         });
    //
    //         console.log("Konwersja cen na EUR zakończona pomyślnie.");
    //
    //     } catch (error) {
    //         // 11. Obsłuż błąd (np. gdy NBP API nie działa)
    //         console.error("Wystąpił krytyczny błąd podczas przeliczania cen:", error);
    //         // Możesz tu poinformować użytkownika, np. wyświetlając komunikat na stronie
    //         // np. alert("Nie udało się przeliczyć cen na EUR.");
    //     }
    // }
    //
    // // ======================================================
    // // == URUCHOMIENIE SKRYPTU PO ZAŁADOWANIU STRONY       ==
    // // ======================================================
    //
    // // Użyj 'DOMContentLoaded', aby skrypt uruchomił się,
    // // gdy tylko struktura HTML strony będzie gotowa.
    // document.addEventListener('DOMContentLoaded', () => {
    //     przeliczWszystkieCenyNaEUR([
    //         // '.price-section__current-price',
    //         // '.price-section__old-price',
    //         // '.price-old',
    //         // '.price-new',
    //         '.cart-item__total-price',
    //         '.cart-summary__total',
    //         '.summary-netto',
    //         '.summary-brutto',
    //         '.price__current',
    //         '.summary-row span',
    //         '.summary-row--total strong',
    //         '.product-price span',
    //         // '.summary-row--total ',
    //         // '.summary__subtotal',
    //         // '.',
    //         // '.',
    //         '._13-z',
    //         '._15-z',
    //         '._12-50-z',
    //         '._51-50-z'
    //     ]);
    // });


    <?php

    /**
     * Pobiera kurs EUR z cache'u lub NBP.
     * Cache jest ważny przez 3 godziny.
     *
     * @return float Zwraca kurs EUR lub 0.0 w przypadku błędu.
     */
    function pobierzKursEURzCache() {
      $cacheFile = __DIR__ . '/nbp_cache.json'; // Plik cache w tym samym katalogu co skrypt PHP
      $cacheTime = 3 * 3600; // 3 godziny w sekundach
      $nbpUrl = 'http://api.nbp.pl/api/exchangerates/rates/a/eur/';

      $kurs_mid = 0.0;

      // 1. Spróbuj odczytać kurs z "świeżego" cache'u
      if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
        $json_data = file_get_contents($cacheFile);
        $data = json_decode($json_data);
        if (isset($data->rates[0]->mid)) {
          $kurs_mid = (float) $data->rates[0]->mid;
        }
      }

      // 2. Jeśli cache jest stary, pusty lub uszkodzony - pobierz z NBP
      if ($kurs_mid === 0.0) {
        // Wymagane rozszerzenie cURL
        if (!function_exists('curl_init')) {
          error_log("Błąd krytyczny: Rozszerzenie cURL nie jest włączone.");
          return 0.0;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $nbpUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // 3. Sprawdź odpowiedź NBP
        if ($response && $http_code === 200) {
          $data = json_decode($response);
          if (isset($data->rates[0]->mid)) {
            $kurs_mid = (float) $data->rates[0]->mid;
            // Zapisz nową odpowiedź do pliku cache
            // Użyj LOCK_EX dla bezpieczeństwa
            file_put_contents($cacheFile, $response, LOCK_EX);
          }
        } else {
          error_log("Błąd API NBP: Nie można pobrać kursu. Status: " . $http_code);
          // W przypadku błędu NBP, spróbuj użyć starych danych z cache, nawet jeśli są przeterminowane
          if (file_exists($cacheFile)) {
            $json_data = file_get_contents($cacheFile);
            $data = json_decode($json_data);
            if (isset($data->rates[0]->mid)) {
              $kurs_mid = (float) $data->rates[0]->mid;
              error_log("Użyto przestarzałego kursu z cache z powodu błędu NBP.");
            }
          }
        }
      }

      return $kurs_mid;
    }

    // ======================================================
    // == GŁÓWNA LOGIKA PHP                                ==
    // ======================================================

    // Pobierz kurs. Ta zmienna zostanie użyta poniżej w JavaScript.
    $aktualnyKursEUR = pobierzKursEURzCache();

    ?>

        // ======================================================
        // == CZĘŚĆ JAVASCRIPT                                 ==
        // ======================================================

        // 1. KURS JEST WSTRZYKIWANY BEZPOŚREDNIO PRZEZ PHP
        // Przeglądarka zobaczy np.: const KURS_EUR_Z_SERWERA = 4.2955;
        const KURS_EUR_Z_SERWERA = <?php echo $aktualnyKursEUR; ?>;

        /**
        * Funkcja pomocnicza do "czyszczenia" tekstu ceny (bez zmian)
        */
        function parsujCenePLN(tekstCeny) {
        if (!tekstCeny) {
        return null;
    }
        let czystyTekst = tekstCeny
        .replace(/zł|pln/gi, '')
        .replace(',', '.')
        .replace(/\s/g, '')
        .trim();
        const cena = parseFloat(czystyTekst);
        return isNaN(cena) ? null : cena;
    }

        /**
        * Główna funkcja, która przelicza wszystkie ceny.
        * UWAGA: Nie jest już "async", bo nie musi na nic czekać!
        * @param {string[]} selektoryCen - Tablica stringów z selektorami CSS.
        * @param {number} kursEUR - Kurs EUR wstrzyknięty przez serwer.
        */
        function przeliczWszystkieCenyNaEUR(selektoryCen, kursEUR) {

        // 2. Sprawdź, czy kurs jest poprawny
        if (!kursEUR || kursEUR <= 0) {
        console.error("Brak ważnego kursu EUR z serwera. Przeliczanie anulowane.");
        return;
    }

        if (!selektoryCen || !Array.isArray(selektoryCen) || selektoryCen.length === 0) {
        console.warn("Nie przekazano żadnych selektorów do przeliczenia. Przerywam.");
        return;
    }

        const zapytanie = selektoryCen.join(', ');

        try {
        const elementyDoPrzeliczenia = document.querySelectorAll(zapytanie);

        if (elementyDoPrzeliczenia.length === 0) {
        console.warn("Nie znaleziono na stronie żadnych elementów pasujących do selektorów cen.");
        return;
    }

        console.log(`Znaleziono ${elementyDoPrzeliczenia.length} elementów do przeliczenia.`);

        elementyDoPrzeliczenia.forEach(element => {
        const oryginalnyTekst = element.textContent;
        const cenaPLN = parsujCenePLN(oryginalnyTekst);

        if (cenaPLN !== null) {
        const cenaEUR = cenaPLN / kursEUR;
        const sformatowanaCenaEUR = cenaEUR.toFixed(2).replace('.', ',') + ' €';
        element.textContent = sformatowanaCenaEUR;
        element.dataset.originalPln = oryginalnyTekst;
    } else {
        console.warn(`Nie można było sparsować ceny z: "${oryginalnyTekst}"`, element);
    }
    });

        console.log("Konwersja cen na EUR zakończona pomyślnie.");

    } catch (error) {
        // Ten błąd może się zdarzyć tylko jeśli np. selektor CSS jest błędny
        console.error("Wystąpił błąd podczas przeszukiwania elementów:", error);
    }
    }

        // ======================================================
        // == URUCHOMIENIE SKRYPTU PO ZAŁADOWANIU STRONY       ==
        // ======================================================
        document.addEventListener('DOMContentLoaded', () => {

        // Twoja lista selektorów
        const listaSelektorow = [
        '.cart-item__total-price',
        '.cart-summary__total',
        '.summary-netto',
        '.summary-brutto',
        '.price__current',
        '.summary-row span',
        '.summary-row--total strong',
        '.product-price span',
        '._13-z',
        '._15-z',
        '._12-50-z',
        '.price__old',
        '._51-50-z'
        ];

        // 3. Wywołaj funkcję, przekazując jej listę ORAZ kurs pobrany przez PHP
        przeliczWszystkieCenyNaEUR(listaSelektorow, KURS_EUR_Z_SERWERA);
    });

</script>

<?php } ?>



</script>


<!--<script>-->
<!--    var targetLang = 'en';-->
<!--    fetch('/translate-proxy.php?lang=' + targetLang)-->
<!--        .then(res => res.text())-->
<!--        .then(html => {-->
<!--            document.body.innerHTML = html; // podmiana całego body-->
<!--        })-->
<!--        .catch(err => console.error(err));-->
<!--</script>-->

<?php require __DIR__.'/cookies.php'; ?>
</body>
</html>