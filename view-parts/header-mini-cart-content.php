<?php
// Ten plik jest samodzielnym szablonem do generowania HTML mini-koszyka.

// Ustawienie domyślnej waluty
if (empty($currency)) {
  $currency = 'zł';
}

$cartData = isset($_COOKIE['cartProducts']) ? json_decode(urldecode($_COOKIE['cartProducts']), true) : [];
if (!is_array($cartData)) {
  $cartData = [];
}
?>
<div class="mini-cart">
  <?php
  $cartProductsHTML = '';
  $totalSum = 0;

  if (!empty($cartData)) {
    foreach ($cartData as $product) {
      // --- KLUCZOWA POPRAWKA: Sprawdzamy, czy produkt ma podstawowe dane, jeśli nie - pomijamy go ---
      if (!isset($product['id']) || !isset($product['name']) || !isset($product['price'])) {
        continue; // Pomiń ten uszkodzony produkt i przejdź do następnego
      }

      // Używamy operatora ?? do bezpiecznego pobierania danych z domyślnymi wartościami
      $productName = htmlspecialchars($product['name']);
      $quantity = (int)($product['quantity'] ?? 1);
      $priceString = $product['price'] ?? '0|0';
      $discount = htmlspecialchars($product['discount'] ?? '');
      $productLink = htmlspecialchars($product['link'] ?? '#');
      $productImage = htmlspecialchars($product['image'] ?? '/img/placeholder.png');
      $productId = htmlspecialchars($product['id']);

      $priceParts = explode('|', $priceString);
      $oldPriceStr = $priceParts[0];
      $newPriceStr = $priceParts[1] ?? '0';

      $priceForCalc = (float)str_replace(',', '.', preg_replace('/[^\d,]/', '', $newPriceStr));
      $totalSum += $priceForCalc * $quantity;

      // Dodajemy atrybut data-id do głównego elementu-linku
      $cartProductsHTML .= '<a href="' . $productLink . '" class="product-link-wrapper" data-id="' . $productId . '" style="text-decoration: none; color: inherit;">';
      $cartProductsHTML .= '<div class="product-01">';
      $cartProductsHTML .= '<img class="image" src="' . $productImage . '" alt="' . $productName . '" />';
      if ($discount) {
        $cartProductsHTML .= '<div class="frame-1756"><div class="label"><div class="_10">' . $discount . '</div></div></div>';
      }
      $cartProductsHTML .= '<div class="descp">';
      $cartProductsHTML .= '<div class="title">' . $productName . ' (x' . $quantity . ')</div>';
      if ((float)$oldPriceStr > 0) {
        $cartProductsHTML .= '<div class="price"><div class="_15-z">' . htmlspecialchars($oldPriceStr) . '</div><div class="_13-z">' . htmlspecialchars($newPriceStr) . '</div></div>';
      } else {
        $cartProductsHTML .= '<div class="_12-50-z">' . htmlspecialchars($newPriceStr) . '</div>';
      }
      $cartProductsHTML .= '</div>';
      $cartProductsHTML .= '<img class="delete" src="/img/mini-cart/delete0.svg" alt="Usuń produkt"/>';
      $cartProductsHTML .= '</div>';
      $cartProductsHTML .= '</a>';
    }
  }

  if (empty($cartProductsHTML)) {
    $cartProductsHTML = '<p style="text-align: center; padding: 20px;">Twój koszyk jest pusty.</p>';
  }
  ?>
  <div class="buttons">
    <a href="/koszyk" class="button" style="text-decoration: none;"><div class="zobacz-koszyk">Zobacz koszyk</div></a>
    <a href="/zamowienie" class="button2" style="text-decoration: none;"><div class="z-zam-wienie">Złóż zamówienie</div></a>
  </div>
  <div class="summary">
    <div class="suma">Suma:</div>
    <div class="_51-50-z"><?php echo number_format($totalSum, 2, ',', ' '); ?> <?php echo $currency; ?></div>
  </div>
  <div class="horizontal-divider"></div>
  <div class="horizontal-divider2"></div>
  <div class="products"><?php echo $cartProductsHTML; ?></div>
</div>