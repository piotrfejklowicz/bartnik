<?php
defined('DREAM_APP') or die('503'); // Zapobiega bezpośredniemu dostępowi do pliku

if (file_exists($viewFile)) {
    include $viewFile;
} else if (file_exists($viewFile.'.php')) {
    include $viewFile.'.php';
} else {
    http_response_code(404);
    include TEMPLATES."/404.php";
}