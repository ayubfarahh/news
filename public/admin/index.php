<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/home.html.php', []);
require 'adminTemplates/layout.html.php';
