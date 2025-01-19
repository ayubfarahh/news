<nav>
    <ul>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <!-- Links for users who have succesfuly logged in -->
            <li><a href="addcategory.php">Add Category</a></li>
            <li><a href="addarticle.php">Add Article</a></li>
            <li><a href="staff.php"> Add Staff</a></li>
            <li><a href="categories.php">List Categories</a></li>
            <li><a href="articles.php">List Articles</a></li>
            <li><a href="enquiries.php">Enquiries</a></li>
        <?php else: ?>
            <!-- not logged in only see login -->
            <li><a href="index.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<article>
    <?php

    $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student'); // Database connection

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $stmt = $pdo->prepare('SELECT id, username, password, admin FROM staff WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['admin'] = $user['admin'];
                $_SESSION['userId'] = $user['id']; 
                echo 'Login successful!';
            } else {
                
                echo 'Invalid username or password.';
            }
        } else {
            
            echo 'Invalid username or password.';
        }
    }

    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        ?>
        <form action="index.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" required />
            <label>Password</label>
            <input type="password" name="password" required />
            <input type="submit" name="submit" value="Login" />
        </form>
        <?php
    } else {
        
        echo 'Welcome back, ' . htmlspecialchars($_SESSION['username']) . '! Please choose an option from the navigation menu.';
    }
    ?>
</article>

