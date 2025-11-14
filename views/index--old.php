<main>
  <section class="hero">

      <?php generatePicture([
          'alt' => 'Stimmungsvoller Hintergrund der Kanzlei',
          'class' => 'hero__background-image',
          'sources' => [
              // Użyj obrazu desktopowego dla ekranów szerszych niż 44.01rem
              ['url' => '/img/hero_bg.jpg', 'media' => '(min-width: 44.01rem)'],
              ['url' => '/img/hero_bg_mobile_sm.jpg', 'media' => '(max-width: 33rem)'],
              // Użyj obrazu mobilnego jako domyślnego
              ['url' => '/img/hero_bg_mobile.jpg'],
          ]
      ]); ?>

    <svg width="1026" height="1006" viewBox="0 0 1026 1006" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g style="mix-blend-mode:darken">
        <circle cx="713" cy="483" r="312" stroke="#C6A26A" stroke-width="2"/>
      </g>
      <g style="mix-blend-mode:darken">
        <circle cx="333" cy="693" r="312" stroke="#C6A26A" stroke-width="2"/>
      </g>
      <g style="mix-blend-mode:darken">
        <circle cx="313" cy="313" r="312" stroke="#C6A26A" stroke-width="2"/>
      </g>
    </svg>

    <p class="section-title-vertical hero__title-vertical">K&nbsp;&&nbsp;Friends</p>
    <div class="hero__overlay"></div>
    <div class="hero__decorative-text">K&nbsp;&&nbsp;Friends</div>
    <div class="container hero__container">
      <div class="hero__content">
        <h1 class="hero__title">
          <span class="hero__title--main fade l">Steuerberatung.</span>
          <span class="hero__title--subtitle fade l" data-fd=".3">Menschlich. Kompetent. Digital.</span>
        </h1>
        <p class="hero__description fade l" data-fd=".6">Wir sind Ihre Steuerberatungskanzlei für vertrauensvolle und digitale Zusammenarbeit.</p>
        <a href="#kontakt" class="button button--primary fade l" data-fd="1">Kennenlerngespräch vereinbaren</a>
      </div>
      <div class="hero__image-container">
        <div class="hero__image-wrapper">
          <div class="tilt-effect" data-tilt data-tilt-reverse="true" data-tilt-max="3" data-tilt-speed="500" data-tilt-perspective="2200">
              <?php generatePicture([
                  'alt' => 'Porträt von Kia Tung und Ayda Raudzis',
                  'class' => 'hero__image img1',
                  'sources' => [
                    ['url' => '/img/hero_image.jpg', 'media' => '(min-width: 44.01rem)'],
                    ['url' => '/img/hero_image_mobile.jpg'],
                  ]
              ]); ?>
              <?php generatePicture([
                  'alt' => 'Porträt von Kia Tung und Ayda Raudzis',
                  'class' => 'hero__image img2',
                  'sources' => [
                    ['url' => '/img/hero_image2.png', 'media' => '(min-width: 44.01rem)'],
                    ['url' => '/img/hero_image2_mobile.png'],
                  ]

              ]); ?>
          </div>
        </div>
      </div>

    </div>
    <a href="#intro" class="hero__scroll-down">
      <img src="/img/scroll.svg" alt="Nach unten scrollen" width="34" height="34">
    </a>
  </section>

  <section id="intro" class="intro-section">
    <div class="container text-center">
      <h2 class="intro-section__title fade u">Sie müssen sich nicht um alles kümmern. Wir sind an Ihrer Seite.</h2>
      <p class="intro-section__subtitle fade u">Steuern, Buchhaltung, Paragraphen – all das kann sich fremd und lästig anfühlen. Mit uns als Partnerin gewinnen Sie Leichtigkeit.</p>
      <div class="intro-section__text fade u">
        <p>Bei K&nbsp;&&nbsp;Friends erhalten Sie nicht nur Klarheit, sondern einen Raum, in dem Sie sich sicher und verstanden fühlen dürfen.</p>
        <p>Wir hören zu, fragen nach – und erklären so klar wie möglich. Wir unterstützen Sie, damit Sie sich auf das Wesentliche konzentrieren können: Ihre Ziele, Ihre Ideen.</p>
      </div>
    </div>
  </section>

  <section id="ueber-uns" class="team-section">
    <h2 class="section-title-vertical team-section__title-vertical--who fade u">Wer wir sind</h2>

    <div class="team-member">
      <div class="container team-member__container reverse">
        <div class="absolute-circle shadow shadow3"></div>
        <div class="decors">
          <div class="absolute-circle filled-circle circle"></div>
          <div class="absolute-circle outline-base outline"></div>
          <div class="absolute-circle outline-base outline2"></div>
        </div>
        <div class="team-member__image-container fade r">
            <?php generatePicture([
                'alt' => 'Porträt von Kia Tung',
                'class' => 'team-member__image',
                'lazy_load' => true,
                'sources' => [['url' => '/img/kia_tung.jpg']]
            ]); ?>
        </div>
        <div class="team-member__text-content fade l">
          <div class="label">
            <span class="label__text">Geschäftsführerin</span>
            <span class="label__line"></span>
          </div>
          <h3 class="team-member__name">Kia Tung</h3>
          <p class="team-member__bio">Als Solicitor (Irland) und Attorney at Law (USA) bin ich Mitglied der Rechtsanwaltskammer und hauptverantwortlich für die steuerrechtliche und betriebswirtschaftliche Beratung bei K&nbsp;&&nbsp;Friends. Nach Abschluss meines Studiums in Betriebswirtschaftslehre und Jura sammelte ich Erfahrungen in großen und kleinen Steuer- und Rechtsanwaltskanzleien; zudem bin ich ausgebildete Mediatorin.</p>
          <p class="team-member__quote">Mein Ziel ist es, vertrauensvolle Beziehungen mit unseren Mandant*innen zu entwickeln, in denen wir gemeinsam Lösungen finden, die rechtlich verlässlich und im Leben tragfähig sind.</p>
          <div class="languages">
            <span class="languages__title">Sprachen:</span>
            <ul class="languages__list">
              <li class="languages__item"><img src="/img/de.svg" alt="Flagge Deutschlands"> deutsch</li>
              <li class="languages__item"><img src="/img/en.svg" alt="Flagge Großbritanniens"> englisch</li>
              <li class="languages__item"><img src="/img/layer-10.svg" alt="Flagge Chinesisches"> chinesisch</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="team-member">
      <div class="container team-member__container">
        <div class="absolute-circle shadow shadow4"></div>
        <div class="decors">
          <div class="absolute-circle outline-base circle2"></div>
          <div class="absolute-circle outline-base outline3"></div>
          <div class="absolute-circle outline-base outline4"></div>
        </div>
        <div class="team-member__image-container fade l">
            <?php generatePicture([
                'alt' => 'Porträt von Ayda Raudzis',
                'class' => 'team-member__image',
                'lazy_load' => true,
                'sources' => [['url' => '/img/ayda_raudzis.jpg']]
            ]); ?>
        </div>
        <div class="team-member__text-content fade r">
          <div class="label">
            <span class="label__text">Assistenz der Geschäftsführung</span>
            <span class="label__line"></span>
          </div>
          <h3 class="team-member__name">Ayda Raudzis</h3>
          <p class="team-member__bio">Als ausgebildete Tänzerin und Tanzpädagogin entschied ich mich vor nunmehr zwei Jahren für einen Quereinstieg in die Steuerberatung. Heute bin ich bei K&nbsp;&&nbsp;Friends verantwortlich für die Organisation und Vorbereitung von Buchhaltungen, Steuererklärungen und Jahresabschlüssen.</p>
          <p class="team-member__quote">Mein Gespür für Struktur, Präzision und Timing begleitet mich bis heute – und unterstützt mich dabei, auch in komplexen Berechnungstabellen den Überblick zu behalten.</p>
          <div class="languages">
            <span class="languages__title">Sprachen:</span>
            <ul class="languages__list">
              <li class="languages__item"><img src="/img/de.svg" alt="Flagge Deutschlands"> deutsch</li>
              <li class="languages__item"><img src="/img/en.svg" alt="Flagge Großbritanniens"> englisch</li>
              <li class="languages__item"><img src="/img/fa.svg" alt="Flagge Farsi"> farsi</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </section>
  <section id="our-story">
    <div class="our-story fade u">
      <div class="container text-center">
        <h2 class="section-title">Unsere gemeinsame Geschichte</h2>
        <p>Unsere Zusammenarbeit beruht auf einer langjährigen, gewachsenen Vertrauensbasis – wir kennen uns seit der Schulzeit. Nach dem Abitur absolvierten wir gemeinsam eine Vorausbildung in zeitgenössischem Tanz. Während Ayda diesen Weg professionell fortsetzte, studierte Kia Betriebswirtschaftslehre und Jura.</p>
        <p class="our-story__highlight">Heute verbinden wir unsere unterschiedlichen beruflichen Erfahrungen in der Steuer- und Rechtsberatung, um unseren Mandant*innen eine verlässliche, strukturierte und vertrauensbasierte Unterstützung anzubieten.</p>
      </div>
    </div>
    <div class="our-story">
      <div class="absolute-circle shadow shadow3"></div>
        <?php generatePicture([
            'alt' => 'Unsere gemeinsame Geschichte',
            'class' => 'our-story__bg',
            'lazy_load' => true,
            'sources' => [['url' => '/img/our-story.jpg']]
        ]); ?>
      <p class="section-title-vertical our-story__title-vertical fade u">Unsere <br>gemeinsame <br><span>Story</span></p>
      <div class="container text-center image fade u">
        <div class="our-story__image-container">
            <?php generatePicture([
                'alt' => 'Kia und Ayda in künstlerischer Pose',
                'class' => 'our-story__image',
                'lazy_load' => true,
                'sources' => [
                  ['url' => '/img/geschichte.jpg', 'media' => '(min-width: 44.01rem)'],
                  ['url' => '/img/geschichte_mobile.jpg'],
                ]
            ]); ?>
            <?php generatePicture([
                'alt' => 'leaves',
                'class' => 'leaves',
                'lazy_load' => true,
                'sources' => [['url' => '/img/leaves.png']]
            ]); ?>
        </div>
      </div>
    </div>
  </section>

  <section id="leistungen" class="services-section">
    <h2 class="section-title-vertical services-section__title-vertical">Unsere <br>Leistungen</h2>
    <div class="container">
      <h2 class="section-title text-center fade u">Unsere Leistungen</h2>
      <div class="services-section__grid">
        <article class="service-card fade l">
          <div class="csh"></div>
          <img src="/img/steuerberatung.svg" alt="Steuerberatung" class="service-card__icon" width="72" height="70">
          <h3 class="service-card__title">Steuerberatung</h3>
          <ul class="service-card__list">
            <li class="service-card__item">Jahresabschlüsse und Gewinnermittlungen</li>
            <li class="service-card__item">Steuererklärungen</li>
            <li class="service-card__item">Finanz-, Anlagen- und Lohnbuchhaltung</li>
            <li class="service-card__item">Prüfung von Steuerbescheiden</li>
          </ul>
        </article>
        <article class="service-card fade u" data-fm="90" data-ft="0.02">
          <div class="csh"></div>
          <img src="/img/beratung.svg" alt="Betriebswirtschaftliche Beratung" class="service-card__icon" width="81" height="70">
          <h3 class="service-card__title">Betriebswirtschaftliche Beratung</h3>
          <ul class="service-card__list">
            <li class="service-card__item">Betriebswirtschaftliche Auswertungen</li>
            <li class="service-card__item">Unterstützung bei finanzieller Zukunftsplanung</li>
          </ul>
        </article>
        <article class="service-card fade r">
          <div class="csh"></div>
          <img src="/img/rechtsberatung.svg" alt="Begleitende Rechtsberatung" class="service-card__icon" width="74" height="70">
          <h3 class="service-card__title">Begleitende Rechtsberatung</h3>
          <ul class="service-card__list">
            <li class="service-card__item">Einlegung von Rechtsmitteln</li>
            <li class="service-card__item">Verträge &amp; rechtliche Absicherung</li>
            <li class="service-card__item">Unternehmensgründung und Selbständigkeit</li>
            <li class="service-card__item">Erbrecht, Familienrecht &amp; mehr</li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section id="ansatz" class="approach-section">
    <div class="container approach-section__container">
      <div class="approach-section__image-container fade l">
        <div class="approach-section__image-shadow"></div>
          <?php generatePicture([
              'alt' => 'Geschäftstreffen am Tisch',
              'class' => 'approach-section__image',
              'lazy_load' => true,
              'sources' => [['url' => '/img/unser-ansatz.jpg']]
          ]); ?>
      </div>
      <div class="approach-section__text-content fade r">
        <div class="label">
          <span class="label__text">Unser Ansatz</span>
          <span class="label__line"></span>
        </div>
        <h2 class="section-title">Digital. Strukturiert. Persönlich.</h2>
        <p>Die Zusammenarbeit mit unseren Mandant*innen erfolgt vollständig digital, beispielsweise sicher über eine Datenaustauschplattform der Datev.</p>
        <p class="approach-section__highlight">Genauso wichtig ist uns auch der persönliche Kontakt. Ob per Mail, Telefon, Videotelefonie oder persönlich – wir sind für Sie da.</p>
        <a href="#kontakt" class="button button--secondary">Jetzt Termin buchen</a>
      </div>
    </div>
  </section>

  <section class="partners-section">
    <div class="container text-center">
      <h2 class="section-title fade u">Unsere Partner*innen</h2>
      <p class="fade u">Wir sind stolz und dankbar für die kollegiale und vertrauensvolle Zusammenarbeit in unserem professionellen Netzwerk von Steuer- und Rechtsberater*innen.</p>
      <div class="partners-section__thanks fade u">
        <p class="partners-section__intro-text">Unser Dank geht an</p>
        <div class="partners-section__logos">
          <span class="partner-logo">RAin Andrea May</span>
          <div class="line"></div>
          <span class="partner-logo">RAin Susanne Biener</span>
        </div>
        <div class="partners-section__logos">
          <span class="partner-logo">StB Jörg Eifler</span>
          <div class="line"></div>
          <span class="partner-logo">RA Dr. Florestan Goedings LLM</span>
        </div>
        <p class="partners-section__outro-text">und unsere weiteren Kolleg*innen, die uns mit Rat und Tat für unsere Mandant*innen zur Seite stehen.</p>
      </div>
    </div>
  </section>

  <section id="kontakt" class="contact-section">
    <img src="/img/decore0.svg" alt="" class="contact-section__decoration">
    <div class="container">
      <div class="text-center fade u">
        <h2 class="section-title">Lassen Sie uns reden!</h2>
        <p>Ob Sie Fragen haben oder direkt durchstarten wollen – wir freuen uns, von Ihnen zu hören.</p>
      </div>
        <?php //include __DIR__.'/contact.php'; ?>


      <div id="contact-section">

          <?php
          session_start();
          $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
          ?>

        <form id="contactForm" class="contact-form fade u" action="contact.php" method="POST">
<!--          <input type="hidden" name="csrf_token" value="--><?php //= htmlspecialchars($_SESSION['csrf_token']) ?><!--">-->
<!--          <input type="hidden" name="form_load_time" value="--><?php //= htmlspecialchars(base64_encode(time())) ?><!--">-->
          <input type="hidden" name="csrf_token" value="CSRF_TOKEN_PLACEHOLDER">
          <input type="hidden" name="form_load_time" value="FORM_LOAD_TIME_PLACEHOLDER">
          <div class="honeypot">
            <label for="website_url">Website</label>
            <input type="text" id="website_url" name="website_url" autocomplete="off" tabindex="-1">
          </div>

          <h2 class="section-title-vertical contact-section__title-vertical">Kontakt</h2>

          <div id="form-feedback"></div> <div class="contact-form__group contact-form__group--full">
            <label for="inquiry_type" class="visually-hidden">Anfragetyp</label>
            <input type="text" id="inquiry_type" name="inquiry_type" placeholder="Betreff der Nachricht" class="contact-form__input" value="Allgemeine Anfrage">
          </div>
          <div class="contact-form__group">
            <label for="name" class="visually-hidden">Name</label>
            <input type="text" id="name" name="name" placeholder="Name" class="contact-form__input" required>
          </div>
          <div class="contact-form__group">
            <label for="email" class="visually-hidden">E-Mail-Adresse</label>
            <input type="email" id="email" name="email" placeholder="E-Mail-Adresse" class="contact-form__input" required>
          </div>
          <div class="contact-form__group">
            <label for="phone" class="visually-hidden">Telefonnummer</label>
            <input type="tel" id="phone" name="phone" placeholder="Telefonnummer" class="contact-form__input">
          </div>
          <div class="contact-form__group contact-form__group--full">
            <label for="message" class="visually-hidden">Nachricht</label>
            <textarea id="message" name="message" placeholder="Nachricht" class="contact-form__textarea" required></textarea>
          </div>
          <label class="privacy_consent">
            <input type="checkbox" name="privacy_consent" required>
            Ich habe die <a href="/datenschutz" target="_blank">Datenschutzerklärung</a> zur Kenntnis genommen und stimme zu, dass meine Angaben zur Bearbeitung meiner Anfrage verarbeitet werden.
          </label>
          <div class="contact-form__group contact-form__group--full">
            <button type="submit" class="button button--submit">Anfrage senden</button>
          </div>
        </form>
      </div>

      <script>

          // Ustawienie flagi, aby skrypty załadowały się tylko raz
          let recaptchaLoaded = false;
          const recaptchaSiteKey = '6LdgdW4rAAAAAD56T4Y82cWTK81-zJSJLYg6H3Nu'; // Twój klucz witryny

          /**
           * Ta funkcja zawiera oryginalną logikę obsługi formularza.
           * Zostanie wywołana DOPIERO po załadowaniu API reCAPTCHA.
           */
          function initializeContactForm() {
              const form = document.getElementById('contactForm');
              if (!form) return;

              const contactSection = document.getElementById('contact-section');

              form.addEventListener('submit', async function (event) {
                  event.preventDefault();

                  const submitButton = form.querySelector('button[type="submit"]');
                  const originalButtonText = submitButton.textContent;

                  try {
                      submitButton.disabled = true;
                      submitButton.textContent = 'Sende...';

                      // Używamy grecaptcha.ready, aby mieć pewność, że wszystko jest gotowe
                      grecaptcha.ready(async function() {
                          const token = await grecaptcha.execute(recaptchaSiteKey, { action: 'contact' });

                          const formData = new FormData(form);
                          formData.append('recaptcha-token', token);

                          const response = await fetch('contact.php', {
                              method: 'POST',
                              body: formData
                          });

                          const responseText = await response.text();

                          if (response.ok) {
                              contactSection.innerHTML = responseText;
                          } else {
                              alert('Ein Fehler ist aufgetreten: ' + responseText);
                          }
                      });

                  } catch (error) {
                      console.error('Submission error:', error);
                      alert('Ein Netzwerkfehler ist aufgetreten. Bitte versuchen Sie es später erneut.');
                  } finally {
                      // Ta część może być potrzebna, jeśli wystąpi błąd PRZED wysłaniem
                      if (submitButton && contactSection.contains(form)) {
                          submitButton.disabled = false;
                          submitButton.textContent = originalButtonText;
                      }
                  }
              });
          }

          /**
           * Główna funkcja, która ładuje skrypt reCAPTCHA i inicjalizuje formularz.
           * Wywoływana jest przez nasłuchiwanie zdarzeń interakcji.
           */
          function loadRecaptchaAndInitForm() {
              if (recaptchaLoaded) {
                  return;
              }
              recaptchaLoaded = true;

              // Tworzymy dynamicznie tag <script>
              const script = document.createElement('script');
              script.src = `https://www.google.com/recaptcha/api.js?render=${recaptchaSiteKey}`;
              script.async = true;
              script.defer = true;

              // Kiedy skrypt się załaduje, uruchamiamy logikę formularza
              script.onload = initializeContactForm;

              // Dodajemy skrypt do dokumentu, co rozpoczyna jego pobieranie
              document.body.appendChild(script);

              // Usuwamy nasłuchiwacze, żeby nie uruchamiać tego ponownie
              // (chociaż opcja { once: true } już o to dba)
              window.removeEventListener('scroll', loadRecaptchaAndInitForm);
              window.removeEventListener('mousedown', loadRecaptchaAndInitForm);
              window.removeEventListener('touchstart', loadRecaptchaAndInitForm);
              window.removeEventListener('keydown', loadRecaptchaAndInitForm);
          }

          // Dodajemy nasłuchiwacze dla różnych typów interakcji.
          // Opcja { once: true } sprawia, że zdarzenie uruchomi się tylko raz.
          // Opcja { passive: true } informuje przeglądarkę, że nie zablokujemy przewijania.
          window.addEventListener('scroll', loadRecaptchaAndInitForm, { once: true, passive: true });
          window.addEventListener('mousedown', loadRecaptchaAndInitForm, { once: true });
          window.addEventListener('touchstart', loadRecaptchaAndInitForm, { once: true });
          window.addEventListener('keydown', loadRecaptchaAndInitForm, { once: true });

      </script>

    </div>
  </section>
</main>
