/**
 * Inicjalizuje logikę dla "przyklejonego" nagłówka,
 * optymalizując wydajność przez throttling i IntersectionObserver.
 * Wersja rozszerzona o rozpoznawanie kierunku scrolla (góra/dół).
 */
function initializeStickyHeader() {
    // === 1. Pobranie elementów i wczesne wyjście ===
    const siteHeader = document.querySelector('#header');
    const siteFooter = document.querySelector('#footer');

    // Jeśli nie ma nagłówka, nie ma sensu nic robić dalej.
    if (!siteHeader) {
        console.warn('Sticky Header: Element #header nie został znaleziony.');
        return;
    }

    // === 2. Definicja funkcji pomocniczych i stałych ===
    const STICKY_THRESHOLD = 1386; // Piksele, po których nagłówek staje się "sticky"
    const STICKY_CLASS = 'sticky';
    const FOOTER_VISIBLE_CLASS = 'footer-visible';
    const SCROLL_DOWN_CLASS = 'scrolling-down'; // NOWA ZMIANA: Klasa dla scrolla w dół
    const SCROLL_UP_CLASS = 'scrolling-up';     // NOWA ZMIANA: Klasa dla scrolla w górę

    /**
     * Funkcja "dławiąca" (throttle) wykonanie innej funkcji.
     * (bez zmian)
     */
    const throttle = (func, limit) => {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    };

    // NOWA ZMIANA: Zmienna do przechowywania ostatniej pozycji scrolla
    let lastScrollY = window.pageYOffset;

    // === 3. Logika dla stanu "sticky" i kierunku scrolla === // ZMODYFIKOWANE
    const handleStickyState = () => {
        const currentScrollY = window.pageYOffset;

        // --- Logika "sticky" (bez zmian) ---
        // Używamy classList.toggle() dla czystszego kodu.
        const shouldBeSticky = currentScrollY >= STICKY_THRESHOLD;
        // console.log(currentScrollY,  STICKY_THRESHOLD) // Odkomentuj w razie potrzeby debugowania
        siteHeader.classList.toggle(STICKY_CLASS, shouldBeSticky);

        // --- NOWA ZMIANA: Logika kierunku scrolla ---

        // Sprawdzamy, czy nie jesteśmy na samej górze (aby uniknąć "podskoku" na iOS)
        // i czy nowa pozycja jest większa niż stara.
        if (currentScrollY > lastScrollY && currentScrollY > 0) {
            // Scroll w dół
            siteHeader.classList.add(SCROLL_DOWN_CLASS);
            siteHeader.classList.remove(SCROLL_UP_CLASS);
        } else if (currentScrollY < lastScrollY) {
            // Scroll w górę
            siteHeader.classList.add(SCROLL_UP_CLASS);
            siteHeader.classList.remove(SCROLL_DOWN_CLASS);
        }
        // Jeśli currentScrollY === lastScrollY (np. przez throttle), nic nie robimy.

        // Zaktualizuj ostatnią pozycję scrolla na sam koniec
        lastScrollY = currentScrollY;
    };


    // === 4. Logika dla widoczności stopki (IntersectionObserver) ===
    // (bez zmian)
    const handleFooterVisibility = (entries) => {
        // Bierzemy tylko pierwszy (i jedyny) obserwowany wpis
        const entry = entries[0];
        siteHeader.classList.toggle(FOOTER_VISIBLE_CLASS, entry.isIntersecting);
    };

    // === 5. Inicjalizacja i podpięcie zdarzeń ===

    // Ustawienie poprawnego stanu na starcie (zamiast zawodnych setTimeout)
    handleStickyState();

    // Nasłuchuj na scroll, ale z użyciem "dławienia" (throttlingu)
    window.addEventListener('scroll', throttle(handleStickyState, 150));

    // Jeśli stopka istnieje, uruchom dla niej IntersectionObserver
    // (bez zmian)
    if (siteFooter) {
        const footerObserver = new IntersectionObserver(handleFooterVisibility, {
            // Obserwuj, gdy stopka pojawi się nawet 1px na ekranie
            threshold: 0
        });
        footerObserver.observe(siteFooter);
    }
}

// Uruchom całą logikę dopiero po załadowaniu struktury DOM.
// (bez zmian)
document.addEventListener('DOMContentLoaded', initializeStickyHeader);