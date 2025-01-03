<nav>
				<ul>
					<li><a href="addcategory.php">Add Category</a></li>
					<li><a href="addarticle.php">Add Article</a></li>
					<li><a href="categories.php">List Categories</a></li>
					<li><a href="articles.php">List Articles</a></li>
				</ul>
            </nav>
            <article>
                <h2>Articles</h2>
                <?php

                if (isset($_SESSION['loggedin'])) {
                    $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
                        
                    $stmt = $pdo->prepare('SELECT * FROM article');
                    $stmt->execute();
                    
                    echo '<table>';
                    foreach ($stmt as $article) {
                        echo '<tr>';
                        echo '<td>' . $article['title'] . '</td>';
                        echo '<td><a href="editarticle.php?id=' . $article['id'] . '">Edit</a></td>';
                        echo '<td><a href="deletearticle.php?id=' . $article['id'] . '">Delete</a></td>';
                        echo '</td>';
                    }
                    echo '</table>';

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