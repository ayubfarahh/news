<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/categories.html.php', []);
require 'adminTemplates/layout.html.php';
?>
