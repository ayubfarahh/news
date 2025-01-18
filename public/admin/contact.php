<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/contact.html.php', []);
require 'adminTemplates/layout.html.php';

