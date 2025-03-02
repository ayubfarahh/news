<nav>
    <ul>
        <li><a href="addcategory.php">Add Category</a></li>
        <li><a href="addarticle.php">Add Article</a></li>
        <li><a href="categories.php">List Categories</a></li>
        <li><a href="articles.php">List Articles</a></li>
    </ul>
</nav>
<article>
    <h2>Add Article</h2>

    <?php
    if (isset($_SESSION['loggedin'])) {
        if (isset($_POST['submit'])) {
            $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

            $stmt = $pdo->prepare(
                'INSERT INTO article (title, description, categoryId, date) VALUES (:title, :description, :categoryId, :date)'
            );

            $stmt->execute([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'categoryId' => $_POST['categoryId'],
                'date' => (new DateTime())->format('Y-m-d H:i:s'),
            ]);

            echo 'Article added';
        } else {
            $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

            $stmt = $pdo->prepare('SELECT * FROM article WHERE id = :id');
            $stmt->execute(['id' => $_GET['id']]);
            $article = $stmt->fetch();
            ?>
            <form action="addarticle.php" method="POST">
                <label>Category</label>
                <select name="categoryId">
                    <option value="1" <?php if ($article['categoryId'] === 1) echo 'selected="selected"'; ?>>Local News</option>
                    <option value="2" <?php if ($article['categoryId'] === 2) echo 'selected="selected"'; ?>>Local Events</option>
                    <option value="3" <?php if ($article['categoryId'] === 3) echo 'selected="selected"'; ?>>Sport</option>
                </select>
                <label>Article title:</label>
                <input type="text" name="title" value="<?php echo $article['title']; ?>" />
                <label>Article text:</label>
                <textarea name="description"><?php echo $article['description']; ?></textarea>
                <input type="submit" value="Submit" name="submit" />
            </form>
            <?php
        }
    } else {
        ?>
        <form action="index.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" />
            <label>Password</label>
            <input type="password" name="password" />
            <input type="submit" name="submit" value="submit" />
        </form>
        <?php
    }
    ?>
</article>
