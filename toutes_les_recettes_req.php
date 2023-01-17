	<h2 class="titre_principal_ttes_recet">Toutes les recettes :</h2>			
	<?php
		include ("connexion.php");
		$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
		$limite = 4;	
		// Partie "Requête"
		$debut = ($page - 1) * $limite;
		$query = 'SELECT SQL_CALC_FOUND_ROWS R.id_recette, R.recette, R.presentation, R.regOrigId, O.origine_id,  
							C.id_recet_com,R.nom_img, R.alt_img,
							COUNT(C.id_recet_com) as total_com 
					FROM recettes R
					LEFT JOIN origines O
						ON R.regOrigId = O.origine_id
					LEFT JOIN commentaires C
						ON R.id_recette = C.id_recet_com
					WHERE R.regOrigId BETWEEN 0 AND 10000
					GROUP BY id_recette
					ORDER BY id_recette DESC
					LIMIT :limite OFFSET :debut';

		$query = $bdd->prepare($query);
		$query->bindValue(
			'limite',			// Le marqueur est nommé « limite »
		  $limite,          // Il doit prendre la valeur de la variable $limite
		  PDO::PARAM_INT    // Cette valeur est de type entier
		);
		$query->bindValue(
			'debut',
		  $debut,
		  PDO::PARAM_INT
		);
		$query->execute();

		$resultFoundRows = $bdd->query('SELECT found_rows()');
		/* On doit extraire le nombre du jeu de résultat */
		$nombredElementsTotal = $resultFoundRows->fetchColumn();
		// Partie "Boucle"
		$compteur = 0;
		while ($element = $query->fetch()) {
			if ($compteur >= $limite) {
			 break;
		  }
		   echo ('
		   		<div class="zone_tte_recet">
			   		<div class="nom_et_origine">
			   			<h3 class="elem_nom_recet">'.htmlspecialchars($element['recette']).'</h3> ('.htmlspecialchars($element['origine_id']).')
			   			<p class="nbre_com_ttes_recet">Nbre de com. : '.htmlspecialchars($element['total_com']).'</p>
			   		</div>
			   		<div class="img_et_pres">
			   			<img src="images/'.htmlspecialchars($element['nom_img']).'" class="img_tte_recet" alt="'.htmlspecialchars($element['alt_img']).'" /><div class="present_et_bout">
				   			<p class="present_ttes_recet">'.nl2br (htmlspecialchars($element['presentation'])).'</p>
				   			<div class="zone_bout_det_ttes_recet">
								<p class="bouton_detail_ttes_recet"><a href="recette_a_la_une_detail.php?recetALaUne='.$element['id_recette']. '" class="bouton_detail_ttes_recet">Détail de la recette.<img id="bouton_detail_ttes_recet" src="images/flecheblanchedroite.png" alt="flecheblanchedroite" /></a></p>
							</div>	
						</div>		
			   		</div>	
				</div>');
		   $compteur++;
		}
		// Partie "Liens"
		$nombreDePages = ceil($nombredElementsTotal / $limite);

		?>
		<div id="num_pages">
			<p class="page_ttes_recet"><?php
			if ($page > 1):
				?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
			endif;

			for ($i = 1; $i <= $nombreDePages; $i++):
				?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
			endfor;

			if ($page < $nombreDePages):
				?>— <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
			endif;
			?>
			</p>
		</div>
	
