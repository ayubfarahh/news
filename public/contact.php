<?php 
session_start();
require '../templates/functions.php';

$output = loadTemplate('../templates/contact.html.php',[]);

require '../templates/layout.html.php';
