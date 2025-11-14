<div class="language-currency-controls">
    <div class="language-selector">
        <img class="flag-icon" src="/img/flag/<?php echo $_COOKIE['lang'] ?? 'pl'; ?>.svg" alt="">
        <span><?php echo $_COOKIE['lang'] ?? 'pl'; ?></span>
        <img class="arrow-down-icon" src="/img/arrow-down5.svg" alt="Rozwiń">
        <!--   submenu z językami: PL, EN, DE, RU         -->
        <ul class="language-submenu">
            <li data-lang="pl"><img class="flag-icon" src="/img/flag/pl.svg" alt="Polska flaga"> PL</li>
            <li data-lang="en"><img class="flag-icon" src="/img/flag/en.svg" alt="UK flag"> EN</li>
            <li data-lang="de"><img class="flag-icon" src="/img/flag/de.svg" alt="Niemiecka flaga"> DE</li>
            <li data-lang="ru"><img class="flag-icon" src="/img/flag/ru.svg" alt="Rosyjska flaga"> RU</li>
        </ul>
    </div>
    <div class="currency-selector">
        <span><?php echo $_COOKIE['currency'] ?? 'zł'; ?></span>
        <img class="arrow-down-icon" src="/img/arrow-down5.svg" alt="Rozwiń">
        <ul class="currency-submenu">
            <li data-currency="zł">zł</li>
            <li data-currency="EUR">EUR</li>
        </ul>
    </div>
</div><?php
