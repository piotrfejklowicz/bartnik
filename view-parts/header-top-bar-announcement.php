<?php if (isset($_COOKIE['topBarClosed']) && $_COOKIE['topBarClosed'] === 'true') : ?>
<?php else : ?>
    <div class="top-bar-announcement">
        <p>Nowe produkty z okazji nowej odsłony sklepu już w sprzedaży w szokująco niskich cenach!</p>
        <img class="close-icon" src="/img/delete0.svg" alt="Zamknij ogłoszenie">
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topBar = document.querySelector('.top-bar-announcement');
            const closeIcon = document.querySelector('.top-bar-announcement .close-icon');

            // Funkcja do ustawiania ciasteczka
            function setCookie(name, value, days) {
                let expires = "";
                if (days) {
                    const date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "")  + expires + "; path=/";
            }

            // Funkcja do odczytywania ciasteczka
            function getCookie(name) {
                const nameEQ = name + "=";
                const ca = document.cookie.split(';');
                for(let i = 0; i < ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            // Sprawdź, czy ciasteczko informujące o zamknięciu paska istnieje
            if (getCookie('topBarClosed') === 'true') {
                if (topBar) {
                    topBar.style.display = 'none';
                }
            }

            // Dodaj obsługę kliknięcia w ikonę zamknięcia
            if (closeIcon) {
                closeIcon.addEventListener('click', function() {
                    if (topBar) {
                        topBar.style.display = 'none';
                        // Ustaw ciasteczko na 7 dni
                        setCookie('topBarClosed', 'true', 7);
                    }
                });
            }
        });
    </script>
<?php endif; ?>