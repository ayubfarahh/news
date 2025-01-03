<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/edit.html.php', []);
require 'adminTemplates/layout.html.php';
