<h2>Récapitulatif des articles commandés :</h2>
<?php
include "panier.php";
?>
<form action="envoyer.php" method="get">
	<label for='codeClient'>Code Client :</label>
	<input type="text" name="codeClient" size="8" value="ex : c0001" class="form-control col-md-3"/>

	<label for='mdp'>Mot de passe :</label>
	<input type="text" name="mdp" size="8" value="ex : aaa" class="form-control col-md-3"/>

	<input type="submit" action="envoyer.php" method="get" class="btn btn-info mt-3"/>
</form>
<?php
// reception de la variable de session pour affichage
if (isset($_SESSION['showEnvoi']) and !empty($_SESSION['showEnvoi'])){
	echo $_SESSION['showEnvoi'];
	unset($_SESSION['showEnvoi']);
}
?>