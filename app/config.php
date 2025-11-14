<?php
defined('DREAM_APP') or die('503'); // Zapobiega bezpośredniemu dostępowi do pliku
const TEMPLATES = DREAM_ABS."/template"; // Ścieżka do katalogu aplikacji
const VIEWS = DREAM_ABS."/views"; // Ścieżka do katalogu aplikacji
const ASSETS = DREAM_ABS."/assets";
define("PART", dirname(__DIR__) . '/view-parts/'); // Ścieżka do folderu z częściami widoków
$cacheDir = DREAM_ABS.'/cache/';
$cacheTime = 6000; // 100 minut
