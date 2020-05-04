<div class="jumbotron green-bkg text-dark h-100">
<?php 
include "connection_lafleur.php";
// require "model_lafleur.php";
// affiche logo.htm :
// 1 - par défaut si la variable n'est pas déclarée
if (!isset($_GET['categ']) and !isset($_GET["commande"])) {

	include_once "logo.htm";

} // afficher la commande : 
elseif (isset($_GET["commande"])) {

	include "commande.php";

}
else {
	// 2 - récup variable catégorie envoyée par le menu :
	$categ = $_GET['categ'];
	
	// requete sql pour générer tableau produits :
	$getcat = $db -> prepare("SELECT *
	FROM produit
	WHERE pdt_categorie = :cat");
	// Execute a prepared statement with named  placeholders
	$getcat -> bindvalue(':cat',$categ,PDO::PARAM_STR);
	$getcat -> execute();
	// générer tab associatif
	$cat = $getcat -> fetchAll(PDO::FETCH_ASSOC);
}

// affichage des noms de produits :
if (isset($_GET['categ'])) {
	switch ($categ):
		case "bul";
		$categ="Bulbes";
	break;
		case "mas";
		$categ="Plantes à massif";
	break;
		case "ros";
		$categ="Rosiers";
	endswitch;	
}

// affichage du tableau produits :
if ( isset($cat) ) { ?>

	<h2 class='rose'><?= $categ ?></h2>

	<table class='table table-striped table-light table-bordered'>
		<thead class='thead-light'>
			<tr>
				<th>image</th>
				<th>ref</th>
				<th>nom</th>
				<th>prix</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($cat as $line) : ?>
		<tr>
			<td><img src="Images/<?= $line['pdt_image'] ?>.jpg" /></td>
			<td><?= $line['pdt_ref'] ?></td>
			<td><?= $line['pdt_designation'] ?></td>
			<td><?= $line['pdt_prix'] ?></td>
		</tr>
		<?php endforeach; ?>
	<!-- générer choix de produits : -->
		</tbody>
	</table>
		<label for='produits Lafleur'>Choisissez un produit :</label>
	<!-- //form -->
			<form action="panier.php" method="get">
	<!-- select > envoi de la variable GET : "refPdt" -->
				<select name="refPdt" size="1" class="custom-select">';
	<!-- Remplissage de la liste déroulante à partir de la base de données. -->
				<?php foreach ($cat as $line) : ?>
					<option>
						<?= $line['pdt_designation'] ?>
					</option>
				<?php endforeach; ?>
				</select>
<!-- input > envoi de la variable GET : "quantite" -->
	<label for="Quantité :" class="m-2">Quantité :</label>
		<input type="text" name="quantite" size="1" value="1" class="form-control col-md-2"/>
<!-- input > envoi de la variable GET : "action" -->
	<p>
		<input type="submit" name="action" value="Ajouter au panier" class="btn btn-info mt-2"/>
	</p>
			</form>
<?php
}
?>
</div>
