<?php
$nazwaProduktu = htmlspecialchars($_GET['t'] ?? 'Nazwa przykładowego produktu');
// Pobierz nazwę produktu z cookie, jeśli istnieje
if (isset($_COOKIE['lastProductName'])) {
$nazwaProduktu = htmlspecialchars($_COOKIE['lastProductName']);
}
?>
<title><?php echo $nazwaProduktu; ?> - Sklep Bartnik</title>
<meta name="description" content="Sklep Bartnik">
<meta name="keywords" content="Sklep Bartnik">
