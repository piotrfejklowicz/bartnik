<?php

/**
 * Pobiera aktualny średni kurs EUR (tabela A) z NBP API.
 * * @return float|string Zwraca kurs jako float lub komunikat błędu jako string.
 */
function pobierzAktualnyKursEUR() {
    // Adres URL do API NBP dla średniego kursu EUR (tabela A)
    $url = 'http://api.nbp.pl/api/exchangerates/rates/a/eur/';

    // Inicjalizacja cURL
    $ch = curl_init();

    // Ustawienie opcji cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Zwróć wynik jako string
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout na 10 sekund

    // NBP API wymaga nagłówka 'Accept', aby zagwarantować odpowiedź w formacie JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json'
    ]);

    // Wykonanie zapytania
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);

    // Zamknięcie połączenia cURL
    curl_close($ch);

    // --- Obsługa błędów ---

    // 1. Sprawdzenie błędu cURL lub błędu HTTP
    if ($response === false || $http_code !== 200) {
        return "Błąd połączenia z NBP API. Status: $http_code. Błąd cURL: $curl_error";
    }

    // 2. Dekodowanie odpowiedzi JSON
    $data = json_decode($response);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Błąd: Nie można przetworzyć odpowiedzi JSON z NBP.";
    }

    // 3. Sprawdzenie, czy odpowiedź zawiera oczekiwany kurs
    if (isset($data->rates[0]->mid)) {
        // Zwracamy kurs jako liczbę zmiennoprzecinkową (float)
        return (float) $data->rates[0]->mid;
    } else {
        return "Błąd: Nie znaleziono kursu 'mid' w odpowiedzi API NBP.";
    }
}

// ==================================================
// ==                 PRZYKŁAD UŻYCIA              ==
// ==================================================

// Kwota w PLN, którą chcesz przeliczyć
$kwota_pln = 150.75;

echo "Próba przeliczenia kwoty: $kwota_pln PLN\n";
echo "--------------------------------------------------\n";

// Pobranie kursu
$kurs_eur = pobierzAktualnyKursEUR();

// Sprawdzenie, czy pobieranie kursu się powiodło
// Jeśli $kurs_eur jest stringiem, to znaczy, że funkcja zwróciła błąd
if (is_string($kurs_eur)) {
    echo "Wystąpił błąd: $kurs_eur\n";
} else {
    // Kurs został pobrany pomyślnie, można liczyć
    $kwota_eur = $kwota_pln / $kurs_eur;

    // Wyświetlenie sformatowanych wyników
    echo "Kwota w PLN:   " . number_format($kwota_pln, 2, ',', ' ') . " PLN\n";
    echo "Aktualny kurs: 1 EUR = " . number_format($kurs_eur, 4, ',', ' ') . " PLN\n";
    echo "Kwota w EUR:   " . number_format($kwota_eur, 2, ',', ' ') . " EUR\n";
}

?>