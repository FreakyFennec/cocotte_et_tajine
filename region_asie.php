<!DOCTYPE html>
<html>
	<head>
		<?php include ("head.php"); ?>
	</head>

	<body>
		<div id="bloc_page">
		<?php include ("header.php"); ?>

		<h3 class="elem_nom_result_recherche">Toutes les recettes d'Asie.</h3>

		<?php
			try
			{
				$cnx = new PDO('mysql:host=localhost; dbname=cuisine; charset=utf8', 'root', '');
				$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
			$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
			$limite = 4;	
			// Partie "Requête"
			$debut = ($page - 1) * $limite;
			$query = 'SELECT SQL_CALC_FOUND_ROWS R.id_recette, R.recette, R.presentation, R.nom_img, R.alt_img,  
								R.regOrigId, O.origine, C.id_recet_com,
								COUNT(C.id_recet_com) as total_com 
						FROM recettes R
						LEFT JOIN origines O
							ON R.regOrigId = O.origine_id
						LEFT JOIN commentaires C
							ON R.id_recette = C.id_recet_com
						WHERE R.regOrigId BETWEEN 51 AND 59
						GROUP BY id_recette
						ORDER BY id_recette DESC
						LIMIT :limite OFFSET :debut';

			$query = $cnx->prepare($query);
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

			$resultFoundRows = $cnx->query('SELECT found_rows()');
			/* On doit extraire le nombre du jeu de résultat */
			$nombredElementsTotal = $resultFoundRows->fetchColumn();
			// Partie "Boucle"
			$compteur = 0;
			while ($element = $query->fetch()) {
				if ($compteur >= $limite) {
		         break;
		      }
			   echo nl2br('<div class="zone_recet_pays"><div class="zone_nom_origine_pays"><h3 class="elem_nom_recet_pays">'.htmlspecialchars($element['recette']).'</h3><p class="origine_pays">('.htmlspecialchars($element['origine']).')</p><p class="nbre_com_pays">Nbre de com. : '.htmlspecialchars($element['total_com']).'</p></div>
								<div class="zone_image_et_presenta_pays"><p class="img_recet_pays"><img src="images/'.htmlspecialchars($element['nom_img']).'" alt="'.htmlspecialchars($element['alt_img']).'" /></p><div class="presenta_et_bout_pays"><p class="text_presentation_pays">'.htmlspecialchars($element['presentation']).'</p><div class="zone_bout_det_pays"><p class="bouton_detail_pays"><a href="recette_a_la_une_detail.php?recetALaUne='.$element['id_recette'].'" class="text_bouton_detail_pays">Voir la recette.<img src="images/flecheblanchedroite.png" alt="flecheblanchedroite" /></a></p></div></div></div></div>');
			   $compteur++;
			}
			// Partie "Liens"
			$nombreDePages = ceil($nombredElementsTotal / $limite);

			?>
			<p align="center"><?php
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
			</p><?php
		?>
		<?php include ("footer.php"); ?>
	</div>
	</body>
</html>