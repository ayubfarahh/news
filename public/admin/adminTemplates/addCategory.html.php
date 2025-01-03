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
                        
                        $stmt = $pdo->prepare('INSERT INTO category (name) VALUES (:name)');

                        $stmt->execute([
                            'name' => $_POST['name'],
                        ]);

                        echo 'Category added';
                    }
                    else {
                        ?>
                        <form action="addcategory.php" method="POST">
                            <label>Category name:</label>
                            <input type="text" name="name" />
                            <input type="submit" value="Submit" name="submit" />
                        </form>
                        <?php
                    }
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