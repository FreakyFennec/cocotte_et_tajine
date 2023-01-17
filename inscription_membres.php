<?php include ("connexion.php"); 
if (isset($_POST['form_inscrip'])) 
{	
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);

	if (!empty($_POST['pseudo']) 
		AND !empty($_POST['mail']) 
		AND !empty($_POST['mail2']) 
		AND !empty($_POST['mdp']) 
		AND !empty($_POST['mdp2']))
	{			
		$pseudolength = strlen($pseudo);
		if ($pseudolength <= 255) 
		{
			if ($mail == $mail2) 
			{
				if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
				{
					$req_mail = $bdd->prepare('SELECT * FROM membres WHERE mail = ?');
					$req_mail->execute(array($mail));
					$mail_existe = $req_mail->rowCount();
					if ($mail_existe == 0) 
					{
						if ($mdp == $mdp2) 
						{
							$insert_membre = $bdd->prepare('INSERT INTO membres(pseudo, mail, mdp) VALUES(?, ?, ?)');
							$insert_membre->execute(array($pseudo, $mail, $mdp));
							$erreur = "Votre compte vient d'être crée.";
						}
						else
						{
							$erreur = "Vos mdp ne sont pas identiques !";
						}
					}
					else
					{
						$erreur = "Adresses mail déjà prise !";
					}
				}
				else
				{
					$erreur = "Votre adresses mail n'est pas valide !";
				}
			}
			else
			{
				$erreur = "Vos adresses mail ne sont pas identiques !";
			}
		}
		else
		{
			$erreur = "Votre pseudo ne doit pas excéder 255 caractères.";
		}
	}
	else 
	{
		$erreur = "Tous les champs doivent être renseignés !";
	}
}
?>

		<?php include ("debut_page.php"); ?>
		<div>
			<h3 class="titre_page_inscr">Inscription.</h3>
			<form method="POST" action="inscription_membres.php" class="zone_form_inscr">
				<table class="nom_des_champ_ins">
					<tr>
						<td class="nom_des_champ_ins">
							<label for="pseudo">Pseudo :</label>
						</td>
						<td>
							<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo($pseudo);} ?>">
						</td> 
					</tr>
					<tr>
						<td class="nom_des_champ_ins">
							<label for="mail">Mail :</label>
						</td>
						<td>
							<input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) {echo($mail);} ?>">
						</td>
					</tr>
					<tr>
						<td class="nom_des_champ_ins">
							<label for="mail2">Confirmation du mail :</label>
						</td>
						<td>
							<input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) {echo($mail2);} ?>">
						</td>
					</tr>
					<tr>
						<td class="nom_des_champ_ins">
							<label for="mdp">Mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="Votre mdp" id="mdp" name="mdp">
						</td>
					</tr>
					<tr>
						<td class="nom_des_champ_ins">
							<label for="mdp2">Confirmez votre mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2">
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<br />
							<input type="submit" name="form_inscrip" value="Envoyer">
						</td>
					</tr>
				</table>				
			</form>
			<?php
				if (isset($erreur)) {
					echo '<font color="red">' . "$erreur" . '</font>';
				}
			?>
		</div>
		<?php include ("fin_page.php"); ?>