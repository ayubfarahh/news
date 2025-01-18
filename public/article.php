<?php 
session_start();
require '../templates/functions.php';

$output = loadTemplate('../templates/article.html.php',[]);

require '../templates/layout.html.php';
