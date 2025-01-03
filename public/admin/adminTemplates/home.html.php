<nav>
				<ul>
					<li><a href="addcategory.php">Add Category</a></li>
					<li><a href="addarticle.php">Add Article</a></li>
					<li><a href="categories.php">List Categories</a></li>
					<li><a href="articles.php">List Articles</a></li>
				</ul>
            </nav>
            <article>
            <?php
                if (isset($_POST['submit'])) {
                    if ($_POST['username'] === 'admin' && $_POST['password'] === 'letmein') {
                        $_SESSION['loggedin'] = true;
                    }
                }

                if (isset($_SESSION['loggedin'])) {
                    echo 'Welcome back. Please choose an option from the left';
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