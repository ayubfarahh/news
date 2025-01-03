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
                    $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
                    $stmt = $pdo->prepare('DELETE FROM category WHERE id = :id');
                    $stmt->execute(['id' => $_GET['id']]);

                    echo 'Category deleted';
                }
                else {
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
