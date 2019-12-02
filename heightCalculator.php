<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Velore | Height Calculator</title>
	<link rel="stylesheet" type="text/css" href="basicstyle.css">
	<link rel="stylesheet" type="text/css" href="heightCalculator.css">
	<link rel="icon" href="image/favicon.ico">
</head>
<body>
	<?php include_once "header.php" // add header to the page ?>
	<form method="post" action="heightCalculator.php">
			<legend>Information</legend>
			<p>
				<label for="age">Adult</label>
				<input type="radio" name="age" value="1" id="adult">
				<label for="age">Child</label>
				<input type="radio" name="age" value="0" id="child">
				<?php
					if (!empty($_POST) && !isset($_POST['age'])) { // if the field has not been filled
						echo "<p class='error'>you have to choose between adult and child</p>";
					}
				?>
			</p>
			<p>
				<label for="height">Your crotch size?</label>
				<input type="number" name="height" id="height">
				<?php
					if (!empty($_POST) && (empty($_POST['height']) || $_POST['height'] <= 0)) { // if the field has not been filled
						echo "<p class='error'>you have to enter a valid value</p>";
					}
				?>
			</p>
			<p>
				What type of bike ? <label for="type">Mountain bike</label>
				<input type="radio" name="type" value="1" id="type">
				<label for="type">Road bike</label>
				<input type="radio" name="type" value="0" id="type">
				<?php
					if (!empty($_POST) && !isset($_POST['type'])) { // if the field has not been filled
						echo "<p class='error'>you have to choose between Mountain bike and Road bike</p>";
					}
				?>
			</p>
			<p>
				<input type="submit" name="submit" id="submit" value="Calculate">
			</p>
	</form>
	<?php
		if(isset($_POST['age']) && isset($_POST['height']) && isset($_POST['type']) && $_POST['height'] > 0) // if fields are filled correctly
		{
			if ($_POST['age']==1) { // if user is adult
				if ($_POST['type']==1) { // if the user choose "mountain bike"
					$hgtBike=$_POST['height']*0.23*2.54; // calculate height of the bike
				}
				else 
				{
					$hgtBike=$_POST['height']*0.65; // calculate height of the bike
				}
				$hgtBike=round($hgtBike, 1);
				echo "<p class='answer'>Your bike size is : $hgtBike cm</p>";

			}
			else
			{
				echo "<p class='answer'>Please refer to tables giving the size of children's bicycles on internet</p>";
			}
		}
	?>
	<?php include_once "footer.php" // add footer to the page ?>
</body>
</html>