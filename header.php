<header>
	<h1><a href="index.php">Velore</a></h1>
	<nav>
		<ul>
			<li><a href="selection.php">Courses</a></li>
			<li><a href="heightCalculator.php">Services</a></li>
			<li><a href="FAQ.php">FAQ</a></li>
			<li><a href="guides.php">Guides</a></li>
			<?php

			if (!isset($_SESSION['username']) || empty($_SESSION['username']))
			{
				echo "
				<li><a href='register.php'>Register</a></li>
				<li><a href='login.php'>Login</a></li>";
			}
			else
			{
				echo "<li><a href='disconnect.php'>Disconnect</a></li>";
			}

			?>
		</ul>
	</nav>
</header>