<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Velore | Homepage</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="basicstyle.css">
	<link rel="icon" href="image/favicon.ico">
</head>
<body>
	<?php include_once "header.php"; ?>

	<div class='even' id='homepage1'>
		<section id='blochomepage1'>
			<h2>Explore Annecy</h2>
			<p>Marvel at the clear sparkling waters of Europe’s purest lake and savour the breath-taking
mountainous scenery as you cycle around the South-eastern French town of Annecy. Use our
set courses to guide you around these panoramic landscapes and historic monuments that are
not to be missed!</p>
			<form action='selection.php' method='post'>
				<input type="submit" name="book" id='book' value='Book a trip'>
			</form>
		</section>
	</div>
	<div class='odd' id='homepage2'>
		<h2>Our concept</h2>
		<p><span class='redcircle'></span><span class='line'></span><span class='redcircle'></span><span class='line'></span><span class='redcircle'></span><span class='line'></span><span class='redcircle'></span></p>
		<article id='undercircle1'>Sign up</article>
		<article id='undercircle2'>Select a trip</article>
		<article id='undercircle3'>Have fun</article>
		<article id='undercircle4'>Review the trip</article>
	</div>
	<div class='even' id='homepage3'>
		<section id='rightblochomepage3'>
			<h2>The best trips in Annecy</h2>
			<p>Annecy is enriched with beautiful scenery from the crisp clear waters of Lac dAnnecy to the
quaint cobbled streets of la vieille ville (the old town) bridging over their famous canals.
Boasting many historic architectures like Château d’Annecy and Palais de l'Ile your guided cycle
around Annecy is bound to be the most beautiful bike ride you ever take.</p>
			<form action='selection.php' method='post'>
				<input type="submit" name="explore" id='explore' value='Explore'>
			</form>
		</section>
	</div>
	<div class='odd' id='homepage4'>
		<p>The best trips in Annecy</p>
		<div id='hp4bloc'>
			<section id=hp41></section>
			<section id=hp42></section>
			<section id=hp43></section>
			<section id=hp44></section>
			<section id=hp45></section>
			<section id=hp46></section>
		</div>
	</div>
	<div class='even' id='homepage5'>
		<section id='hp5bloc'>
			<h2>Take a break</h2>
			<p>All of our guides include our top recommendations for the finest local bars and restaurants
			Annecy has to offer. So why not take the chance to recharge with local delicacies like tartiflette
			and diots whilst absorbing the charming culture of this wondrous alpine town.</p>
			<!-- <form action='' method='post'>
				<input type="submit" name="explorebike" id='explorebike' value='Explore'>
			</form> -->
		</section>
	</div>
	<div class='odd' id='homepage6'>
		<section id='hp6image'></section>
		<section id='hp6bloc'>
			<h2>Download the App</h2>
			<p>Download our app from the app store to avail of our guides on the go. A quick and easy way to
access all the information you will need for your beautiful Annecy bike ride.</p>
			<p>Soon...</p>
			<!-- <form action='' method='post'>
				<input type="submit" name="android" id='android' value='Android'>
				<input type="submit" name="iOS" id='iOS' value='iOS'>
			</form> -->
		</section>
	</div>

	<?php include_once "footer.php" ?>
</body>
</html>