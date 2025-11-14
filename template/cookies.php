    <style>
			/* --- STYLING BANERA COOKIE --- */
			:root {
				--cookie-banner-bg: #fff;
				--cookie-banner-text-color: #333;
				--cookie-primary-btn-bg: var(--mc2, #3c291e);
				--cookie-primary-btn-bg-hover: var(--dc2, #271b14); /* ZMIANA/NOWOŚĆ: Ciemniejszy odcień zieleni */
				--cookie-primary-btn-text: #fff;
				--cookie-secondary-btn-bg: #6c757d;
				--cookie-secondary-btn-bg-hover: #5a6268; /* ZMIANA/NOWOŚĆ */
				--cookie-secondary-btn-text: #fff;
				--cookie-default-btn-bg: #f8f9fa;
				--cookie-default-btn-bg-hover: #e2e6ea; /* ZMIANA/NOWOŚĆ */
				--cookie-default-btn-text: #333;
				--cookie-overlay-bg: rgba(0, 0, 0, 0.6);
				--cookie-slider-bg: #ccc;
				--cookie-slider-checked-bg: var(--mc2, #3c291e);
			}

			.cookie-banner-content .cookie-main-title {
				font-size: 36px;
				line-height: 1.1;
				font-family: var(--fh, 'Crimson Text');
				margin-bottom: 0.8rem;
			}
			#cookie-modal-overlay {
        .cookie-modal-title {
          font-size: 1.7rem;
					line-height: 1.1;
          font-family: var(--fh, 'Crimson Text');
        }
        .cookie-category-title {
          font-family: var(--fh, 'Crimson Text');
        }
      }

			.cookie-banner-container {
				position: fixed;
				bottom: 0;
				left: 0;
				width: 100%;
				background-color: var(--cookie-banner-bg);
				color: var(--cookie-banner-text-color);
				z-index: 9999;
				box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
				transform: translateY(100%);
				transition: transform 0.5s ease-in-out;
				padding: 20px;
				box-sizing: border-box;
				zoom: .85;
			}

			.cookie-banner-container.show {
				transform: translateY(0);
			}

			.cookie-banner-content {
				max-width: 1200px;
				margin: 0 auto;
				display: flex;
				flex-direction: column;
				gap: 15px;
			}

			.cookie-banner-content p {
				margin: 0;
				font-size: 14px;
				line-height: 1.5;
			}

			.cookie-banner-content a {
				color: var(--cookie-primary-btn-bg);
				text-decoration: underline;
				transition: color 0.2s ease;
			}

			.cookie-banner-content a:hover {
				color: var(--cookie-primary-btn-bg-hover);
			}

			/* ZMIANA/NOWOŚĆ: Style dla tytułów jako <p> */
			.cookie-main-title {
				font-size: 1.25rem; /* Zastępuje H3 */
				font-weight: bold;
				margin: 0 0 10px 0;
			}

			.cookie-modal-title {
				font-size: 1.5rem; /* Zastępuje H2 */
				font-weight: bold;
				margin: 0 0 15px 0;
			}

			.cookie-category-title {
				font-size: 1.1rem; /* Zastępuje H3 w modalu */
				font-weight: bold;
				margin: 0;
			}

			.cookie-banner-buttons {
				display: flex;
				gap: 10px;
				flex-wrap: wrap;
				justify-content: center;
			}

			.cookie-banner-buttons button,
			.cookie-modal-buttons button {
				padding: 10px 20px;
				border: 1px solid transparent;
				border-radius: 5px;
				cursor: pointer;
				font-size: 14px;
				font-weight: bold;
				flex-grow: 1;
				min-width: 200px;
				transition: background-color 0.2s ease, border-color 0.2s ease;
			}

			#cookie-accept-all {
				background-color: var(--cookie-primary-btn-bg);
				color: var(--cookie-primary-btn-text);
				border-color: var(--cookie-primary-btn-bg);
			}

			#cookie-accept-all:hover {
				background-color: var(--cookie-primary-btn-bg-hover);
				border-color: var(--cookie-primary-btn-bg-hover);
			}

			#cookie-accept-essential {
				background-color: var(--cookie-secondary-btn-bg);
				color: var(--cookie-secondary-btn-text);
				border-color: var(--cookie-secondary-btn-bg);
			}

			#cookie-accept-essential:hover {
				background-color: var(--cookie-secondary-btn-bg-hover);
				border-color: var(--cookie-secondary-btn-bg-hover);
			}

			#cookie-settings-btn {
				background-color: var(--cookie-default-btn-bg);
				color: var(--cookie-default-btn-text);
				border: 1px solid #ccc;
			}

			#cookie-settings-btn:hover {
				background-color: var(--cookie-default-btn-bg-hover);
			}

			/* --- STYLING MODALU USTAWIEŃ --- */
			.cookie-modal-overlay {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 130%;
				background-color: var(--cookie-overlay-bg);
				z-index: 10000;
				display: none;
				justify-content: center;
				align-items: center;
			}

			.cookie-modal-overlay.show {
				display: flex;
			}

			.cookie-modal-content {
				background-color: var(--cookie-banner-bg);
				padding: 30px;
				border-radius: 8px;
				max-width: 90%;
				width: 700px;
				max-height: 90vh;
				overflow-y: auto;
				box-shadow: 0 5px 15px rgba(0,0,0,0.3);
				margin: 0 auto;
			}

			.cookie-category {
				border-bottom: 1px solid #eee;
				padding: 15px 0;
			}

			.cookie-category:last-of-type {
				border-bottom: none;
			}

			.cookie-category-header {
				display: flex;
				justify-content: space-between !important;
				align-items: center !important;
				cursor: pointer;
			}

			.cookie-category-description {
				font-size: 13px;
				color: #555;
				margin-top: 8px;
			}

			/* Stylizacja przełącznika (toggle switch) */
			.cookie-toggle {
				display: flex;
				align-items: center;
			}

			.cookie-toggle-label {
				margin-right: 10px;
				font-weight: bold;
				font-size: 14px;
			}

			.switch {
				position: relative;
				display: inline-block;
				width: 50px;
				height: 24px;
			}

			.switch input {
				opacity: 0;
				width: 0;
				height: 0;
			}

			.slider {
				position: absolute;
				cursor: pointer;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-color: var(--cookie-slider-bg);
				transition: .4s;
				border-radius: 24px;
			}

			.slider:before {
				position: absolute;
				content: "";
				height: 18px;
				width: 18px;
				left: 3px;
				bottom: 3px;
				background-color: white;
				transition: .4s;
				border-radius: 50%;
			}

			input:checked + .slider {
				background-color: var(--cookie-slider-checked-bg);
			}

			input:checked + .slider:before {
				transform: translateX(26px);
			}

			input:disabled + .slider {
				background-color: #e9e9e9;
				cursor: not-allowed;
			}

			input:disabled + .slider:before {
				background-color: #ccc;
			}

			.cookie-modal-buttons {
				margin-top: 25px;
				display: flex;
				gap: 10px;
				flex-wrap: wrap;
			}

			.cookie-modal-buttons #cookie-save-settings {
				background-color: var(--cookie-primary-btn-bg);
				color: var(--cookie-primary-btn-text);
				border-color: var(--cookie-primary-btn-bg);
			}

			.cookie-modal-buttons #cookie-save-settings:hover {
				background-color: var(--cookie-primary-btn-bg-hover);
				border-color: var(--cookie-primary-btn-bg-hover);
			}

			.cookie-modal-buttons #cookie-modal-accept-all {
				background-color: var(--cookie-primary-btn-bg);
				color: var(--cookie-primary-btn-text);
				border-color: var(--cookie-primary-btn-bg);
			}
			.cookie-modal-buttons #cookie-modal-accept-all:hover {
				background-color: var(--cookie-primary-btn-bg-hover);
				border-color: var(--cookie-primary-btn-bg-hover);
			}

			.cookie-modal-buttons #cookie-modal-reject-all {
				background-color: var(--cookie-secondary-btn-bg);
				color: var(--cookie-secondary-btn-text);
				border-color: var(--cookie-secondary-btn-bg);
			}
			.cookie-modal-buttons #cookie-modal-reject-all:hover {
				background-color: var(--cookie-secondary-btn-bg-hover);
				border-color: var(--cookie-secondary-btn-bg-hover);
			}


			/* --- STYL PŁYWAJĄCEGO PRZYCISKU --- */
			#cookie-reopener-button {
				position: fixed;
				bottom: 20px;
				left: 20px;
				width: 50px;
				height: 50px;
				background-color: var(--cookie-primary-btn-bg);
				color: white;
				border-radius: 50%;
				display: none;
				justify-content: center;
				align-items: center;
				cursor: pointer;
				z-index: 9998;
				box-shadow: 0 4px 8px rgba(0,0,0,0.2);
				transition: transform 0.3s ease, opacity 0.3s ease, background-color 0.2s ease;
				opacity: 0;
				transform: scale(0.5);
			}

			#cookie-reopener-button.show {
				display: flex;
				opacity: 1;
				transform: scale(1);
			}

			#cookie-reopener-button:hover {
				background-color: var(--cookie-primary-btn-bg-hover);
				transform: scale(1.1);
			}

			#cookie-reopener-button svg {
				width: 24px;
				height: 24px;
				fill: white;
			}

			@media (max-width: 66rem) {
				.cookie-banner-content {
					flex-direction: column;
					align-items: stretch;
				}
				.cookie-banner-buttons {
					flex-direction: column;
					margin: auto;
				}
				.cookie-banner-buttons button {
					width: 100%;
				}
				.cookie-modal-buttons {
					flex-direction: column;
				}
				.cookie-modal-content {
					padding: 20px;
					max-height: 92vh;
				}
				div#cookie-modal-overlay p {
					font-size: 0.89rem;
					line-height: 1.22;
				}
				.cookie-banner-buttons button, .cookie-modal-buttons button {
					width: 100%;
				}
			}
    </style>

<!-- ======== KOD BANERA COOKIE (POCZĄTEK) ======== -->

<?php include __DIR__.'/cookies-pl.php' ;?>

<!-- ======== KOD BANERA COOKIE (KONIEC) ======== -->


<!-- Tutaj wklej kod JavaScript lub podlinkuj plik .js -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const COOKIE_NAME = 'user_cookie_consent';
        const COOKIE_EXPIRATION_DAYS = 365;

        const banner = document.getElementById('cookie-banner');
        const modalOverlay = document.getElementById('cookie-modal-overlay');
        const modalContent = document.getElementById('cookie-modal-content');

        const acceptAllBtn = document.getElementById('cookie-accept-all');
        const acceptEssentialBtn = document.getElementById('cookie-accept-essential');
        const settingsBtn = document.getElementById('cookie-settings-btn');

        const saveSettingsBtn = document.getElementById('cookie-save-settings');
        const modalAcceptAllBtn = document.getElementById('cookie-modal-accept-all');
        const modalRejectAllBtn = document.getElementById('cookie-modal-reject-all');

        const reopenerBtn = document.getElementById('cookie-reopener-button');

        const analyticsCheckbox = document.getElementById('cookie-cat-analytics');
        const marketingCheckbox = document.getElementById('cookie-cat-marketing');

        function loadAnalyticsScripts() {
            // console.log("loading Analytics...");
        }

        function loadMarketingScripts() {
            // console.log("loading Marketing...");
        }

        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function hideBanner() {
            banner.classList.remove('show');
            reopenerBtn.classList.add('show');
        }

        function showBanner() {
            banner.classList.add('show');
            reopenerBtn.classList.remove('show');
        }

        function showModal() {
            const consent = getCookie(COOKIE_NAME);
            if (consent) {
                try {
                    const choices = JSON.parse(consent);
                    analyticsCheckbox.checked = choices.analytics;
                    marketingCheckbox.checked = choices.marketing;
                } catch(e) { /* ignoruj błąd, użyj domyślnych */ }
            }
            modalOverlay.classList.add('show');
        }

        function hideModal() {
            modalOverlay.classList.remove('show');
        }

        function executeConsent() {
            const consent = getCookie(COOKIE_NAME);
            if (!consent) {
                showBanner();
                return;
            }

            reopenerBtn.classList.add('show');

            try {
                const choices = JSON.parse(consent);
                // console.log("Zgoda znaleziona:", choices);

                if (choices.analytics) {
                    loadAnalyticsScripts();
                }
                if (choices.marketing) {
                    loadMarketingScripts();
                }
            } catch (e) {
                // console.error("Błąd parsowania cookie zgody:", e);
                setCookie(COOKIE_NAME, '', -1);
                showBanner();
            }
        }

        function saveConsent(choices) {
            hideBanner();
            hideModal();
            setCookie(COOKIE_NAME, JSON.stringify(choices), COOKIE_EXPIRATION_DAYS);
            window.location.reload();
        }

        // --- Event Listeners ---

        acceptAllBtn.addEventListener('click', () => {
            const choices = { essential: true, analytics: true, marketing: true };
            saveConsent(choices);
        });

        modalAcceptAllBtn.addEventListener('click', () => {
            const choices = { essential: true, analytics: true, marketing: true };
            analyticsCheckbox.checked = true;
            marketingCheckbox.checked = true;
            saveConsent(choices);
        });

        acceptEssentialBtn.addEventListener('click', () => {
            const choices = { essential: true, analytics: false, marketing: false };
            saveConsent(choices);
        });

        modalRejectAllBtn.addEventListener('click', () => {
            const choices = { essential: true, analytics: false, marketing: false };
            analyticsCheckbox.checked = false;
            marketingCheckbox.checked = false;
            saveConsent(choices);
        });

        settingsBtn.addEventListener('click', showModal);

        saveSettingsBtn.addEventListener('click', () => {
            const choices = {
                essential: true,
                analytics: analyticsCheckbox.checked,
                marketing: marketingCheckbox.checked
            };
            saveConsent(choices);
        });

        reopenerBtn.addEventListener('click', showModal);

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                hideModal();
            }
        });

        executeConsent();
    });
</script>