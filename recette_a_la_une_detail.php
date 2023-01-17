<?php include ("debut_page.php"); ?>
	<?php
		include ("connexion.php");
		// Récupération du billet
		$req = $bdd->prepare('SELECT R.recette, O.origine, R.presentation, R.nbr_pers, R.difficulte , R.tps_prep, 
										R.tps_cuis, R.ingrediens, R.epices, R.preparation, R.cuisson, 
										R.suggestion, R.nom_img, R.alt_img, 
										DATE_FORMAT (tps_prep, "%Hh%imin") AS tps_prep,
										DATE_FORMAT (tps_cuis, "%Hh%imin") AS tps_cuis
									FROM recettes R
									INNER JOIN origines O
									ON R.origine_id = O.origine_id
									WHERE id_recette = ?');

		$req->execute(array($_GET['recetALaUne']));

		while ($donnees = $req->fetch())
		{
	
		   echo nl2br('<section id="detail_recet"><div id="nom_et_origine_det"><h3 class="elem_nom_recet_det">'.htmlspecialchars($donnees['recette']).'</h3><p id="origine_det">('.htmlspecialchars($donnees['origine']).')</p></div><div id="zone_image_presenta"><img id="img_recet_det" src="images/'.htmlspecialchars($donnees['nom_img']).'" alt="'.htmlspecialchars($donnees['alt_img']).'" /><p id="presenta_det">'.htmlspecialchars($donnees['presentation']).'</p></div><div id="info_recet"><p class="info_pr">Pour : '.htmlspecialchars($donnees['nbr_pers']).' pers.</p><p class="info_diff">Difficulté : '.htmlspecialchars($donnees['difficulte']).'.</p><p class="info_prep">Préparation : '.htmlspecialchars($donnees['tps_prep']).'</p><p class="info_cuis">Cuisson : '.htmlspecialchars($donnees['tps_cuis']).'</p>
					</div>
					<div id="zone_detail"><div id="zone_ingre_epic"><p class="ingr"><strong>Ingrédients :</strong></br>'.htmlspecialchars($donnees['ingrediens']).'</p><p class="epic"><strong>Epices :</strong></br>'.htmlspecialchars($donnees['epices']).'</p></div><div id="zone_prep_cuis"><p class="prep"><strong>Préparation :</strong></br>'.htmlspecialchars($donnees['preparation']).'</p><p class="cuis"><strong>Cuisson :</strong></br>'.htmlspecialchars($donnees['cuisson']).'</p></div></div><p class="zone_sug"><strong>Suggestion :</strong></br>'.htmlspecialchars($donnees['suggestion']).'</p></section>'
			);
	?> 
	
	<a href="toutes_les_recettes.php">Retour à toutes les recettes.</a>
	<section id="vos_avis">
		<h3 id="vos_coms">Vos commentaires.</h3>  
		
		<?php
			}
			// Important : on libère le curseur pour la prochaine requête
			$req->closeCursor(); 
			
			// Récupération des commentaires
			$req = $bdd->prepare('SELECT id_recet_com, pseudo, commentaire, 
											DATE_FORMAT(date_creation_com, "%d/%m/%Y à %Hh%i") AS date_commentaire
										FROM commentaires 
										WHERE id_recet_com = ? 
										ORDER BY date_creation_com');

			$req->execute(array($_GET['recetALaUne']));
			
			while ($donnees = $req->fetch())
			{
				echo nl2br('<p><strong>'. htmlspecialchars($donnees['pseudo']).' : </strong>'.
				' Le '.htmlspecialchars($donnees['date_commentaire']).'</p>'.
				'<p>'.htmlspecialchars($donnees['commentaire']).'</p>');
		?>
		<?php
			} 
			// Fin de la boucle des commentaires
			$req->closeCursor();
		?>
	</section>
	
	<section id="donnez_votre_avis">
		<h3>
			Donnez votre avis.
		</h3>
		 <form method="post" action="commentaires_post.php?recetALaUne=<?php echo htmlspecialchars($_GET['recetALaUne']); ?>">
			<table>
				<tr>
					<td align="right">
						<label for="pseudo">Pseudo :</label>
					</td>
					<td>
						<input type="text" name="pseudo" id="pseudo" required="Veuillez compléter ce champs."/><br />
					</td>
				</tr>
				<tr>
					<td align="right">		
						<label for="commentaire">Commentaire :</label>
					</td>
					<td>	
						<textarea type="text" name="commentaire" id="commentaire" placeholder="Vôtre commentaire." required="Veuillez compléter ce champs."/></textarea><br />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>	
						<input type="submit" value="Envoyer" />
					</td>
				</tr>
			</table>
		</form>
	</section>
<?php include ("fin_page.php"); ?>
