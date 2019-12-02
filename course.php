<?php 
	session_start();

	// CHECK GET PARAMETER

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=ww02;charset=utf8', 'ww02', 'uNurDefR');
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}

	$request = "
		SELECT idcourse
		FROM course
	";

	$response = $db->query($request);

	$found = False;
	while ($data = $response->fetch())
	{
		if ($data['idcourse'] == $_GET['idcourse'])
			$found = True;
	}

	$response->closeCursor();

	if (!$found)
		die("Error in get parameter (idcourse)");
	else
		$_SESSION['idcourse'] = $_GET['idcourse'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Velore | Course</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="basicstyle.css">
	<link rel="stylesheet" type="text/css" href="course.css">
	<link rel="icon" href="image/favicon.ico">
</head>
<body>

	<?php include_once('header.php') ?>

	<section id="content">
		<section id='guide'>

		<?php

		$request = "
		SELECT *
		FROM course co
		JOIN categorie ca ON ca.idcategorie = co.idcategorie
		WHERE co.idcourse = :idcourse
		";

		$answer = $db->prepare($request);
		$answer->execute(array("idcourse" => $_GET['idcourse']));

		foreach ($answer as $row)
		{
			echo "<h2 id='course_name'>{$row['coursename']}</h2>";
			echo "<p id='course_description'>{$row['coursedescription']}</p>";
			
		}
		
		$request = "
		SELECT *
		FROM contain c
		JOIN place p ON c.idplace = p.idplace
		WHERE c.idcourse = :idcourse
		";

		$answer = $db->prepare($request);
		$answer->execute(array("idcourse" => $_SESSION['idcourse']));

		echo "<ul id='places'>";
		while ($row = $answer->fetch())
		{
			echo "<li>";
			echo "<h3>{$row['placename']}</h3>";
			echo "<p id='place_description'>{$row['placedescription']}</p>";
			echo "</li>";
		}
		echo "</ul>";
		//
		echo "</section>";

		$request="
			SELECT difficulty, length, categoriename
			FROM course co
			JOIN categorie ca on ca.idcategorie = co.idcategorie
			where co.idcourse = :idcourse";

		$answer = $db->prepare($request);
		$answer->execute(array("idcourse" => $_SESSION['idcourse']));

		while ($row = $answer->fetch()) {
			echo "<section class=\"blocs\">
			<div class=\"bloc\">
				<p id='course_difficulty'><b>Difficulty :</b> {$row['difficulty']}/5</p>
			</div>
			<div class=\"bloc\">
				<p id='course_duration'><b>Duration :</b>  {$row['length']} minutes</p>
			</div>
			<div class=\"bloc\">
				<p id='course_categorie'><b>Categorie :</b> {$row['categoriename']}</p> 
			</div>
		</section>";
		}

		$answer->closeCursor();

		?>
		
		</section>

		<section id="reviews">

			<?php

			$request = "
				SELECT a.username, c.description
				FROM comment c
				JOIN account a ON a.idaccount = c.idaccount
				WHERE c.idcourse = :idcourse
			";

			$response = $db->prepare($request);
			$response->execute(array(
				"idcourse" => $_SESSION['idcourse']
			));

			while ($data = $response->fetch())
			{
				echo "<div class='review'>";
				echo "<h3>User : " . htmlspecialchars($data['username']) . "</h3>";
				echo "<p>Review : " . htmlspecialchars($data['description']) . "</p>";
				echo "</div>";
			}

			?>

		</section>

		<section class="commentaire">
			<form method="post" action="new_comment.php">
				<p>
					<textarea rows="10" cols="100" name="text" id="text" placeholder="Leave us a comment !"></textarea>
				</p>
				<p>
					<input type="submit" name="submit" value="Submit" id="subbtn">
				</p>
			</form>
		</section>
	</section>

	<?php include_once('footer.php') ?>

</body>
</html>