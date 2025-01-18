<?php
$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

//Ensure only admins can access this page


// Add new staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_staff'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $admin = isset($_POST['admin']) ? 1 : 0;

    $stmt = $pdo->prepare('INSERT INTO staff (username, password, admin) VALUES (:username, :password, :admin)');
    $stmt->execute(['username' => $username, 'password' => $password, 'admin' => $admin]);

    echo "Staff member added successfully.";
}

// Remove staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_staff'])) {
    $id = $_POST['id'];

    // Prevent deletion of your account
    $stmt = $pdo->prepare('SELECT admin FROM staff WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $staff = $stmt->fetch();

    if ($staff && !$staff['admin']) {
        $stmt = $pdo->prepare('DELETE FROM staff WHERE id = :id');
        $stmt->execute(['id' => $id]);

        echo "Staff member removed successfully.";
    } 
}

// Fetch staff list
$stmt = $pdo->query('SELECT id, username, admin FROM staff ORDER BY username');
$staffList = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Staff</title>
</head>
<body>
    <h1>Manage Staff</h1>
    <form method="post">
        <h2>Add Staff Member</h2>
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <label>Admin: <input type="checkbox" name="admin"></label><br>
        <button type="submit" name="add_staff" class="submit-button">Add Staff</button>
    </form>

    <h2 class='staff'>Current Staff</h2>
    <ul>
        <?php foreach ($staffList as $staff): ?>
            <li class= 'members'>
                <?= htmlspecialchars($staff['username']) ?> 
                <?= $staff['admin'] ? '(Admin)' : '' ?>
                <?php if (!$staff['admin']): ?>
                    <form method="post" style="display:inline;" class="staff-list">
                        <input type="hidden" name="id" value="<?= $staff['id'] ?>">
                        <button type="submit" name="remove_staff">Remove</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
