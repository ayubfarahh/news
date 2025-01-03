<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/editCategory.html.php', []);
require 'adminTemplates/layout.html.php';
