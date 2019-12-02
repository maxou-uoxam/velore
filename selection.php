<?php 

session_start();
if (!(isset($_SESSION['username']) && !empty($_SESSION['username'])))
	header('Location: login.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Velore | Select a trip</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="basicstyle.css">
	<link rel="stylesheet" type="text/css" href="courses.css">
	<link rel="icon" href="image/favicon.ico">
	<style type="text/css">

		a div {
			color: black;
			text-decoration: none;
		}

	</style>
</head>
<body>

	<?php  
		include_once('header.php'); // include header to the page
	?>

	<div class="guide">
		<section>
			<?php

			try
			{
				// connection to the database
				$bdd = new PDO('mysql:host=localhost;dbname=ww02;charset=utf8', 'ww02', 'uNurDefR');
			}
			catch(Exception $e) // if connection fail
			{
				// stop the script (send an error to the server)
			    die('Erreur : '.$e->getMessage());
			}

			// SQL Server
			$request = "
			SELECT idcourse, coursename, difficulty, length, categoriename
			FROM course c
			JOIN categorie cat on c.idcategorie=cat.idcategorie
			";

			// send the request
			$reponse = $bdd->query($request);

			while ($donnees = $reponse->fetch()) // for each line returned by the database
			{
				// create a container with information on the course
				echo "
					<a href='course.php?idcourse={$donnees['idcourse']}'>
						<div>
							<h1>{$donnees['coursename']}</h1>
							<p><b>Difficulty:</b> {$donnees['difficulty']}/5</p>
							<p><b>Length: </b> {$donnees['length']} min</p>
							<p><b>Categorie: </b> {$donnees['categoriename']}</p>
						</div>
					</a>
				";
			}

			?>
		</section>
	</div>

	<?php  
		include_once('footer.php'); // include footer to the page
	?>

</body>
</html>