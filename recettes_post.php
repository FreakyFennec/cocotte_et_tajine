<?php
	include ("connexion.php");

	// Insertion du message à l'aide d'une requête préparée
	$req = $bdd->prepare('INSERT INTO recettes(
									plat,recette, mots_cles, regOrigId, origine_id, nom_img_grd,   
									nom_img, nom_img_min, alt_img, presentation, nbr_pers,   
									difficulte, ingrediens, epices, tps_prep, tps_cuis,
									preparation, cuisson, suggestion) 
								VALUES(?, ?, ?, ?, ?, 
									   ?, ?, ?, ?, ?, 
									   ?, ?, ?, ?, ?, 
									   ?, ?, ?, ?)');
	$req->execute(array(
		$_POST['plat'],
		$_POST['recette'],
		$_POST['mots_cles'],
		$_POST['regOrigId'], 
		$_POST['origine_id'],
		$_POST['nom_img_grd'],
		$_POST['nom_img'],
		$_POST['nom_img_min'],
		$_POST['alt_img'], 
		$_POST['presentation'], 
		$_POST['nbr_pers'],
		$_POST['difficulte'],
		$_POST['les_ingrediens'],
		$_POST['epices'],
		$_POST['tps_prep'], 
		$_POST['tps_cuis'],
		$_POST['preparation'], 
		$_POST['cuisson'], 
		$_POST['suggestion']));

	// Redirection du visiteur vers la page index
	header('Location: recettes_form.php');
?>