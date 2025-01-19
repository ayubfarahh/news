<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['name'], $_POST['number'], $_POST['email'], $_POST['question']) &&
        !empty($_POST['name']) && !empty($_POST['number']) && !empty($_POST['email']) && !empty($_POST['question'])) {

        $pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

       
        $stmt = $pdo->prepare('INSERT INTO contact (name, number, email, question) VALUES (:name, :number, :email, :question)');
        $stmt->execute([
            'name' => $_POST['name'],
            'number' => $_POST['number'],
            'email' => $_POST['email'],
            'question' => $_POST['question'],
        ]);

        
        echo '<p>Thank you for your message! We will get back to you soon.</p>';
    } 
} else {
   
?>
   <!-- // come back to look at this form later -->
<article>
    <h2>Contact Us</h2>
    <p>Email: enquiries@northamptonnews.com</p>
    <p>Telephone: 01604 112 112</p>
    <form method="post" action="contact.php" class="contact-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="number">Number:</label>
        <input type="tel" id="number" name="number" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="question">Your Question:</label>
        <textarea id="question" name="question" required></textarea>

        <button type="submit" class="submit-button">Submit</button>
    </form>
</article>

<?php
}
?>
