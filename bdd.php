<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Test Database</title>
</head>
<body>

	<?php

	echo "<h1>TEST DATABASE</h1>";

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=ww02;charset=utf8', 'ww02', 'uNurDefR');
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}

	$request = "
	SELECT c2.coursename, p.placename, p.placedescription
	FROM contain c
	JOIN place p ON c.idplace = p.idplace
	JOIN course c2 ON c2.idcourse = c.idcourse
	JOIN categorie c3 ON c2.idcategorie = c3.idcategorie
	WHERE c3.categoriename = 'Lake'
	";

	$reponse = $bdd->query($request);
	$tab = array();

	while ($donnees = $reponse->fetch())
	{
		if (!array_key_exists($donnees['coursename'], $tab))
		{
			$tab[$donnees['coursename']] = array();
		}

		$values = array();
		$values["placename"] = $donnees["placename"];
		$values["placedescription"] = $donnees["placedescription"];

		$tab[$donnees['coursename']][] = $values;

		//echo "Course {$donnees['idcourse']} : " . $donnees["idplace"] . " - " . $donnees['placename'] . " : " . $donnees['placedescription'] . '<br />';
	}

	echo "<pre>";
	print_r($tab);
	echo "</pre>";

	?>

</body>
</html>