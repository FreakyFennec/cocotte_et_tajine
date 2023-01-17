<!--<section id="section_titre_sug">
                <div id="titre_suggestion">
                    <h2>D'autres recettes peut-être ?</h2> 
                </div>
            </section>-->
            <section id="section_suggestion">
<?php
    include ("connexion.php");
    // Récupération des champs
    
    $reponse = $bdd->query('SELECT R.id_recette, R.recette, R.presentation, 
                            R.nom_img_min, R.nom_img, R.alt_img    
                            FROM recettes R
                            WHERE R.id_recette =  id_recette
                            GROUP BY R.id_recette
                            ORDER BY RAND() 
                            LIMIT 9');
    // Affichage des champs (toutes les données sont protégées par htmlspecialchars)
    
    while ($donnees = $reponse->fetch())
    {
        echo nl2br('<div class="zone_recet_sug"><a href="recette_a_la_une_detail.php?recetALaUne='.$donnees['id_recette'].'" class="text_bout_det_sug"><p class="img_recet_sug"><img src="images/'.htmlspecialchars($donnees['nom_img_min']).'" alt="'.htmlspecialchars($donnees['alt_img']).'" /></p></a><div class="zone_nom_recet_sug"><h4 class="elem_nom_recet_sug">'.htmlspecialchars($donnees['recette']).'</h4></div></div>');
    }
    $reponse->closeCursor();
?>
</section>
