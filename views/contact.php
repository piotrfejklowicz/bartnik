<?php

// Ten plik obsługuje TYLKO żądania POST z formularza.

session_start();

// --- Konfiguracja ---
define("MAIL_FROM", 'kontakt@' . ($_SERVER['HTTP_HOST'] ?? 'localhost'));
define("MAIL_FROM_NAME", ' - Kontaktformular kandfriends.de');
//define("MAIL_TO", 'support@dev-cloud.pl'); // Zmień na swój produkcyjny email
define("MAIL_TO", 'kontakt@kandfriends.de'); // Produkcyjny email

// --- Sprawdzamy, czy to żądanie POST ---
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Jeśli ktoś spróbuje wejść na ten plik bezpośrednio, zakończ działanie
    http_response_code(405); // Method Not Allowed
    echo "Direkter Zugriff nicht erlaubt.";
    exit;
}

// ===================================================================
// --- WERYFIKACJA RECAPTCHA V3 ---
// ===================================================================
$recaptchaSecretKey = '6LdgdW4rAAAAAEfMvT1_qx8f8xt43lFN3D07yZ4o'; // !!! WSTAW TUTAJ SWÓJ KLUCZ TAJNY !!!
if (!isset($_POST['recaptcha-token'])) {
    http_response_code(400);
    echo "Fehler: reCAPTCHA-Token fehlt.";
    exit();
}
$recaptchaToken = $_POST['recaptcha-token'];
$response = file_get_contents(
    'https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptchaSecretKey . '&response=' . $recaptchaToken
);
$result = json_decode($response);
if (!$result->success || $result->score < 0.5) {
    http_response_code(403);
    echo "reCAPTCHA-Überprüfung fehlgeschlagen. Bitte versuchen Sie es erneut.";
    exit();
}

// ===================================================================
// --- POZOSTAŁE KONTROLE BEZPIECZEŃSTWA ---
// ===================================================================
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    http_response_code(403);
    echo "Sicherheitsüberprüfung fehlgeschlagen (CSRF).";
    exit;
}
unset($_SESSION['csrf_token']);
if (!empty($_POST['website_url'])) { http_response_code(403); echo "Sicherheitsüberprüfung fehlgeschlagen (Honeypot)."; exit; }
$min_time_to_submit = 3;
if (!isset($_POST['form_load_time']) || (time() - base64_decode($_POST['form_load_time'])) < $min_time_to_submit) {
    http_response_code(403); echo "Sicherheitsüberprüfung fehlgeschlagen (Time Trap)."; exit;
}

// ===================================================================
// --- WALIDACJA I PRZETWARZANIE DANYCH ---
// ===================================================================
$data = [
    'inquiry_type' => htmlspecialchars(trim($_POST['inquiry_type'] ?? '')),
    'name'         => htmlspecialchars(trim($_POST['name'] ?? '')),
    'email'        => htmlspecialchars(trim($_POST['email'] ?? '')),
    'phone'        => htmlspecialchars(trim($_POST['phone'] ?? '')),
    'message'      => htmlspecialchars(trim($_POST['message'] ?? ''))
];

$errors = [];
if (empty($data['name'])) $errors['name'] = "Der Name ist erforderlich.";
if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Eine gültige E-Mail-Adresse ist erforderlich.";
if (empty($data['message'])) $errors['message'] = "Die Nachricht ist erforderlich.";
if (empty($_POST['privacy_consent'])) $errors['privacy'] = "Die Zustimmung zur Datenschutzerklärung ist erforderlich.";

if (!empty($errors)) {
    http_response_code(422); // Unprocessable Entity
    // Zwracamy błędy jako prostą listę
    echo "Bitte korrigieren Sie die folgenden Fehler:\n- " . implode("\n- ", $errors);
    exit;
}

// ===================================================================
// --- WYSYŁKA E-MAIL ---
// ===================================================================
$to = MAIL_TO;
$subject = "Neue Nachricht aus dem Kontaktformular von: " . $data['name'];
$headers = "From: " . $data['name'] . MAIL_FROM_NAME . ' <' . MAIL_FROM . '>' . "\r\n";
$headers .= "Reply-To: " . $data['email'] . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$email_body = "<b>Sie haben eine neue Nachricht erhalten:</b><br><br>"
    . "<b>Name:</b> " . $data['name'] . "<br>"
    . "<b>Email:</b> " . $data['email'] . "<br>"
    . "<b>Telefon:</b> " . (!empty($data['phone']) ? $data['phone'] : "Nicht angegeben") . "<br><br>"
    . "<b>Nachricht:</b><br>" . nl2br($data['message']);

if (mail($to, $subject, $email_body, $headers)) {
    // Jeśli sukces, zwróć kod HTML z podziękowaniem
    http_response_code(200);
    echo "<div class='success-message'><h2>Vielen Dank!</h2><p>Ihre Anfrage wurde erfolgreich gesendet. Wir werden uns so schnell wie möglich bei Ihnen melden.</p></div>";
} else {
    // Jeśli błąd wysyłki, zwróć błąd serwera
    http_response_code(500);
    echo "Beim Senden der Nachricht ist ein interner Fehler aufgetreten. Bitte versuchen Sie es später erneut.";
}

exit;
?>