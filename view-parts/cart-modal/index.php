<?php
$w = __DIR__;
// Zmienna waluty, np. 'zł', powinna być dostępna globalnie
if (empty($currency)) {
  $currency = 'zł';
}
?>
<link rel="stylesheet" href="<?php css($w, 'style.css'); ?>">
<div class="cart-modal">
  <header class="cart-modal__header">
    <div class="notification">
      <img class="notification__icon" src="/view-parts/cart-modal/check0.svg" alt="Ikona sukcesu">
      <p class="notification__text">Produkt został pomyślnie dodany do koszyka.</p>
    </div>
    <button class="cart-modal__close-btn" aria-label="Zamknij">
      <img src="/view-parts/cart-modal/hide0.svg" alt="Zamknij">
    </button>
  </header>

  <div class="cart-modal__body">
    <div class="cart-modal__product-details">
      <div class="product-info">
        <img class="product-info__image" src="" alt="">
        <div class="product-info__text">
          <h2 class="product-info__title">Nazwa produktu</h2>
          <p class="product-info__price">Cena produktu</p>
        </div>
      </div>
    </div>

    <div class="cart-modal__summary">
      <h3 class="summary__title">Masz w koszyku X produktów.</h3>
      <div class="summary__totals">
        <div class="summary-row">
          <span>Suma produktów:</span>
          <span class="summary__subtotal">0,00</span>
        </div>
        <div class="summary-row">
          <span>Wysyłka:</span>
          <span>14,99 zł</span> </div>
        <div class="summary-row">
          <span>Razem (netto):</span>
          <span class="summary__netto">0,00</span>
        </div>
        <div class="summary-row summary-row--total">
          <strong>Suma (brutto):</strong>
          <strong class="summary__brutto">0,00</strong>
        </div>
      </div>
      <div class="summary__actions">
        <a href="#" class="button-secondary cart-modal__close-btn">Kontynuuj zakupy</a>
        <a href="/koszyk" class="button-primary">Realizuj zamówienia</a>
      </div>
    </div>
  </div>
</div>