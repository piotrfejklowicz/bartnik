<?php

// --- Konfiguracja ---
$cacheFile = 'nbp_cache.json'; // Nazwa pliku do przechowywania kursu
$cacheTime = 3 * 3600; // 3 godziny w sekundach (3 * 60 * 60)
$nbpUrl = 'http://api.nbp.pl/api/exchangerates/rates/a/eur/';

// Zawsze zwracamy typ JSON
header('Content-Type: application/json');

// --- Logika cache'u ---

// 1. Sprawdź, czy cache istnieje i czy jest "świeży"
if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
    // Cache jest świeży - zwróć dane z pliku
    echo file_get_contents($cacheFile);
    exit;
}

// 2. Cache jest stary lub nie istnieje - pobierz nowe dane z NBP

// Inicjalizacja cURL
$ch = curl_init();

// Ustawienie opcji cURL
curl_setopt($ch, CURLOPT_URL, $nbpUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json'
]);

// Wykonanie zapytania
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);

// Zamknięcie połączenia cURL
curl_close($ch);

// 3. Obsługa odpowiedzi z NBP
if ($response === false || $http_code !== 200) {
    // Błąd: Nie udało się pobrać danych z NBP
    http_response_code(502); // 502 Bad Gateway (bo my jesteśmy bramką)
    echo json_encode([
        'error' => 'Błąd połączenia z API NBP',
        'http_status' => $http_code,
        'curl_error' => $curl_error
    ]);
    exit;
}

// 4. Sukces: Zapisz nowe dane do cache'u i zwróć je
// Sprawdź, czy odpowiedź jest poprawnym JSON-em (zabezpieczenie)
$data = json_decode($response);
if (json_last_error() === JSON_ERROR_NONE && isset($data->rates[0]->mid)) {
    // Zapisz odpowiedź do pliku cache
    // Używamy LOCK_EX, aby zapobiec zapisywaniu przez wielu użytkowników naraz
    file_put_contents($cacheFile, $response, LOCK_EX);

    // Zwróć odpowiedź do przeglądarki
    echo $response;
} else {
    // Błąd: NBP zwróciło coś, czego się nie spodziewaliśmy
    http_response_code(500); // Internal Server Error
    echo json_encode([
        'error' => 'Otrzymano nieprawidłowe dane z API NBP.'
    ]);
}

exit;

?>