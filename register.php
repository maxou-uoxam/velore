<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Velore | Register Form</title>
	<link rel="stylesheet" type="text/css" href="register.css">
	<link rel="stylesheet" type="text/css" href="basicstyle.css">
	<link rel="icon" href="image/favicon.ico">
</head>
<body>
	<?php include_once 'header.php' ?>
	<section id="content">
		<form action='register.php' method='post'>
			<?php
			if(isset($usernameIsTaken))
				echo "<p class='error'>The username is already taken.</p>";
			?>
			<p>
				<input type="text" name="user" id='user' value='<?php if(!empty($_POST['user'])) echo $_POST['user'] ?>' placeholder="Username">
				<?php 
				if(!empty($_POST) && !empty($_POST['user']) && !preg_match("/^[[:alnum:]]+$/", $_POST['user']))
				{
					echo "<p class='error'>The username must contain 1 or more caracters (only alphabet and numbers caracters are authorized).</p>";
				}
				?>
			</p>
			<p>
				<input type='password' name='pwd' id='pwd' placeholder="Password">
				<?php
				if(!empty($_POST) && !empty($_POST['pwd']) && !preg_match("/^[[:alnum:]|[:punct:]]{4,}$/", $_POST['pwd']))
				{
					echo "<p class='error'>Password must contain 4 or more caracters (alphanumeric and punctuation caracters).</p>";
				}
				?>
			</p>
			<p>
				<input type='password' name='pwdbis' id='pwdbis' placeholder="Confirm Password">
				<?php
				if(!empty($_POST) && !empty($_POST['pwdbis']) && !preg_match("/^[[:alnum:]|[:punct:]]{4,}$/", $_POST['pwdbis']))
				{
					echo "<p class='error'>Confirm password must contain 4 or more caracters (alphanumeric and punctuation caracters).</p>";
				}
				?>
			</p>
			<?php 
			if(!empty($_POST) && !empty($_POST['pwd']) && !empty($_POST['pwdbis']))
			{
				if($_POST['pwd'] !== $_POST['pwdbis'])
				{
					echo "<p class='error'>'Confirm password' is not equal to 'password'</p>";
				}
			}
			?>
			<p>
				<input type='email' name='mail' id='mail' value='<?php if(!empty($_POST['mail'])) echo $_POST['mail'] ?>' placeholder="Email">
				<?php 
				if(!empty($_POST) && !empty($_POST['mail']) && !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
				{
					echo "<p class='error'>The email is incorrect.</p>";
				}
				?>
			</p>
			<p id="validate">
				<input type="submit" name="submit" id='submit' value='Register'>
			</p>
		</form>
	</section>

	<?php include_once 'footer.php' ?>
	
</body>
</html>

<?php
	if(!empty($_POST) && !empty($_POST['user']) && preg_match("/^[[:alnum:]]+$/", $_POST['user']) && !empty($_POST['pwd']) && preg_match("/^[[:alnum:]|[:punct:]]{4,}$/", $_POST['pwd']) && !empty($_POST['pwdbis']) && preg_match("/^[[:alnum:]|[:punct:]]{4,}$/", $_POST['pwdbis']) && !empty($_POST['pwd']) && !empty($_POST['pwdbis']) && !empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=ww02;charset=utf8', 'ww02', 'uNurDefR');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}

		$reponse = $bdd->query('SELECT username, email FROM account');
		$usernameIsTaken = False;

		while($donnees = $reponse->fetch())
		{
			if($_POST['user'] === $donnees['username'])
			{
				$usernameIsTaken = True;
				die("The username {$donnees['username']} is already taken.");
			}

			if($_POST['mail'] === $donnees['email'])
			{
				die("Email {$donnees['email']} is already taken.");
			}
		}


		$reponse->closeCursor();

		$password = password_hash($_POST['pwd'], PASSWORD_BCRYPT);

		$request = "
			INSERT INTO account(username, password, email) 
			VALUES(:user, :passwd, :mail)
		";

		$response = $bdd->prepare($request);

		$response->execute(array(
			"user" => htmlspecialchars("{$_POST['user']}"),
			"passwd" => "$password",
			"mail" => "{$_POST['mail']}"
		));

		$response->closeCursor();

		$_SESSION['username'] = $_POST['user'];

		// Getting the id of the new account

		$request = "
			SELECT a.idaccount
			FROM account a
			WHERE a.username = :username
		";

		$response = $bdd->prepare($request);
		$response->execute(array(
			"username" => htmlspecialchars($_POST['user'])
		));

		$data = $response->fetch();
		$_SESSION['idaccount'] = $data['idaccount'];

		$response->closeCursor();

		header('Location: selection.php');
	}
?>