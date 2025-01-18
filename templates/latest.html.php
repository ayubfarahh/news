<nav>
    <ul>
        <?php
        $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
        
        $stmt = $pdo->prepare('SELECT DISTINCT name FROM category ORDER BY name ASC');
        $stmt->execute();

        foreach ($stmt->fetchAll() as $category) {
            $categoryFile = 'category.php?name=' . urlencode($category['name']);
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
    echo '<em>' . $article['authorId'] . '</h2>';
    echo '<p>' . $article['description'] . '</p>';
}


?>
            </article>
