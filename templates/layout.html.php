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
                <li><a href="/">Login</a></li>
                <li><a href="latest.php">Latest Articles</a></li>
                <li><a href="advertise.php">Advertise with us</a></li>
                <li><a href="#">Select Category</a>
                    <ul>
                        <?php
                        // Establish a database connection
                        $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
                        
                        // Fetch all categories sorted by name
                        $stmt = $pdo->prepare('SELECT DISTINCT name FROM category ORDER BY name ASC');
                        $stmt->execute();

                        // Loop through the categories to create menu items
                        foreach ($stmt as $category) {
                            $categoryFile = 'category.php?name=' . urlencode($category['name']); // Generate the link dynamically
                            echo '<li><a href="' . htmlspecialchars($categoryFile) . '">' . htmlspecialchars($category['name']) . '</a></li>';
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
