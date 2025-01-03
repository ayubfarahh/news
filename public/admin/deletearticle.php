<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/deleteArticle.html.php', []);
require 'adminTemplates/Layout.html.php';
