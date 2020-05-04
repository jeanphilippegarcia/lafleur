<aside class="jumbotron green-bkg-menu h-100">
	<div class="container pb-4">
		<a href="../index.php">
			<img src="Images/jpg-design-logo-official-2019-min.svg" width="32px" alt="jp logo">
			retour jpg-design.com
		</a>
	</div>
	<h1 class="brand">Sté LaFleur</h1>
	
	<div>
		<a href="index.php" title="Retour à la page d'accueil" class="btn btn-info btn-sm mb-2">Accueil</a>
	</div>
	<div>
		<a href="mailto:commercial@lafleur.com" title="Nous écrire" class="btn btn-info btn-sm">Nous écrire</a>
	</div>
	<hr>
	<p class="">Nos produits</p>
	<ul class="nav flex-column">
		<li class="nav-item"><a class="nav-link btn-sm btn-success green-btn mb-2" href="?categ=bul" title="Catalogue des bulbes">Bulbes</a></li>
		<li class="nav-item"><a class="nav-link btn-sm btn-success green-btn mb-2" href="?categ=mas" title="Catalogue des plantes à massif">Plantes à massif</a></li>
		<li class="nav-item"><a class="nav-link btn-sm btn-success green-btn" href="?categ=ros" title="Catalogue des rosiers">Rosiers</a></li>
	</ul>
	<hr>
	
	<?php

// affichage du menu si existant
if (isset($_SESSION['reference']) and count($_SESSION['reference'])>=1) {
	include'panier.php'; ?>
	
	<form action='panier.php' method='get'>
	<input type='submit' name='vider' value='Vider le panier' class='btn-sm btn-outline-secondary border'/>
	</form>
	
	<form method='get'>
	<input type='submit' name='commande' value='Commander' class='btn btn-info mt-2'/>
	</form>
<?php
}
?>
</aside>
