
		<?php include ("debut_page.php"); ?>

		<div>
			<h3 class="titre_page_form_bdd_recet">Formulaire bdd recettes.</h3>
			<form method="post" action="recettes_post.php" class="zone_form_bdd_recet">
				<table class="zone_tab_du_champ">
					<tr>
						<td class="nom_du_champ">
							<label for="plat">Type de plat :</label>
						</td>
						<td>
							<SELECT name="plat" id="plat">
								<option VALUE="0">Non défini</option>
								<option VALUE="1">Poisson</option>
								<option VALUE="2">Salade</option>
								<option VALUE="3">Légumes</option>
								<option VALUE="4">Viande</option>
								<option VALUE="5">Dessert</option>
								<option VALUE="6">Tapas</option>
								<option VALUE="7">Chutney</option>
								<option VALUE="8">Raïta</option>
							</SELECT><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="recette">Nom de la recette :</label>
						</td>
						<td>
							<input type="text" name="recette" id="recette" /><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="mots_cles">Mots clés :</label>
						</td>
						<td>
							<input type="text" name="mots_cles" id="mots_cles" /><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="regOrigId">Région :</label>
						</td>	
						<td>
							<SELECT name="regOrigId" id="regOrigId">
								<option VALUE="0">Non défini</option>
								<option VALUE="1">Espagne</option>
								<option VALUE="2">France</option>
								<option VALUE="21">Alsace</option>
								<option VALUE="3">Indes</option>
								<option VALUE="4">Maroc</option>
								<option VALUE="5">Asie</option>
								<option VALUE="6">Italie</option>
							</SELECT><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="origine_id">Origine :</label>
						</td>	
						<td>
							<SELECT name="origine_id" id="origine_id">
								<option VALUE="0">Non défini</option>
								<option VALUE="1">Espagne</option>
								<option VALUE="2">France</option>
								<option VALUE="21">Alsace</option>
								<option VALUE="3">Indes</option>
								<option VALUE="4">Maroc</option>
								<option VALUE="51">Japon</option>
								<option VALUE="52">Viêt-Nam</option>
								<option VALUE="53">Thaïlande</option>
								<option VALUE="54">Chine</option>
								<option VALUE="6">Italie</option>
							</SELECT><br />
						</td>
					</tr>

					<tr>
						<td class="nom_du_champ">
							<label for="nom_img_grd">Nom grande image :</label>
						</td>	
						<td>
							<input type="text" name="nom_img_grd" id="nom_img_grd"/><br />
						</td>
					<tr>
						<td class="nom_du_champ">
							<label for="nom_img">Nom image moyenne :</label>
						</td>	
						<td>
							<input type="text" name="nom_img" id="nom_img"/><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="nom_img_min">Nom image mini :</label>
						</td>	
						<td>
							<input type="text" name="nom_img_min" id="nom_img_min"/><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="alt_img">Texte alt image :</label>
						</td>	
						<td>
							<input type="text" name="alt_img" id="alt_img"/><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="presentation_form">Présentation :</label>
						</td>
						<td>
							<textarea name="presentation" id="presentation_form"></textarea><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="nbr_pers">Nbr pers :</label>
						</td>	
						<td>
							<input type="text" name="nbr_pers" id="nbr_pers"/><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="difficulte">Difficulté :</label>
						</td>	
						<td>
							<SELECT name="difficulte" id="difficulte">
								<option VALUE="facile">facile</option>
								<option VALUE="difficile">difficile</option>
								<option VALUE="très difficile">très difficile</option>
							</SELECT><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="les_ingrediens">Ingrédients :</label>
						</td>
						<td>
							<textarea name="les_ingrediens" id="les_ingrediens"></textarea><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="epices">Epices :</label>
						</td>
						<td>
							<textarea name="epices" id="epices"></textarea><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="tps_prep">Temps de préparation :</label>
						</td>	
						<td>
							<input type="text" name="tps_prep" id="tps_prep" value="00:00:00"/><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="tps_cuis">Temps de cuisson :</label>
						</td>	
						<td>
							<input type="text" name="tps_cuis" id="tps_cuis" value="00:00:00"/><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="preparation">Préparation :</label>
						</td>	
						<td>
							<textarea name="preparation" id="preparation"></textarea><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="cuisson">Cuisson :</label>
						</td>	
						<td>
							<textarea name="cuisson" id="cuisson"></textarea><br />
						</td>
					</tr>
					<tr>
						<td class="nom_du_champ">
							<label for="suggestion">Suggestion :</label>
						</td>	
						<td>
							<textarea name="suggestion" id="suggestion"></textarea><br />
						</td>
					</tr>
					<tr>
						<td>
							<label for="envoyer"></label>
						</td>
						<td>
							<input type="submit" value="Envoyer" id="envoyer"/>
						</td>
					</tr>
				</table>
			</form>
		</div>

		<?php include ("fin_page.php"); ?>
	