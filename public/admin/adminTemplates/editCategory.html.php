<nav>
    <ul>
        <li><a href="addcategory.php">Add Category</a></li>
        <li><a href="addarticle.php">Add Article</a></li>
        <li><a href="categories.php">List Categories</a></li>
        <li><a href="articles.php">List Articles</a></li>
    </ul>
</nav>
<article>
    <h2>Add category</h2>
    <?php
    if (isset($_SESSION['loggedin'])) {
        if (isset($_POST['submit'])) {
            $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
            
            $stmt = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id');

            $stmt->execute([
                'id' => $_POST['id'],
                'name' => $_POST['name'],
            ]);

            echo 'Category updated';
        } else {
            $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
            $stmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');
            $stmt->execute([
                'id' => $_GET['id']
            ]);
            $category = $stmt->fetch();
            ?>
            <form action="editcategory.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                <label>Category name:</label>
                <input type="text" name="name" value="<?php echo $category['name']; ?>" />
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
