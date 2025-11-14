<?php
$w = __DIR__;

if (!(isset($_COOKIE['hide_newsletter']) && $_COOKIE['hide_newsletter'] == '1')) {
  ?>

  <link rel="stylesheet" href="<?php css($w, 'style.css'); ?>">
  <section class="newsletter-popup">
    <div class="newsletter-popup__window">
      <div class="newsletter-popup__image-wrapper">
        <img class="newsletter-popup__image" src="<?php w($w); ?>sweet-bee-honey-10.png" alt="Miód w słoiku z plastrem miodu" />
      </div>
      <form class="newsletter-popup__form">
        <div class="newsletter-popup__content">
          <div class="newsletter-popup__text-group">
            <h2 class="newsletter-popup__title">Subskrybuj Newsletter!</h2>
            <p class="newsletter-popup__description">
              Zapisz się na nasz najnowszy newsletter, aby otrzymywać informacje o
              specjalnych zniżkach i nadchodzących wyprzedażach.
            </p>
          </div>
          <div class="newsletter-popup__inputs-group">
            <div class="newsletter-popup__subscribe-group">
              <label>
                <input type="email" class="newsletter-popup__email-input" name="newsletter_email" placeholder="Wpisz swój adres email..." />
              </label>
              <button class="newsletter-popup__submit-button">
                <span class="newsletter-popup__submit-text">subskrybuj</span>
              </button>
            </div>
            <div class="newsletter-popup__coupon-group">
              <div class="newsletter-popup__coupon-label">
                Twój kod kuponu: <span class="copy-coupon">BARTNIK2025</span>
              </div>
              <img class="newsletter-popup__coupon-icon" src="<?php w($w); ?>nail-scissors0.svg" alt="Ikona nożyczek" />
            </div>
          </div>
        </div>
        <div class="newsletter-popup__options">
          <label class="newsletter-popup__option-label">
            <input type="checkbox" class="newsletter-popup__option-checkbox" />
            <span class="newsletter-popup__custom-checkbox"></span>
            Nie pokazuj ponownie tego wyskakującego okienka
          </label>
        </div>
      </form>
      <button class="newsletter-popup__close-btn" aria-label="Zamknij">
        <img src="<?php w($w); ?>hide0.svg" alt="Zamknij" />
      </button>
    </div>
  </section>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Znajdź kontener popupu na stronie.
          const popupContainer = document.querySelector('.newsletter-popup');
          if (!popupContainer) return;

          const closeButton = popupContainer.querySelector('.newsletter-popup__close-btn');
          const checkbox = popupContainer.querySelector('.newsletter-popup__option-checkbox');
          const popupWindow = popupContainer.querySelector('.newsletter-popup__window');

          // Funkcja zamykająca popup
          const closePopup = () => {
              popupContainer.style.display = 'none';
              if (checkbox.checked) {
                  const d = new Date();
                  d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30 dni
                  const expires = "expires=" + d.toUTCString();
                  document.cookie = "hide_newsletter=1;" + expires + ";path=/";
              }
          };

          // Zamykanie po kliknięciu przycisku
          if(closeButton) {
              closeButton.addEventListener('click', closePopup);
          }

          // Zamykanie po kliknięciu w tło (poza oknem popupu)
          popupContainer.addEventListener('click', function(event) {
              if (event.target === popupContainer) {
                  closePopup();
              }
          });

          // Zamykanie po naciśnięciu klawisza Escape
          document.addEventListener('keydown', function(event) {
              if (event.key === 'Escape') {
                  closePopup();
              }
          });

        // Funkcja kopiująca kod kuponu do schowka po naciśnięciu na newsletter-popup__coupon-group
        const couponGroup = popupContainer.querySelector('.newsletter-popup__coupon-group');
        if (couponGroup) {
            couponGroup.addEventListener('click', function() {
                const couponCode = 'BARTNIK2025';
                navigator.clipboard.writeText(couponCode).then(function() {
                    // alert('Kod kuponu skopiowany do schowka: ' + couponCode);
                    // zmiast alertu chcę aby podminiało tekst w newsletter-popup__coupon-label na "Skopiowano!" przez 2 sekundy
                    const couponLabel = popupContainer.querySelector('.newsletter-popup__coupon-label');
                    if (couponLabel) {
                        const originalText = couponLabel.innerHTML;
                        couponLabel.innerHTML = 'Skopiowano!';
                        setTimeout(function() {
                            couponLabel.innerHTML = originalText;
                        }, 2000);
                    }

                }, function(err) {
                    console.error('Błąd przy kopiowaniu kodu kuponu: ', err);
                });
            });
        }

      });

  </script>

  <?php
}
?>
