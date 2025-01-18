<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!empty($username) && !empty($email) && !empty($_POST['password'])) {
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);

        echo 'Registration successful. <a href="login.php">Log in</a>';
    } else {
        echo 'Please fill in all fields.';
    }
}
?>
<form action="" method="POST">
    <label>Username:</label>
    <input type="text" name="username" required />
    <label>Email:</label>
    <input type="email" name="email" required />
    <label>Password:</label>
    <input type="password" name="password" required />
    <input type="submit" value="Register" />
</form>
