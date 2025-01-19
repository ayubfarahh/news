<nav>
    <ul>
        <li><a href="addcategory.php">Add Category</a></li>
        <li><a href="addarticle.php">Add Article</a></li>
        <li><a href="categories.php">List Categories</a></li>
        <li><a href="articles.php">List Articles</a></li>
    </ul>
</nav>
<article>
    <h2>Categories</h2>
    <?php
    if (isset($_SESSION['loggedin'])) {
        $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

        // fetch categories
        $stmt = $pdo->prepare('SELECT * FROM category ORDER BY name ASC');
        $stmt->execute();
        $categories = $stmt->fetchAll();

        if (!empty($categories)) {
            echo '<table>';
            foreach ($categories as $category) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td><a href="editcategory.php?id=' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') . '">Edit</a></td>';
                echo '<td><a href="deletecategory.php?id=' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') . '">Delete</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No categories found.</p>';
        }
    } else {
        // Display login form if not logged in
        ?>
        <form action="index.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required />
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
            <input type="submit" name="submit" value="Login" />
        </form>
        <?php
    }
    ?>
</article>
