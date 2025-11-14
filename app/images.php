<?php

/**
 * =================================================================================
 * ZOPTYMALIZOWANY MODUŁ DO GENEROWANIA OBRAZÓW <picture>
 * =================================================================================
 *
 * Główne funkcje:
 *
 * 1. generatePicture(array $options):
 * Główna, publiczna funkcja do generowania całego elementu <picture>.
 * Przyjmuje tablicę z konfiguracją.
 *
 * 2. createImageVersions(string $imageUrl, array $config):
 * Sprawdza istnienie i w razie potrzeby tworzy wersje .webp i .avif obrazu.
 * Zwraca tablicę ze ścieżkami, rozmiarami i statusami wszystkich wersji.
 *
 * 3. convertImage(string $sourcePath, string $format, array $config):
 * Rdzeń logiki konwersji. Konwertuje plik źródłowy do podanego formatu,
 * automatycznie wybierając najlepszą dostępną bibliotekę (GD lub ImageMagick)
 * i zachowując przezroczystość z plików PNG.
 *
 * =================================================================================
 * PRZYKŁAD UŻYCIA
 * =================================================================================
 *
 * // Definiowanie ścieżek i URL (zastąp swoimi wartościami)
 * define('APP_BASE_URL', 'https://twojadomena.com');
 * define('APP_ABSPATH', __DIR__);
 *
 * // Przykład dla obrazka z wersjami na desktop, tablet i mobile
 * generatePicture([
 * 'alt' => 'Opis alternatywny obrazka',
 * 'class' => 'custom-class-picture',
 * 'lazy_load' => true, // Używa teraz natywnego loading="lazy"
 * 'img_attrs' => ['data-custom' => 'wartosc'],
 * 'sources' => [
 * // 1. Desktop (największy)
 * ['url' => '/images/desktop.jpg', 'media' => '(min-width: 1024px)'],
 * // 2. Tablet
 * ['url' => '/images/tablet.jpg', 'media' => '(min-width: 768px)'],
 * // 3. Mobile (domyślny, bez media query - musi być ostatni)
 * ['url' => '/images/mobile.jpg'],
 * ]
 * ]);
 *
 */

// --- KONFIGURACJA ---
// Ustaw globalne stałe, aby uniknąć ich wielokrotnego definiowania.
// Zastąp te wartości swoimi własnymi.
if (!defined('APP_BASE_URL')) {
    // Pełny URL do katalogu głównego Twojej aplikacji (bez slasha na końcu)
    // Przykład: 'https://twojadomena.com'
    define('APP_BASE_URL', rtrim($_SERVER['HTTP_HOST'], '/'));
}

if (!defined('APP_ABSPATH')) {
    // Absolutna ścieżka na serwerze do katalogu głównego (bez slasha na końcu)
    // Przykład: '/var/www/html'
    define('APP_ABSPATH', rtrim($_SERVER['DOCUMENT_ROOT'], '/'));
}


/**
 * Generuje kompletny element <picture> z dynamicznie tworzonymi formatami AVIF i WebP.
 *
 * @param array $options Tablica z opcjami.
 */
function generatePicture(array $options): void
{
    // --- Walidacja i ustawienia domyślne ---
    if (empty($options['sources']) || !is_array($options['sources'])) {
        return;
    }

    $config = [
        'alt'                => htmlspecialchars($options['alt'] ?? '', ENT_QUOTES, 'UTF-8'),
        'class'              => htmlspecialchars($options['class'] ?? '', ENT_QUOTES, 'UTF-8'),
        'img_attrs'          => $options['img_attrs'] ?? [],
        'lazy_load'          => $options['lazy_load'] ?? false,
        'force_regeneration' => $options['force_regeneration'] ?? false,
        'webp_quality'       => $options['webp_quality'] ?? 85,
        'avif_quality'       => $options['avif_quality'] ?? 45,
    ];

    // Obsługa obrazów SVG - dla nich nie generujemy dodatkowych formatów.
    $first_source_url = $options['sources'][0]['url'];
    if (str_ends_with(strtolower($first_source_url), '.svg')) {
        echo sprintf(
            '<picture%s><img src="%s" alt="%s"%s></picture>',
            $config['class'] ? ' class="' . $config['class'] . '"' : '',
            htmlspecialchars($first_source_url, ENT_QUOTES, 'UTF-8'),
            $config['alt'],
            implode(' ', array_map(fn($k, $v) => "$k=\"$v\"", array_keys($config['img_attrs']), $config['img_attrs']))
        );
        return;
    }

    // --- Generowanie HTML ---
    $html_sources = '';
    $fallback_source = end($options['sources']); // Ostatni obraz jest domyślnym

    foreach ($options['sources'] as $source) {
        if (empty($source['url'])) {
            continue;
        }

        $versions = createImageVersions($source['url'], $config);
        if (!$versions['original']['exists']) {
            continue;
        }

        $media_attr = isset($source['media']) ? "media=\"{$source['media']}\"" : '';

        if ($versions['avif']['exists'] && $versions['avif']['size'] < $versions['original']['size']) {
            $html_sources .= sprintf("\t<source %s type=\"image/avif\" srcset=\"%s\">\n", $media_attr, $versions['avif']['url']);
        }
        if ($versions['webp']['exists'] && $versions['webp']['size'] < $versions['original']['size']) {
            $html_sources .= sprintf("\t<source %s type=\"image/webp\" srcset=\"%s\">\n", $media_attr, $versions['webp']['url']);
        }

        $original_mime = image_type_to_mime_type($versions['original']['type']);
        $html_sources .= sprintf("\t<source %s type=\"%s\" srcset=\"%s\">\n", $media_attr, $original_mime, $versions['original']['url']);
    }

    // Przygotowanie tagu <img>
    $fallback_versions = createImageVersions($fallback_source['url'], $config);
    $img_src = $fallback_versions['original']['url'];

    // Budowanie atrybutów dla tagu <img>
    $img_attrs_str = '';
    if (!empty($fallback_versions['original']['dimensions'])) {
        $img_attrs_str .= ' ' . $fallback_versions['original']['dimensions'];
    }

    // *** POPRAWKA: Implementacja natywnego lazy loading ***
    if($config['lazy_load']) {
        $img_attrs_str .= ' loading="lazy" decoding="async"';
    }

    foreach ($config['img_attrs'] as $key => $value) {
        $img_attrs_str .= sprintf(' %s="%s"', htmlspecialchars($key), htmlspecialchars($value));
    }

    // Składanie finalnego HTML
    $picture_class_attr = $config['class'] ? ' class="' . $config['class'] . '"' : '';
    $picture_html = "<picture{$picture_class_attr}>\n";
    $picture_html .= $html_sources;
    $picture_html .= sprintf("\t<img src=\"%s\" alt=\"%s\"%s>\n", $img_src, $config['alt'], $img_attrs_str);
    $picture_html .= "</picture>";

    echo $picture_html;
}


/**
 * Tworzy wersje WebP i AVIF dla danego obrazu, jeśli nie istnieją lub są przestarzałe.
 *
 * @param string $imageUrl Względny URL do obrazu.
 * @param array $config Tablica konfiguracyjna z generatePicture.
 * @return array Tablica zawierająca informacje o wszystkich wersjach obrazu.
 */
function createImageVersions(string $imageUrl, array $config): array
{
    $originalPath = APP_ABSPATH . '/' . ltrim($imageUrl, '/');
    $originalPath = str_replace('//', '/', $originalPath);

    $pathinfo = pathinfo($originalPath);
    $results = [
        'original' => ['exists' => false],
        'webp'     => ['exists' => false],
        'avif'     => ['exists' => false],
    ];

    if (!file_exists($originalPath) || !is_file($originalPath)) {
        return $results;
    }

    $webpPath = $originalPath . '.webp';
    $avifPath = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.avif';
    $originalTimestamp = filemtime($originalPath);

    // Konwersja do WebP
    $needsWebp = !file_exists($webpPath) || ($config['force_regeneration'] ?? false) || (filemtime($webpPath) < $originalTimestamp);
    if ($needsWebp) {
        convertImage($originalPath, 'webp', $config);
    }

    // Sprawdzenie dostępności GD lub ImageMagick dla AVIF
    $avifIsSupported = function_exists('imageavif') || class_exists('Imagick');
    if ($avifIsSupported) {
        $needsAvif = !file_exists($avifPath) || ($config['force_regeneration'] ?? false) || (filemtime($avifPath) < $originalTimestamp);
        if ($needsAvif) {
            convertImage($originalPath, 'avif', $config);
        }
    }

    // --- Zbieranie informacji o wszystkich plikach ---
    $imageSizeInfo = getimagesize($originalPath);
    $results['original'] = [
        'exists'     => true,
        'path'       => $originalPath,
        'url'        => $imageUrl,
        'size'       => filesize($originalPath),
        'type'       => $imageSizeInfo[2],
        'dimensions' => $imageSizeInfo[3],
    ];

    if (file_exists($webpPath)) {
        $results['webp'] = [
            'exists' => true,
            'path'   => $webpPath,
            'url'    => $imageUrl . '.webp',
            'size'   => filesize($webpPath),
        ];
    }
    if (file_exists($avifPath)) {
        $results['avif'] = [
            'exists' => true,
            'path'   => $avifPath,
            'url'    => pathinfo($imageUrl, PATHINFO_DIRNAME) . '/' . pathinfo($imageUrl, PATHINFO_FILENAME) . '.avif',
            'size'   => filesize($avifPath),
        ];
    }

    return $results;
}


/**
 * Konwertuje obraz do formatu WebP lub AVIF, używając najlepszej dostępnej metody
 * i zachowując przezroczystość dla plików PNG.
 *
 * @param string $sourcePath Absolutna ścieżka do pliku źródłowego.
 * @param string $format Docelowy format ('webp' lub 'avif').
 * @param array $config Tablica konfiguracyjna.
 * @return bool True w przypadku sukcesu, false w przypadku porażki.
 */
function convertImage(string $sourcePath, string $format, array $config): bool
{
    $imageInfo = @getimagesize($sourcePath);
    if ($imageInfo === false) {
        return false;
    }
    $mime = $imageInfo['mime'];

    // --- Metoda 1: Użyj ImageMagick dla AVIF, jeśli jest dostępna, ALE TYLKO DLA JPG ---
    if ($format === 'avif' && class_exists('Imagick') && $mime === 'image/jpeg') {
        try {
            $pathinfo = pathinfo($sourcePath);
            $destinationPath = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.avif';
            $quality = $config['avif_quality'] ?? 45;

            $imagick = new Imagick($sourcePath);
            $imagick->setImageFormat('avif');
            $imagick->setOption('heif:quality', (string)$quality);
            $success = $imagick->writeImage($destinationPath);
            $imagick->clear();
            if ($success) {
                return true; // Jeśli się udało, zakończ
            }
        } catch (Exception $e) {
            // Jeśli ImageMagick zawiedzie, przejdziemy do GD, jeśli istnieje.
            // error_log('ImageMagick AVIF conversion failed: ' . $e->getMessage());
        }
    }

    // --- Metoda 2: Użyj biblioteki GD dla WebP lub jako fallback dla AVIF ---
    $img = null;

    // Utworzenie zasobu obrazu w zależności od typu
    switch ($mime) {
        case 'image/jpeg':
            $img = @imagecreatefromjpeg($sourcePath);
            break;
        case 'image/png':
            $img = @imagecreatefrompng($sourcePath);
            break;
        case 'image/bmp':
            $img = @imagecreatefrombmp($sourcePath);
            break;
        case 'image/webp':
            $img = @imagecreatefromwebp($sourcePath);
            break;
        default:
            return false;
    }

    if (!$img) {
        return false;
    }

    // Zachowanie przezroczystości dla PNG podczas konwersji w GD
    if ($mime === 'image/png') {
        imagepalettetotruecolor($img);
        imagealphablending($img, false); // Wyłącza blending, aby móc zapisać kanał alfa
        imagesavealpha($img, true);   // Włącza zapisywanie pełnej informacji o kanale alfa
    }

    $success = false;
    if ($format === 'webp') {
        $destinationPath = $sourcePath . '.webp';
        $quality = $config['webp_quality'] ?? 85;
        $success = imagewebp($img, $destinationPath, $quality);
    }
    // Sprawdzamy GD dla AVIF tutaj, jako fallback (jeśli ImageMagick pominął PNG)
    elseif ($format === 'avif' && function_exists('imageavif' && $mime === 'image/jpeg')) {
        $pathinfo = pathinfo($sourcePath);
        $destinationPath = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '.avif';
        $quality = $config['avif_quality'] ?? 45;
        $success = imageavif($img, $destinationPath, $quality);
    }

    imagedestroy($img);
    return $success;
}

?>
