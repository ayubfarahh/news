<?php
require __DIR__ . '/../templates/functions.php';

// Render the admin home template
$output = loadTemplate(__DIR__ . '/../templates/adminHome.html.php', []);

// Include the admin layout template
require __DIR__ . '/../templates/adminLayout.html.php';
