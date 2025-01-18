<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/enquiries.html.php', []);
require 'adminTemplates/layout.html.php';
