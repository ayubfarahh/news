<nav>
				<ul>
					<li><a href="news.php">Local News</a></li>
					<li><a href="events.php">Local Events</a></li>
					<li><a href="sport.php">Sport</a></li>
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
