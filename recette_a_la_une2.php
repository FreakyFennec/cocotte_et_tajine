<article id="recet_en_une">
	<!--<h2 id="recet_en_une_titre">Recette à la une.</h2>-->
	<?php
		include ("connexion.php");
		// Récupération des champs
		$reponse = $bdd->query('SELECT R.id_recette, R.recette, O.origine_id, R.presentation, C.id_recet_com, 
								R.nom_img_min, R.nom_img_grd, R.alt_img,
									COUNT(C.id_recet_com) as total_com    
								FROM recettes R
								LEFT JOIN origines O
								ON R.origine_id = O.origine_id
								LEFT JOIN commentaires C
								ON R.id_recette = C.id_recet_com
								WHERE R.id_recette =  id_recette
								GROUP BY R.id_recette
								ORDER BY R.id_recette DESC 
								LIMIT 0, 1');
		// Affichage des champs (toutes les données sont protégées par htmlspecialchars)
		while ($donnees = $reponse->fetch())
		{
			echo nl2br('<div id="nom_et_origine"><h3 class="elem_nom_recet">'.htmlspecialchars($donnees['recette']).'</h3></div><a href="recette_a_la_une_detail.php?recetALaUne='.$donnees['id_recette'].'" class="text_bouton_detail"><div id="img_recet_en_une"><img src="images/'.htmlspecialchars($donnees['nom_img_grd']).'" alt="'.htmlspecialchars($donnees['alt_img']).'" />
							<div id=recet_detail_une><p id="text_presentation_une">'.htmlspecialchars($donnees['presentation']).'</p></a>
							</div>
						</div>');
		}
		$reponse->closeCursor();
	?>
</article>

	