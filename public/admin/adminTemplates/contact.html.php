<?php
$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');


    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $stmt = $pdo->prepare('UPDATE contact SET status = "done" WHERE id = :id');
        $stmt->execute(['id' => $_POST['id']]);
    }


$stmt = $pdo->prepare('SELECT * FROM contact ORDER BY submitted_at DESC');
$stmt->execute();
$messages = $stmt->fetchAll();
?>

<article>
    <h2>Reader Contact Messages</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Question</th>
                <th>Status</th>
              
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?= htmlspecialchars($message['name'] ?? '') ?></td>
                    <td><?= htmlspecialchars($message['number'] ?? '') ?></td>
                    <td><?= htmlspecialchars($message['email'] ?? '') ?></td>
                    <td><?= htmlspecialchars($message['question'] ?? '') ?></td>
                    <td>pending</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>
