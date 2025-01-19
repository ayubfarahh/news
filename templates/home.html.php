<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
       
        $_SESSION['userId'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        
        header('Location: latest.php');
        exit(); 
    } else {
        echo 'Invalid email or password.';
    }
}
?>
<form action="" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required />
    <label>Password:</label>
    <input type="password" name="password" required />
    <input type="submit" value="Log in" />
</form>
<p>Don't have an account with us? <a href="register.php">Register here</a></p>
