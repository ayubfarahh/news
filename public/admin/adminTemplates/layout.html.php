<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css" />
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
            <li><a href="#">Select Category</a>
                <ul>
                    <?php
                    // Dynamically load categories into the navigation bar
                    $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
                    $stmt = $pdo->prepare('SELECT * FROM category ORDER BY name ASC');
                    $stmt->execute();
                    foreach ($stmt as $category) {
                        echo '<li><a href="category.php?id=' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</a></li>';
                    }
                    ?>
                </ul>
            </li>
            <li><a href="contact.php">Contact us</a></li>
        </ul>
    </nav>
    <img src="/images/banners/randombanner.php" />
    <main>
        <?= $output; ?>
    </main>
    <footer>
        &copy; Northampton News <?= date('Y'); ?>
    </footer>
</body>
</html>
