<?php
session_start();
require 'adminTemplates/functions.php';

$pdo = new PDO('mysql:host=mysql;dbname=news;charset=utf8', 'student', 'student');

// Fetch categories
$stmt = $pdo->prepare('SELECT * FROM category ORDER BY name ASC');
$stmt->execute();
$categories = $stmt->fetchAll();

// Pass categories to the template
$output = loadTemplate('adminTemplates/categories.html.php', ['categories' => $categories]);

require 'adminTemplates/Layout.html.php';
?>
