<?php
include_once 'header.php';
include "connection_lafleur.php";
// init total outside the loop :
$total=0;

// création des arrays / initialisation des variables de session :
if (!isset($_SESSION["reference"])) {

	$_SESSION["reference"]=array();
	$_SESSION["quantite"]=array();
	// dbg($_SESSION["reference"]);
}

// remplir panier : récup des variables & remplissage des arrays
if (isset($_GET['refPdt'], $_GET['quantite'])) {
// test doublons avec un booleen
$doublon = false;
	for($i=0;$i<count($_SESSION["reference"]);$i++){

		if ($_GET['refPdt'] == $_SESSION["reference"][$i]) {
			$doublon = true;
			$refDoublon = $i;
		} 	
	}
	
	if ($doublon){
		$_SESSION['quantite'][$refDoublon] += $_GET['quantite'];
	} else {
		array_push($_SESSION["reference"], $_GET['refPdt']);
		array_push($_SESSION["quantite"], $_GET['quantite']);
	}
}

// vider panier : vider les arrays
if (isset($_GET['vider'])) {

	$_SESSION["reference"] = array();
	$_SESSION["quantite"] = array();
}

// Après la mise à jour du panier, il convient de recharger la page "menu.php" ("panier.php" est chargé dans le cadre "menu"). Ceci peut être fait à l'aide de l'instruction PHP "header" qui envoie un entête HTML au serveur : header("Location: menu.php");
// relocation vers l'affichage de la catégorie courante sur : "ajouter au panier" ou "vider"
if (isset($_GET["action"]) or isset($_GET["vider"])) {

	header("Location:" .$_SERVER['HTTP_REFERER']);
}

echo "<table class='table table-striped table-light table-bordered table-sm'>
	<thead class='thead-light'>
		<th class='small'>Ref</th>
		<th class='small'>Désignation</th>
		<th class='small'>Px&nbsp;Unit.</th>
		<th class='small'>Qté</th>
		<th class='small'>Montant</th>
	</thead><tbody>";
// affichage du panier :
for ($i = 0; $i < count($_SESSION["reference"]); $i++) {

	$qte = $_SESSION['quantite'][$i];
	$designation = $_SESSION["reference"][$i];

	?>
	<tr>
		<td>
			<?php
			// ref :
			$sql = "SELECT pdt_ref
				FROM produit
				WHERE pdt_designation='$designation'";
			$stmt = $db->query($sql);
			$ref = $stmt->fetch(PDO::FETCH_COLUMN);

			echo $ref;

			?>
		</td>
		<td><?= $designation ?></td>
		<td>
			<?php
			// prix unit :
			$sql = "SELECT pdt_prix
				FROM produit
				WHERE pdt_designation='$designation'";
			$stmt = $db->query($sql);
			$prix = $stmt->fetch(PDO::FETCH_COLUMN);

			echo $prix;
			?>
		</td>
		<td><?= $qte ?></td>
		<td>
			<?php
			// Montant :
			$montant = $qte * $prix;
			$total += $montant;
			echo $montant;
			?>
		</td>
	</tr>
<?php
}?>


<tr>
	<td colspan='4'>Total :</td>
	<td>
		<?php echo $total; ?>
	</td>
</tr>

</tbody></table>