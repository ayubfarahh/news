<?php


// Create a PDO instance to connect to the database
$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

// Check if the article ID is passed through the URL
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Fetch the article based on the provided ID
    $stmt = $pdo->prepare('SELECT id, title, description, date, image FROM article WHERE id = :id');
    $stmt->execute(['id' => $articleId]);
    $article = $stmt->fetch();

    // Check if the article was found
    if ($article) {
        // Display the article's title
        echo '<h1>' . htmlspecialchars($article['title']) . '</h1>';
        
        
        echo '<p><em>Published on ' . htmlspecialchars($article['date']) . '</em></p>';

        echo '<p>' . htmlspecialchars($article['description']) . '</p>';

        
        if (isset($_SESSION['userId'])) {
            // Handle comment submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                $comment = htmlspecialchars($_POST['comment']);

                if (!empty($comment)) {
                    $stmt = $pdo->prepare('
                        INSERT INTO comments (article_id, user_id, comment, date) 
                        VALUES (:article_id, :user_id, :comment, :date)
                    ');
                    $stmt->execute([
                        'article_id' => $articleId,
                        'user_id' => $_SESSION['userId'], // Use the logged-in user's ID
                        'comment' => $comment,
                        'date' => (new DateTime())->format('Y-m-d H:i:s'),
                    ]);
                    echo '<p>Comment submitted successfully!</p>';
                } else {
                    echo '<p>Please write a comment before submitting.</p>';
                }
            }

            // comment submision form here 
            echo '<h2>Leave a Comment</h2>';
            echo '
                <form action="" method="POST">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" required></textarea>
                    <input type="submit" name="submit" value="Post Comment" />
                </form>
            ';
        } else {
            echo '<p>Please <a href="login.php">log in</a> to leave a comment.</p>';
        }

        // show the comments
        echo '<h2>Comments</h2>';
        $stmt = $pdo->prepare('
            SELECT c.comment, c.date, u.username 
            FROM comments c 
            INNER JOIN users u ON c.user_id = u.id 
            WHERE c.article_id = :article_id 
            ORDER BY c.date DESC
        ');
        $stmt->execute(['article_id' => $articleId]);
        $comments = $stmt->fetchAll();

        if ($comments) {
            foreach ($comments as $comment) {
                echo '<div class="comment">';
                echo '<p><strong>' . htmlspecialchars($comment['username']) . '</strong> (' . htmlspecialchars($comment['date']) . '):</p>';
                echo '<p>' . htmlspecialchars($comment['comment']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No comments yet. Be the first to comment!</p>';
        }
    } else {
        
        echo '<p>Article not found.</p>';
    }
} else {
    echo '<p>No article selected.</p>';
}
?>
