<?php
$searchTerm = $_GET['s'] ?? '';
?>
<main class="simple datenschutz">
  <div class="container text">

<!--    <h1 class="block-heading">Wyniki wyszukiwania</h1>-->

    <div class="page-content">

      <h1 class="subtitle h3">Wyniki wyszukiwania dla: <span class="search-term"><?= htmlspecialchars($searchTerm) ?></span></h1>

      <p class="no-results">Nie znaleziono wyników dla podanego zapytania.</p>

    </div>

  </div>
  <style>
		h1, .h1 {
			font-size: 60px;
			margin-top: 2.4rem;
			margin-bottom: 2.4rem;
		}
		h2, .h2 {
			font-size: 46px;
			margin-bottom: 1.4rem;
		}
		h3, .h3 {
			font-size: 26px;
			margin-bottom: 1.4rem;
		}
		.container.text {
			margin-bottom: 2.4rem;
			padding: 20px;
		}
		.container.text >* {
			max-width: 660px;
		}
  </style>
</main>
