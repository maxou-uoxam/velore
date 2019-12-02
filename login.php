<?php
session_start();
if (isset($_SESSION['username']) && !empty($_SESSION['username']))
	header('Location: selection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Velore | Login</title>
	<link rel="stylesheet" type="text/css" href="register.css">
	<link rel="stylesheet" type="text/css" href="basicstyle.css">
	<link rel="icon" href="image/favicon.ico">
</head>
<body id='login'>
	<?php include_once 'header.php' ?>
	<section id="content">
		<form action="login.php" method="post">
				<p>
					<input type="text" name="user" id='user' value='<?php if(!empty($_POST) && !empty($_POST['user'])) echo $_POST['user'] ?>' placeholder='Username'>
				</p>
				<p>
					<input type="password" name="pwd" id='pwd' placeholder="Password">
				</p>
				<input type="submit" name="submit" id='submit' value='Login'>
		</form>
	</section>
	<?php include_once 'footer.php' ?>
</body>
</html>

<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=ww02;charset=utf8', 'ww02', 'uNurDefR');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
	die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT username, password, idaccount FROM account');

$found = False;

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
	if($donnees['username'] == $_POST['user'] && password_verify($_POST['pwd'], $donnees['password']))
	{
		$found = True;
		$_SESSION['username'] = $_POST['user'];
		$_SESSION['idaccount'] = $donnees['idaccount'];
		break;
	}
}

$reponse->closeCursor(); // Termine le traitement de la requête

if ($found)
	header("Location: selection.php");

?>