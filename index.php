<?php
//const CACHE = true; // Włączanie cache
//define("DEV", isset($_COOKIE['DEV'])); // Włącz tryb developerski

// Ścieżki do katalogów
const DREAM_ABS = __DIR__; // Ścieżka do katalogu głównego aplikacji
const DREAM_APP = DREAM_ABS."/app"; // Ścieżka do katalogu aplikacji
include DREAM_APP."/config.php";
include DREAM_APP."/defaults.php";

define("APP_BASE_URL", "https://" . $_SERVER['HTTP_HOST'] . "/"); // Podstawowy URL aplikacji
const APP_ABSPATH = DREAM_ABS; // Absolutna ścieżka do aplikacji

defined('DREAM_APP') or die('503'); // Zapobiega bezpośredniemu dostępowi do pliku

// Wersja aplikacji
if (defined('DEV') && DEV || defined('CACHE') && CACHE === false) { // Jeśli tryb developerski lub cache jest wyłączony
//    define('VERSION', '' ); // Wersja developerska z czasem
    define('VERSION', '?v='.time() ); // Wersja developerska z czasem
} else {
    define('VERSION', '?v=1.0.06'); // Wersja produkcyjna
}


// Obsługa URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = trim($uri, '/');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $viewFile = VIEWS."/$uri";
    include DREAM_APP."/post.php";
} else { // GET
    $viewFile = VIEWS."/$uri/index.php";
    include DREAM_APP."/web_routing_cache.php";
}



function w($path = '', $file = '') {
    echo substr($path.'/'.$file, strlen(DREAM_ABS));
}
function css($path = '', $file = '') {
    echo substr($path.'/'.$file, strlen(DREAM_ABS)).VERSION;
}
