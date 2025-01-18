<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/author_articles.html.php', []);
require 'adminTemplates/layout.html.php';
