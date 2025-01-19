<?php
$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

if (isset($_GET['name'])) {
    $categoryName = $_GET['name'];

   
    $stmt = $pdo->prepare('
        SELECT a.id, a.title, a.image
        FROM article a
        JOIN category c ON a.categoryId = c.id
        WHERE c.name = :categoryName
        ORDER BY a.date DESC
    ');
    $stmt->execute(['categoryName' => $categoryName]);

    $articles = $stmt->fetchAll();

    echo '<h1>Articles in ' . htmlspecialchars($categoryName) . '</h1>';
    echo '<ul>';
    foreach ($articles as $article) {
        echo '<li>';
        
        if ($article['image']) {
            echo '<img src="' . htmlspecialchars($article['image']) . '" alt="Image for ' . htmlspecialchars($article['title']) . '" width="100" />';
        }
        echo '<a href="article.php?id=' . $article['id'] . '">' . htmlspecialchars($article['title']) . '</a>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No category selected.</p>';
}
?>
