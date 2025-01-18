<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/staff.html.php', []);
require 'adminTemplates/layout.html.php';
