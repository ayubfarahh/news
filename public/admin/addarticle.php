<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/addArticle.html.php', []);
require 'adminTemplates/Layout.html.php';
