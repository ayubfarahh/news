<?php
session_start();

require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/addCategory.html.php', []);
require 'adminTemplates/layout.html.php';
