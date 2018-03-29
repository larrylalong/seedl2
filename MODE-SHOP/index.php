
<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=tchatmembre','root',''); //connexion a la base de donnée
	if (isset($_POST['formconnexion'])) 
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mdpconnect = sha1($_POST['mdpconnect']);
		if (!empty($pseudo) AND !empty($mdpconnect)) 
		{
			$requser = $bdd -> prepare("SELECT * FROM membre WHERE pseudo = ? AND  motdepasse = ?");
			$requser -> execute(array($pseudo, $mdpconnect));
			 $userexist = $requser -> rowCount();
			var_dump($userexist);
			if ($userexist == 1	)
			 {
				// header('Location: tchathome.php');
			}
			else
			{
				$erreur = "mauvais pseudo ou mot de passe";
			}
		}
		else
		{
			$erreur = "tous les champs doivent êtres complétés";
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>connexion</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/connexion.css">
</head>
<body>
	
	<div align="center" class="">
		<div id="tete">
		<p id="entreprise" class="">Mode-Shop</p>

	</div>

		<dir  id="contener">
		<h1 id="headerconnect">connexion</h1>
		<form method="POST" action="">
			<table>

					<tr>
						<td align="right">
							<label for="pseudo">pseudo :</label>
						</td>
						<td>
							<input type="text" placeholder="pseudo" name="pseudo" id="pseudo">
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="password">mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="mot de passe" name="mdpconnect" id="password">
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="center">
							<input type="submit" name="formconnexion" value="se connecter">
						</td>
					</tr>
				</table>
				<a href="inscription.php" id="lieninscription">pas de compte clique ici</a>
		</form>
		</dir><br>
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