<?php
session_start();
require 'adminTemplates/functions.php';
$output = loadTemplate('adminTemplates/editarticle.html.php', []);
require 'adminTemplates/layout.html.php';
