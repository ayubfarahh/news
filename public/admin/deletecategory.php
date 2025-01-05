<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/deleteCategory.html.php', []);
require 'adminTemplates/layout.html.php';
