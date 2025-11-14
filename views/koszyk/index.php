<?php
// Definicja stałych i funkcji pomocniczych
define('VAT_RATE', 1.23);
define('SHIPPING_COST', 14.99); // Jeśli koszt wysyłki jest stały

$cart = isset($_COOKIE['cartProducts']) ? json_decode(urldecode($_COOKIE['cartProducts']), true) : [];
if (!is_array($cart)) $cart = [];

function getProductPlural(int $count): string {
  if ($count === 1) return 'produkt';
  $lastDigit = $count % 10;
  $lastTwoDigits = $count % 100;
  if ($lastDigit >= 2 && $lastDigit <= 4 && ($lastTwoDigits < 12 || $lastTwoDigits > 14)) return 'produkty';
  return 'produktów';
}

$w = __DIR__;
$currency = 'zł';
?>
<link rel="stylesheet" href="<?php css($w, 'style.css'); ?>">
<!--<link rel="stylesheet" href="--><?php //css($w, 'style-lg-.css'); echo VERSION; ?><!--" media="screen and (min-width: 66.01rem)">-->
<link rel="stylesheet" href="<?php css($w, 'style-md.css'); echo VERSION; ?>" media="screen and (max-width: 66rem)">
<!--<link rel="stylesheet" href="--><?php //css($w, 'style-t.css'); echo VERSION; ?><!--" media="screen and (min-width: 44.01rem) and (max-width: 66rem)">-->
<link rel="stylesheet" href="<?php css($w, 'style-sm.css'); echo VERSION; ?>" media="screen and (max-width: 44rem)">

<div class="page-cart">
  <header class="page-header"> <div class="container page-wrapper"> <img class="page-header__background" src="/views/zamowienie/honey-shape0.svg" alt="Tło w kształcie plastra miodu"> <h1 class="page-header__title">Koszyk</h1> </div> </header>


  <div class="page-wrapper">
    <div class="cart-container">
      <main class="cart-content">
        <section class="cart-items">
          <?php if (empty($cart)): ?>
            <p class="cart-empty-message">Twój koszyk jest pusty.</p>
          <?php else: ?>
            <?php
            $totalBrutto = 0;
            foreach ($cart as $index => $product):
              // --- KLUCZOWA POPRAWKA: Sprawdzamy, czy produkt ma podstawowe dane, jeśli nie - pomijamy go ---
              if (!isset($product['id']) || !isset($product['name']) || !isset($product['price'])) {
                continue; // Pomiń ten uszkodzony produkt i przejdź do następnego
              }

              // Używamy operatora ?? (null coalescing) do bezpiecznego pobierania danych z domyślnymi wartościami
              $product_id = htmlspecialchars($product['id']);
              $product_name = htmlspecialchars($product['name']);
              $product_link = htmlspecialchars($product['link'] ?? '#');
              $product_image = htmlspecialchars($product['image'] ?? '/img/placeholder.png');
              $product_discount = htmlspecialchars($product['discount'] ?? '');
              $quantity = (int)($product['quantity'] ?? 1);

              $priceString = $product['price'] ?? '0|0';
              $priceParts = explode('|', $priceString);
              $oldPriceStr = $priceParts[0];
              $newPriceStr = $priceParts[1] ?? '0';

              $priceForCalc = (float)str_replace(',', '.', preg_replace('/[^\d,]/', '', $newPriceStr));
              $itemTotal = $priceForCalc * $quantity;
              $totalBrutto += $itemTotal;
              ?>
              <article class="cart-item" data-id="<?php echo $product_id; ?>" data-price="<?php echo $priceForCalc; ?>">
                <div class="cart-item__image-wrapper">
                  <a href="<?php echo $product_link; ?>">
                    <img class="cart-item__image" src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                  </a>
                  <?php if (!empty($product_discount)): ?>
                    <span class="badge badge--sale"><?php echo $product_discount; ?></span>
                  <?php endif; ?>
                </div>
                <div class="cart-item__details">
                  <h2 class="cart-item__title"><a href="<?php echo $product_link; ?>"><?php echo $product_name; ?></a></h2>
                  <div class="cart-item__price-info">
                    <?php if ((float)$oldPriceStr > 0): ?>
                      <span class="price__old"><?php echo htmlspecialchars($oldPriceStr); ?></span>
                    <?php endif; ?>
                    <span class="price__current"><?php echo htmlspecialchars($newPriceStr); ?></span>
                  </div>
                </div>
                <div class="cart-item__actions">
                  <div class="quantity-selector">
                    <button class="quantity-selector__button quantity-selector__button--decrement" aria-label="Zmniejsz ilość">-</button>
                    <input type="text" value="<?php echo $quantity; ?>" class="quantity-selector__input" aria-label="Ilość produktu" pattern="\d*" inputmode="numeric">
                    <button class="quantity-selector__button quantity-selector__button--increment" aria-label="Zwiększ ilość">+</button>
                  </div>

                  <div class="cart-item__total-price"><?php echo number_format($itemTotal, 2, ',', ' '); ?> <?php echo $currency; ?></div>
                  <button class="cart-item__remove-button" aria-label="Usuń produkt"><img src="<?php w($w); ?>bin0.svg" alt="Ikona kosza"></button>
                </div>
              </article>
            <?php endforeach; ?>
            <?php
            $productCount = count($cart);
            $totalNetto = $totalBrutto / VAT_RATE;
            ?>
          <?php endif; ?>
        </section>
        <a href="/" class="continue-shopping-link"></a>
      </main>
      <aside class="cart-sidebar">
        <?php if (!empty($cart)): ?>
          <div class="cart-summary">
            <header class="cart-summary__header">
              <h3 class="cart-summary__title">Masz w koszyku <?php echo $productCount; ?> <?php echo getProductPlural($productCount); ?>.</h3>
              <span class="cart-summary__total"><?php echo number_format($totalBrutto, 2, ',', ' '); ?> <?php echo $currency; ?></span>
            </header>
            <div class="cart-summary__details">
              <div class="summary-row">
                <span>Razem (netto):</span>
                <span class="summary-netto"><?php echo number_format($totalNetto, 2, ',', ' '); ?> <?php echo $currency; ?></span>
              </div>
              <div class="summary-row">
                <strong>Suma (brutto):</strong>
                <strong class="summary-brutto"><?php echo number_format($totalBrutto, 2, ',', ' '); ?> <?php echo $currency; ?></strong>
              </div>
            </div>
            <a href="/zamowienie" class="checkout-button">Przejdź do realizacji zamówienia</a>
          </div>
        <?php endif; ?>
        <div class="usp-blocks product-details__usp">
          <div class="usp-block">
            <img class="usp-block__icon" src="<?php w($w); ?>shopping-online-65403530.svg" alt="Ikona zwrotów" />
            <p class="usp-block__text">Łatwa polityka zwrotów bez zadawania pytań</p>
          </div>
          <div class="usp-block">
            <img class="usp-block__icon" src="<?php w($w); ?>delivery-truck-151736160.svg" alt="Ikona dostawy" />
            <p class="usp-block__text">Zamów przed godziną 18:00, aby otrzymać ekspresową dostawę</p>
          </div>
          <div class="usp-block">
            <img class="usp-block__icon" src="<?php w($w); ?>return0.svg" alt="Ikona jakości" />
            <p class="usp-block__text">Dostarczamy najlepszej jakości, ręcznie wybierane produkty</p>
          </div>
      </aside>
    </div>
  </div>
</div>


