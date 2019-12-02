<?php  

	session_start();

	try
	{
		$db = new PDO('mysql:host=localhost;dbname=ww02;charset=utf8', 'ww02', 'uNurDefR');
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}

	if (isset($_POST['text']) && !empty($_POST['text']))
	{
		$request = "
			INSERT INTO comment(idcourse, idaccount, description)
			VALUES(:idcourse, :idaccount, :description)
		";

		$response = $db->prepare($request);
		$response->execute(array(
			"idcourse" => $_SESSION['idcourse'],
			"idaccount" => $_SESSION['idaccount'],
			"description" => htmlspecialchars($_POST['text'])
		));

		$response->closeCursor();
	}

	header("Location: course.php?idcourse={$_SESSION['idcourse']}");

?>