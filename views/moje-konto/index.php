<?php
$w = __DIR__;
?>
<link rel="stylesheet" href="<?php css($w, 'style.css'); ?>">
<div class="page-login">
    <header class="page-header">
        <div class="container page-wrapper">
            <img class="page-header__background" src="<?php w($w); ?>honey-shape0.svg" alt="Tło w kształcie plastra miodu">
            <h1 class="page-header__title">Konto</h1>
        </div>
    </header>
    <div class="container flex">
        <div class="login">
            <h3>Zaloguj się</h3>
            <br>
            <div class="form-row">
                <label class="form-label" for="email">E-mail*</label>
                <input type="email" id="email" name="personal_data[email]" class="form-control" required="">
            </div>
            <div class="form-row">
                <label class="form-label" for="password">Hasło</label>
                <input type="password" id="password" name="personal_data[password]" class="form-control" required="">
            </div>
            <div class="form-actions">
                <button type="button" class="button-primary" data-next="2">Zaloguj</button>
            </div>
        </div>
        <div class="register">
            <h3>Nie masz konta?</h3>
            <p>Załóż konto, aby szybciej realizować zamówienia i śledzić ich status.</p>
            <div class="form-actions">
                <button type="button" class="button-secondary" data-next="2">Nowe konto</button>
            </div>
        </div>
    </div>
</div>
