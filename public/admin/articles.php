<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/articles.html.php', []);
require 'adminTemplates/layout.html.php';
