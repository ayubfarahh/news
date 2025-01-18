<nav>
    <ul>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <!-- Links for logged-in users (Admin) -->
            <li><a href="addcategory.php">Add Category</a></li>
            <li><a href="addarticle.php">Add Article</a></li>
            <li><a href="staff.php"> Add Staff</a></li>
            <li><a href="categories.php">List Categories</a></li>
            <li><a href="articles.php">List Articles</a></li>
            <li><a href="enquiries.php">Enquiries</a></li>
        <?php else: ?>
            <!-- Login form for guests (not logged in) -->
            <li><a href="index.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<article>
    <?php

    $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student'); // Database connection

    // Handle login if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Fetch the user from the database based on the username
        $stmt = $pdo->prepare('SELECT id, username, password, admin FROM staff WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user) { // Check if the user exists
            // Verify the password
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['admin'] = $user['admin'];
                $_SESSION['userId'] = $user['id']; // Store the user ID in the session
                echo 'Login successful!';
            } else {
                // Incorrect password
                echo 'Invalid username or password.';
            }
        } else {
            // User not found
            echo 'Invalid username or password.';
        }
    }

    // Show the login form if not logged in
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
        // If logged in, show a welcome message
        echo 'Welcome back, ' . htmlspecialchars($_SESSION['username']) . '! Please choose an option from the navigation menu.';
    }
    ?>
</article>

