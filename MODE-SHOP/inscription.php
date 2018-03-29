
<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=tchatmembre','root',''); //connexion a la base de donnée
	if(isset($_POST['forminscription']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']); // pour enlevé les caracteres html
			$mail = htmlspecialchars($_POST['mail']);// pour enlevé les caracteres html
			$mail2 = htmlspecialchars($_POST['mail2']);// pour enlevé les caracteres html
			$mdp = sha1($_POST['mdp']); //pour haché le mot de passe avec un systeme de securité sha1 vu que celui de md5 est deja penetrable avec des dictionaire 
			$mdp2 = sha1($_POST['mdp2']);//pour haché le mot de passe avec un systeme de securité sha1 vu que celui de md5 est deja penetrable avec des dictionaire 

		if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
		 {
			

			// verification de la taille des element du pseudo
			$pseudolength = strlen($pseudo); // recoit la taille des caracteres de pseudo
			if ($pseudolength <= 255) 
			{
				   if ($mail == $mail2) // verification de l'egalité des deux adresse mail
				   		{ 
				   			if (filter_var($mail,FILTER_VALIDATE_EMAIL))// FONCTION POUR VERIFIER SI C'EST BIEN UN EMEIL Q'ON A ENTRER vu qu'in peu ne pas entre un ,ail et le contourné
				   			 {
				   			
				   			
				   			if ($mdp == $mdp2) //verification de l'egalité des deux mots de passe
				   			{
				   				// fonction qui insert un membre a la base de donnée
				   				$insertmembre = $bdd -> prepare("INSERT INTO membre(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
				   				// fonction pour executé l'insertion dans la base de donnée pour les informations
				   				$insertmembre -> execute(array($pseudo, $mail, $mdp));
				   				$erreur2 = "votre compte a bien été crée !";
				   				$_SESSION['comptecree']= "votre compte a bien été crée !";
				   				// fonction de redirection vers une autre page
				   				header('Location: index.php');
				   			}else
							{
								$erreur = "vos mots de passe ne corespondent pas !";
							}
						}else
						{
							$erreur = " votre adresse mail n'est pas valide !";
						}
										
						}else
							{
								$erreur = "vos adresse mail ne corespondent pas !";
							}

			}else{
				$erreur = "votre pseudo ne doit pas depasser 255 caracteres !";
			}

		}else{

			$erreur = "tous les champs doivent êtres complétés !";
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>inscription</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/inscription.css">
</head>
<body>
		<div id="tete">
		<p id="entreprise" class="">Mode-Shop</p>

	</div>
	<div align="center">
		<h1 class="titre">Inscription</h1>
		<br><br><br>
		<form method="POST" action="">
			<table>
				<tr>
					<td align="right">
						<label for="pseudo">Pseudo :</label>
					</td>
					<td>
						<input type="text" placeholder="votre pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo;}?>"> <!-- on met pseudo et non post pseudo parce que $pseudo est la variable securise de pseudo -->
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mail2">mail :</label>
					</td>
					<td>
						<input type="email" placeholder="votre mail" name="mail" id="mail" value="<?php if(isset($mail)){ echo $mail;}?>"> <!-- pour concervé les element saisi en cas d'erreur pour que c'est valeur ne soit pas desactivé -->
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mail2">confirmez votre mail :</label>
					</td>
					<td>
						<input type="email" placeholder="confirmez votre adresse mail" name="mail2" id="mail2" value="<?php if(isset($mail2)){ echo $mail2;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mdp">Mot de passe :</label>
					</td>
					<td>
						<input type="password" placeholder="votre mot de passe" name="mdp" id="mdp">
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="mdp2">confirmez votre mot de passe :</label>
					</td>
					<td>
						<input type="password" placeholder="confirmez votre mdp" name="mdp2" id="mdp2">
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="center"><input type="submit" value="inscription" name="forminscription"></td>
				</tr>
			</table>

		</form><br>
		<?php 

			if (isset($erreur)) {
				echo '<font color="red">'.$erreur."</font>"; //mêtre la couleur de l'erreur en rouge
			}
			if (isset($erreur2)) {
				echo '<font color="green">'.$erreur2."</font>"; //mêtre la couleur de l'erreur en rouge
			}

		 ?>
	</div>

</body>
</html>