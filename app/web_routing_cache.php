<?php
defined('DREAM_APP') or die('503'); // Zapobiega bezpośredniemu dostępowi do pliku




// Wyłącz cache, jeśli jesteś zalogowany
//$isLoggedIn = !empty($_SESSION['logged_in']);
// Cache ustawienia
if (CACHE) {
    header("Cache-Control: public, max-age=31536000"); // Cache przez rok
} else {
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
}
$isLoggedIn = false; // Domyślnie ustawiamy, że użytkownik nie jest zalogowany
include DREAM_APP."/images.php";
//session_start();

// regex, który zamienia, jeśli $viewFile zawiera "/kategorie/" + [coś jeszcze] + "index.php" to ustawiamy $viewFile na "/kategorie/miody/index.php"
//$uri = $_SERVER['REQUEST_URI'];
//$uri = trim($uri, '/'); // Usuń początkowe i końcowe ukośniki
$viewFile = preg_replace('/\/kategoria\/[^\/]+\/index\.php$/', '/kategoria/miody/index.php', $viewFile); // Zamień /kategorie/ + [cokolwiek] + /index.php na /kategorie/miody
$viewFile = preg_replace('/\/kategoria2\/[^\/]+\/index\.php$/', '/kategoria2/miody/index.php', $viewFile); // Zamień /kategorie/ + [cokolwiek] + /index.php na /kategorie/miody
$viewFile = preg_replace('/\/kategorie\/[^\/]+\/index\.php$/', '/kategoria/miody/index.php', $viewFile); // Zamień /kategorie/ + [cokolwiek] + /index.php na /kategorie/miody
//$viewFile = DREAM_APP . "/views/" . $viewFile . ".php"; // Ścieżka do pliku widoku



//
//if (file_exists($viewFile)) {
//    include TEMPLATES."/header.php";
//    include $viewFile;
//    include TEMPLATES."/footer.php";
//} else {
//    http_response_code(404);
//    include TEMPLATES."/header.php";
//    include TEMPLATES."/404.php";
//    include TEMPLATES."/footer.php";
//}

/**
 * Dołącza część widoku (działa jak include dla shortcode'ów).
 * Wszystkie zmienne dostępne w miejscu wywołania będą dostępne w dołączanym pliku.
 *
 * @param string $part_name Nazwa pliku bez rozszerzenia .php z folderu /view-parts/
 */
//function part(string $part_name): void
//{
//    $file_path = dirname(__DIR__) . '/view-parts/' . $part_name . '.php';
//
//    if (file_exists($file_path)) {
//        // --- LINIA DEBUGOWANIA ---
//        // Wyświetli wszystkie zmienne dostępne w tym miejscu.
//        echo '<pre>';
//        var_dump(array_keys(get_defined_vars()));
//        echo '</pre>';
//        // ------------------------
//        include $file_path;
//    } else {
//        echo "";
//    }
//}

/**
 * Przetwarza tekst w poszukiwaniu shortcodów i zastępuje je zawartością odpowiednich plików.
 *
 * @param string $content Tekst do przetworzenia.
 * @return string Tekst z zamienionymi shortcodami.
 */
function render_shortcodes(string $content): string
{
    // Definiujemy folder, w którym będziemy przechowywać pliki naszych shortcodów
    $shortcodes_dir = dirname(__DIR__) . '/view-parts/';

    // Używamy preg_replace_callback do znalezienia wszystkich wystąpień [nazwa-shortcoda]
    return preg_replace_callback(
        '/\[([a-zA-Z0-9_-]+)\]/', // Wyrażenie regularne do wyszukania shortcodów
        function ($matches) use ($shortcodes_dir) {
            // $matches[0] to cały znaleziony ciąg, np. "[slider-hero]"
            // $matches[1] to sama nazwa w nawiasie, np. "slider-hero"
            $shortcode_name = $matches[1];

            // Tworzymy pełną ścieżkę do pliku PHP shortcodu
            $file_path = $shortcodes_dir . $shortcode_name . '.php';

            // Sprawdzamy, czy taki plik istnieje, aby uniknąć błędów
            if (file_exists($file_path)) {
                // Używamy buforowania wyjścia, aby przechwycić cały kod z pliku
                // zamiast go od razu wyświetlać.
                ob_start();
                include $file_path;
                return ob_get_clean(); // Zwracamy zawartość bufora i go czyścimy
            }

            // Jeśli plik nie istnieje, zwracamy pusty ciąg znaków lub oryginalny shortcode,
            // aby nie psuć treści.
            return ''; // lub return $matches[0];
        },
        $content
    );
}


function mini_html($buffer): array|string|null
{

    $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);
//    $buffer = preg_replace('//*(.|\s)*?*//', '', $buffer);
//    $buffer = preg_replace('//(.|\s)*?/n', '', $buffer);
    $pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
    $buffer = preg_replace($pattern, '', $buffer);
//    return $buffer;

    $wyszukaj = array(
//        '/\/\*(.*?)\*\//s',      // Usuń komentarze CSS i JS w bloku /* ... */
//        '#//(?!https?|ftp)(.*?)[\r\n]#', // Usuń komentarze JS //, ignorując te w URL-ach
//        '//s',      // Usuń komentarze HTML
//         '/\>[^\S ]+/s',         // Usuń białe znaki po tagach, ale przed tekstem
//        '/[^\S ]+\</s',         // Usuń białe znaki przed tagami, ale po tekście
        '/(\s)+/s',             // Skompresuj wielokrotne białe znaki w jeden
//        '#\s*(<(/?[^>]+?)>\s*)#',// Usuń białe znaki wokół tagów HTML
    );
    $zamien = array(
        ' ', // Zamień wielokrotne białe znaki na pojedynczy spację
//        "\n",
//        '',
//        '>',
//        '<',
//        '\\1',
//        '<$2>',
    );
    return preg_replace($wyszukaj, $zamien, $buffer);
}



// --- POCZĄTEK NOWEJ LOGIKI ROUTINGU PRODUKTÓW ---

// Pobieramy samą ścieżkę z adresu URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Sprawdzamy, czy ścieżka pasuje do wzorca strony produktu, np. /product/miod-akacjowy
if (preg_match('/^\/product\/(.+)/', $path, $matches)) {

    // Jeśli tak, to oznacza, że jesteśmy na stronie produktu.
    // $matches[1] będzie zawierać slug produktu, np. "miod-akacjowy-1000-g"
    $product_slug = $matches[1];

    // Zamiast szukać pliku /product/miod-akacjowy.php (który nie istnieje),
    // ręcznie ustawiamy ścieżkę do JEDNEGO, uniwersalnego szablonu produktu.
    // Załóżmy, że nazywa się on 'product-page.php' i jest w folderze 'views'.
    $viewFile = DREAM_ABS . "/views/product/index.php";

    // Wartość ?t=... będzie normalnie dostępna w szablonie przez $_GET['t']
    // a slug produktu przez zmienną $product_slug.
}

// --- KONIEC NOWEJ LOGIKI ROUTINGU ---






session_start();
$cacheFile = $cacheDir . md5($uri) . ".html";

// Generujemy token dla bieżącej sesji.
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];


// Sprawdzamy, czy istnieje ważny plik w cache i czy użytkownik nie jest zalogowany.
if (CACHE && !$isLoggedIn && file_exists($cacheFile)) {
    // KROK 1: SERWUJEMY Z CACHE

    // Wczytaj z cache stronę zawierającą placeholder.
    $cachedOutput = file_get_contents($cacheFile);

    // Podmień placeholder na świeży token i wyślij do przeglądarki.
    $cachedOutput =  str_replace('CSRF_TOKEN_PLACEHOLDER', htmlspecialchars($csrfToken), $cachedOutput);
    $cachedOutput =  str_replace('FORM_LOAD_TIME_PLACEHOLDER', htmlspecialchars(base64_encode(time())), $cachedOutput);
    echo $cachedOutput;

} else {
    // KROK 2: GENERUJEMY STRONĘ I TWORZYMY CACHE

    if (file_exists($viewFile)) {

        ob_start();
        if (file_exists(dirname($viewFile) . '/_head.php')) {
            include dirname($viewFile) . '/_head.php'; // Wczytaj zawartość widoku
            $outputHead = ob_get_clean();
        } else {
            $outputHead = '';
            ob_end_clean();
        }

        include TEMPLATES."/header.php";
        include $viewFile; // Wczytaj zawartość widoku
        include TEMPLATES."/footer.php";


        // Pobierz całą zawartość strony z bufora do zmiennej.
        $outputWithPlaceholder = ob_get_clean();

        // PRZETWÓRZ ZAWARTOŚĆ W POSZUKIWANIU SHORTCODÓW
//        $outputWithPlaceholder = render_shortcodes($outputWithPlaceholder);

        // Kontynuuj minifikację i dalsze operacje.
        $outputWithPlaceholder = mini_html($outputWithPlaceholder);

        // Zapisz do cache wersję Z PLACEHOLDEREM. To kluczowe!
        if (CACHE && !$isLoggedIn) {
            file_put_contents($cacheFile, $outputWithPlaceholder);
        }

        // Teraz podmień placeholder na token i wyślij do przeglądarki.
        $outputWithPlaceholder =  str_replace('CSRF_TOKEN_PLACEHOLDER', htmlspecialchars($csrfToken), $outputWithPlaceholder);
        $outputWithPlaceholder =  str_replace('FORM_LOAD_TIME_PLACEHOLDER', htmlspecialchars(base64_encode(time())), $outputWithPlaceholder);
        echo $outputWithPlaceholder;

    } else {
        http_response_code(404);
        include TEMPLATES."/header.php";
        include TEMPLATES."/404.php";
        include TEMPLATES."/footer.php";
    }
}
echo '<!-- Designed by Diamond Creators and Development by CyberDream -->';


//// Plik cache
//$cacheFile = $cacheDir . md5($uri) . ".html";
//
//// Serwuj cache jeśli dostępny
//if (CACHE &&  file_exists($cacheFile)) {
//    readfile($cacheFile);
//} else {
//    if (file_exists($viewFile)) {
//        ob_start();
//
//        include TEMPLATES."/header.php";
//        include $viewFile;
//        include TEMPLATES."/footer.php";
//
//        $output = ob_get_clean();
//        if (CACHE && !empty($output)) {
//            file_put_contents($cacheFile, $output);
//        }
//        echo $output;
//    } else {
//        http_response_code(404);
//        include TEMPLATES."/header.php";
//        include TEMPLATES."/404.php";
//        include TEMPLATES."/footer.php";
//    }
//}
//
//
//exit();