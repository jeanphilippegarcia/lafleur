<?php
require"header.php";
// if user a cliqué sur envoyer
if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {

    $nom=$_POST['name'];
    $message=$_POST['message'];
// envoi par mail Failed to connect to mailserver
	$retour = mail('commercial@lafleur.com', 'Envoi depuis site Lafleur', $_POST['message'], 'From : ' . $_POST['email']);
	
    if($retour)
    echo htmlspecialchars('Merci '.$nom.', Votre message : '.$message.' ; a bien été envoyé');
    // echo htmlspecialchars($_POST['prenom']);
}
else {
    echo 'Désolé '.$nom.',la transmission de votre message a échoué';
}
// affiche données post
// var_dump ($_POST);

?>

<a class='btn' href = 'index.php'>retour au site</a>