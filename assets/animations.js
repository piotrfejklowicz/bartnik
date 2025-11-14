/**
 * Inicjalizuje obserwatorów do animowania elementów podczas przewijania.
 * Skrypt grupuje elementy na podstawie unikalnej kombinacji ich `rootMargin`
 * (z atrybutu `data-fm`) i `threshold` (z atrybutu `data-ft`), tworząc
 * dedykowane instancje IntersectionObserver dla każdej grupy.
 * Daje to pełną i wydajną kontrolę nad detekcją animacji.
 *
 * NOWOŚĆ: Jeśli kilka animacji jest aktywowanych w tym samym czasie, każda
 * kolejna jest automatycznie opóźniana o 220ms, tworząc efekt schodkowy.
 *
 * Atrybuty HTML:
 * - data-fm: Określa `rootMargin`. Może być pełnym stringiem ("0px 0px 40px 0px") lub pojedynczą liczbą ("40"), która zostanie użyta jako dolny margines.
 * - data-ft: Określa `threshold` (np. "0.5").
 * - data-fd: Określa mnożnik opóźnienia dla desktopów.
 * - data-fdm: Określa mnożnik opóźnienia dla urządzeń mobilnych.
 *
 * Przykład użycia:
 * <div class="fade" data-fm="40" data-ft="0.1" data-fd="2"></div>
 * <div class="fade" data-fm="0px 0px 40px 0"></div> <!-- To też zadziała poprawnie! -->
 */
function initializeSiteAnimations() {
    // === Konfiguracja stałych i domyślnych wartości ===
    const FADE_IN_CLASS = 'anim';
    const DEFAULT_OBSERVER_ROOT_MARGIN = '0px 0px 40px 0px'; // Zapewnione, że domyślna wartość ma jednostki
    const DEFAULT_OBSERVER_THRESHOLD = 0.35; // Domyślna wartość threshold
    const LARGE_BREAKPOINT = 1200;
    const ANIMATION_SPEED_MOBILE = 70;
    const ANIMATION_SPEED_DESKTOP = 140;
    const CLEANUP_TIMEOUT = 1800; // Bazowy czas trwania animacji w CSS
    const STAGGER_DELAY = 160; // Opóźnienie schodkowe w ms

    const animElements = document.querySelectorAll(`.fade:not(.${FADE_IN_CLASS})`);

    if (animElements.length === 0) {
        return;
    }

    const groupedElements = {};

    // 1. Pętla grupująca elementy na podstawie ich konfiguracji
    animElements.forEach(element => {
        // --- Logika dla rootMargin (z data-fm) ---
        const customMarginAttr = element.dataset.fm;
        let rootMargin = DEFAULT_OBSERVER_ROOT_MARGIN;

        if (customMarginAttr) {
            if (customMarginAttr.includes(' ')) {
                rootMargin = customMarginAttr
                    .split(' ')
                    .map(part => {
                        if (!isNaN(parseFloat(part)) && !part.endsWith('px') && !part.endsWith('%')) {
                            return `${part}px`;
                        }
                        return part;
                    })
                    .join(' ');
            } else {
                const bottomValue = parseInt(customMarginAttr, 10);
                if (!isNaN(bottomValue)) {
                    rootMargin = `0px 0px ${bottomValue}px 0px`;
                }
            }
        }

        // --- Logika dla threshold (z data-ft) ---
        const customThresholdAttr = element.dataset.ft;
        let threshold = DEFAULT_OBSERVER_THRESHOLD;

        if (customThresholdAttr !== undefined) {
            const customThreshold = parseFloat(customThresholdAttr);
            if (!isNaN(customThreshold) && customThreshold >= 0 && customThreshold <= 1) {
                threshold = customThreshold;
            }
        }

        // Tworzymy unikalny klucz dla kombinacji margin + threshold
        const groupKey = `margin_${rootMargin}_threshold_${threshold}`;

        if (!groupedElements[groupKey]) {
            groupedElements[groupKey] = {
                elements: [],
                options: {
                    rootMargin: rootMargin,
                    threshold: threshold
                }
            };
        }

        groupedElements[groupKey].elements.push(element);
    });

    /**
     * Wspólna funkcja zwrotna (callback) dla wszystkich obserwatorów.
     */
    const handleIntersection = (entries, observer) => {
        // Licznik do tworzenia opóźnienia schodkowego dla elementów pojawiających się jednocześnie.
        let staggerIndex = 0;

        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;

                const isDesktop = window.innerWidth >= LARGE_BREAKPOINT;
                const animationSpeed = isDesktop ? ANIMATION_SPEED_DESKTOP : ANIMATION_SPEED_MOBILE;
                const fadeDelayAttr = isDesktop ? target.dataset.fd : (target.dataset.fdm || target.dataset.fd);

                // Oblicz opóźnienie bazowe na podstawie atrybutów data-*
                const baseDelay = (parseInt(fadeDelayAttr, 10) || 0) * animationSpeed;

                // Oblicz opóźnienie schodkowe
                const currentStaggerDelay = staggerIndex * STAGGER_DELAY;

                // Zsumuj opóźnienia
                const totalDelay = baseDelay + currentStaggerDelay;

                // Uruchom animację z całkowitym opóźnieniem
                setTimeout(() => {
                    target.classList.add(FADE_IN_CLASS);
                }, totalDelay);

                // Usuń animację po jej zakończeniu, uwzględniając całkowite opóźnienie
                setTimeout(() => {
                    target.style.animationName = 'none';
                }, CLEANUP_TIMEOUT + totalDelay);

                // Przestań obserwować ten element, aby oszczędzić zasoby
                observer.unobserve(target);

                // Zwiększ licznik dla następnego elementu w tej samej grupie
                staggerIndex++;
            }
        });
    };

    // 2. Tworzenie obserwatorów dla każdej zdefiniowanej grupy
    for (const key in groupedElements) {
        if (Object.prototype.hasOwnProperty.call(groupedElements, key)) {
            const group = groupedElements[key];
            const observer = new IntersectionObserver(handleIntersection, group.options);
            group.elements.forEach(element => observer.observe(element));
        }
    }
}

// Wywołanie funkcji
initializeSiteAnimations();
