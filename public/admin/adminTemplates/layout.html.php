<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css" />
    <meta name="summary" content="Assignment 2024" />
    <title>Northampton News - Admin</title>
</head>
<body>
    <header>
        <section>
            <h1>Northampton News - Admin Panel</h1>
        </section>
    </header>
    <nav>
        <ul>
            <li><a href="/admin/">Home</a></li>
            <li><a href="/admin/latest.php">Latest Articles</a></li>
            <li><a href="#">Select Category</a>
                <ul>
                <?php
				// Updated navigation bar for admin
					$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
					$stmt = $pdo->prepare('SELECT * FROM category ORDER BY name ASC');
					$stmt->execute();

					foreach ($stmt as $category) {
    					// Get the last word of the category name
    					$words = explode(' ', $category['name']); // Split the name by spaces
    					$lastWord = strtolower(end($words)) . '.php'; // Append '.php'
    					echo '<li><a href="/admin/' . htmlspecialchars($lastWord) . '">' . htmlspecialchars($category['name']) . '</a></li>';
					}
				?>
                </ul>
            </li>
            <li><a href="/admin/contact.php">Contact Admin</a></li>
        </ul>
    </nav>
    <img src="/images/banners/randombanner.php" />
    <main>
        <?= $output; ?>
    </main>
    <footer>
        &copy; Northampton News Admin <?= date('Y'); ?>
    </footer>
</body>
</html>
