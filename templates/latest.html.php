<nav>
    <ul>
        <?php
        $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
        
        // Fetch distinct category names from the database
        $stmt = $pdo->prepare('SELECT DISTINCT name FROM category ORDER BY name ASC');
        $stmt->execute();

        foreach ($stmt->fetchAll() as $category) {
            // Create a URL-friendly file name for the category
            $categoryFile = strtolower(str_replace(' ', '-', $category['name'])) . '.php';
            echo '<li><a href="' . htmlspecialchars($categoryFile) . '">' . htmlspecialchars($category['name']) . '</a></li>';
        }
        ?>
    </ul>
</nav>


            <article>
<?php
$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

$stmt = $pdo->prepare('SELECT * FROM article ORDER by date desc');
$stmt->execute();

$articles = $stmt->fetchAll();

foreach ($articles as $article) {
    echo '<hr />';
    echo '<h2>' . $article['title'] . '</h2>';
    echo '<em>' . $article['date'] . '</h2>';
    echo '<p>' . $article['description'] . '</p>';
}


?>
            </article>
