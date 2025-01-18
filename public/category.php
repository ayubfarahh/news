<?php 
session_start();
require '../templates/functions.php';

$output = loadTemplate('../templates/category.html.php',[]);

require '../templates/layout.html.php';
