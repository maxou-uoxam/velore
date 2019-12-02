<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Velore | Guides</title>
	<link rel="stylesheet" type="text/css" href="guides.css">
	<link rel="stylesheet" type="text/css" href="basicstyle.css">
	<link rel="icon" href="image/favicon.ico">
</head>
<body>
	<?php include_once "header.php"; ?>

	<div id='guides'>
		<a href="doc/bike_city_guide.pdf" class='guideDl' download>
			<div class='guide'>
				<section class='guideImage' id="guideImg"></section>
				<section class='guideBox'>
					<h2 class='guideTitle'>Driving safely in city.</h2>
					<p class='guideDesc'>
						Sharing the road with motorized vehicles can be dangerous. But applying some basic rules can reduce the possibility of an accident. Here is a summary of the rules to follow when cycling in the city to avoid endangering yourself and others.
					</p>
				</section>
			</div>
		</a>
		<a href="doc/bike_mountain_guide.pdf" class="guideDl" download>
			<div class='guide'>
				<section class='guideImage' id="guideImg2"></section>
				<section class='guideBox'>
					<h2 class='guideTitle'>Driving safely in mountain.</h2>
					<p class='guideDesc'>
						Sharing the road with motorized vehicles can be dangerous. But applying some basic rules can reduce the possibility of an accident. Here is a summary of the rules to follow when cycling in the mountain to avoid endangering yourself and others.
					</p>
				</section>
			</div>
		</a>
	</div>

	<a href="/doc/bike_city_guide.pdf">guide city</a>
	<?php include_once "footer.php"; ?>
</body>
</html>