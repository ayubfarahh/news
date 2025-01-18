<?php


// Add Article Form & Insert Logic
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

        // Handle image upload (already provided above)
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = $_FILES['image']['name'];
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array(strtolower($imageExtension), $allowedExtensions)) {
                $uniqueImageName = uniqid('img_') . '.' . $imageExtension;
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
                }
                $imagePath = $uploadDir . $uniqueImageName;
                move_uploaded_file($imageTmpPath, $imagePath);
            } else {
                echo 'Invalid image format. Please upload JPG, PNG, or GIF images.';
                exit;
            }
        }

        // Insert the article into the database
        $stmt = $pdo->prepare('
            INSERT INTO article (title, description, categoryId, date, authorId, image) 
            VALUES (:title, :description, :categoryId, :date, :authorId, :image)
        ');

        $stmt->execute([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'categoryId' => $_POST['categoryId'],
            'date' => (new DateTime())->format('Y-m-d H:i:s'),
            'authorId' => $_SESSION['userId'], // Use logged-in user's ID
            'image' => $imagePath, // Store the image path in the database
        ]);

        echo 'Article added successfully.';
    } else {
        ?>
        <form action="addarticle.php" method="POST" enctype="multipart/form-data">
            <label>Category</label>
            <select name="categoryId">
                <option value="1">Local News</option>
                <option value="2">Local Events</option>
                <option value="3">Sport</option>
            </select>
            <label>Article title:</label>
            <input type="text" name="title" />
            <label>Article text:</label>
            <textarea name="description"></textarea>
            <label>Upload an Image:</label>
            <input type="file" name="image" accept="image/*" />
            <input type="submit" value="Submit" name="submit" />
        </form>
        <?php
    }
} else {
    echo 'Please log in to add an article.';
}

// Display Articles with Author's Name
$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');
$stmt = $pdo->prepare('
    SELECT article.*, staff.username AS author_name 
    FROM article 
    JOIN staff ON article.authorId = staff.id
    ORDER BY article.date DESC
');
$stmt->execute();

echo '<table>';
foreach ($stmt as $article) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($article['title']) . '</td>';
    echo '<td><a href="author_articles.php?id=' . $article['authorId'] . '">' . htmlspecialchars($article['author_name']) . '</a></td>';
    echo '<td>' . htmlspecialchars($article['date']) . '</td>';
    echo '<td>' . htmlspecialchars($article['description']) . '</td>';
    echo '<td><a href="editarticle.php?id=' . $article['id'] . '">Edit</a></td>';
    echo '<td><a href="deletearticle.php?id=' . $article['id'] . '">Delete</a></td>';
    echo '</tr>';
}
echo '</table>';
?>
