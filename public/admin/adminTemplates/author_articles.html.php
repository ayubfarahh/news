<?php
$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

// author id from the urrl
$authorId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($authorId) {
    
    $stmt = $pdo->prepare('
        SELECT article.*, staff.username AS author_name 
        FROM article 
        JOIN staff ON article.authorId = staff.id
        WHERE article.authorId = :authorId
        ORDER BY article.date DESC
    ');
    $stmt->execute(['authorId' => $authorId]);
    $articles = $stmt->fetchAll();

    if ($articles) {
        echo '<h2>Articles by ' . htmlspecialchars($articles[0]['author_name']) . '</h2>';
        echo '<table>';
        foreach ($articles as $article) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($article['title']) . '</td>';
            echo '<td>' . htmlspecialchars($article['date']) . '</td>';
            echo '<td>' . htmlspecialchars($article['description']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No articles found for this author.</p>';
    }
} else {
    echo '<p>Invalid author ID.</p>';
}
?>
