<!-- <h2>envoyer.php</h2> -->
<?php
include "connection_lafleur.php";
include_once "header.php";


if (isset($_GET['codeClient']) and isset($_GET["mdp"])) {

	$clientCode = $_GET['codeClient'];
	$clientPass = $_GET["mdp"];

// verification client connu :
	$sql = "SELECT clt_nom
		FROM clientconnu
		WHERE clt_code='$clientCode'
		AND clt_motPasse='$clientPass'
		";
	$stmt = $db->query($sql);
	$clientNom = $stmt->fetchAll(PDO::FETCH_COLUMN);
	// var_dump($clientNom);
}
// si le client est connu :
if ($clientNom) {

// générer ref client
	$date = new DateTime();
	// convertir objet Date :
	$dateString = $date->format('Y-m-d');
	$cdeMoment = $date->getTimestamp();

	// entrer la référence dans la table commande
	$sqlCommande ="INSERT INTO commande (cde_moment, cde_client, cde_date)
					VALUES ('$cdeMoment','$clientCode','$dateString')";
			$stmtCommande = $db->query($sqlCommande);

	// recup ref :
	$sqlRef = "SELECT pdt_ref
				FROM produit
				WHERE pdt_designation=?";
			$getRef = $db->prepare($sqlRef);

	// entrer codes client + produits commandés :
	$sqlEnvoi ="INSERT INTO contenir (cde_moment, cde_client, produit, quantite)
				VALUES ('$cdeMoment','$clientCode', :ref, :qte)";
			$stmtEnvoi = $db->prepare($sqlEnvoi);

/*** boucle **************************************************************************** */
	for ($i = 0; $i < count($_SESSION["reference"]); $i++) {

		$qte = $_SESSION['quantite'][$i];
		$designation = $_SESSION["reference"][$i];

		$getRef->bindValue(1,$_SESSION["reference"][$i]);
		$getRef->execute();
		$ref = $getRef->fetch(PDO::FETCH_ASSOC);

			// var_dump($_SESSION);
			// echo"<hr>";
			// var_dump($ref);

		$stmtEnvoi->bindValue(':ref',$ref['pdt_ref']);
		$stmtEnvoi->bindValue(':qte',$qte);
		$stmtEnvoi->execute();
		// vidage du panier
		$_SESSION["reference"] = array();
		$_SESSION["quantite"] = array();
	}

// init de la variable de session pour afficher message de confirmation sur la page commande
	$_SESSION['showEnvoi'] = "<div class='green'>Bonjour Mr <strong>".implode($clientNom)."</strong><br>Votre commande a bien été enregistrée sous la référence : ".$clientCode.$date->getTimestamp()."<p>
		<a class='btn btn-success mt-2' href = 'index.php'>retour au site</a>
	</p></div>";

} else {
// init de la variable de session pour afficher message d'erreur sur la page commande
	$_SESSION['showEnvoi'] = "<div class='red'>mauvais code client ou mot de passe<br>Veuillez re-saisir vos identifiants</div>";
}
// afficher la commande 2 : La requête "recapCommandes" vous permettra de vérifier les données enregistrées dans la base :
	$sql2 ="SELECT clientConnu.clt_nom, clientConnu.clt_code, commande.cde_moment, contenir.produit, 
	produit.pdt_designation, contenir.quantite
	FROM 		clientConnu, commande, contenir, produit
	WHERE 	commande.cde_client = clientConnu.clt_code
	AND		commande.cde_moment = contenir.cde_moment
	AND 	commande.cde_client = contenir.cde_client
	AND		contenir.produit = produit.pdt_ref
	ORDER BY	clientConnu.clt_nom, commande.cde_moment;";
	$stmt2 = $db->query($sql2);
	$recapCommandes = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($recapCommandes);

	// header avec les paramètres
	header("Location: index.php?commande=Commander");

?>

