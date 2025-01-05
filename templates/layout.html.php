<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/styles.css"/>
        <meta name="summary" content="Assignment 2024" />
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="latest.php">Latest Articles</a></li>
				<li><a href="advertise.php">Advertise with us</a></li>
				<li><a href="#">Select Category</a>
				<ul>
				<?php
				// Updated navigation bar remember to clean
					$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
					$stmt = $pdo->prepare('SELECT * FROM category ORDER BY name ASC');
					$stmt->execute();

					foreach ($stmt as $category) {
    					// Get the last word of the category name (1/2)
    					$words = explode(' ', $category['name']); // Split the name by spaces
    					$lastWord = strtolower(end($words)) . '.php'; // 
    					echo '<li><a href="' . htmlspecialchars($lastWord) . '">' . htmlspecialchars($category['name']) . '</a></li>';
					}
				?>


                </ul>
				</li>
				<li><a href="contact.php">Contact us</a></li>
			</ul>
		</nav>
		<img src="/images/banners/randombanner.php" />
		<main>
			<?=$output;?>
        </main>

		<footer>
			&copy; Northampton News <?=date('Y');?>
		</footer>
	</body>
</html>
