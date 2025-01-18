<?php 
session_start();
require '../templates/functions.php';

$output = loadTemplate('../templates/home.html.php',[]);

require '../templates/layout.html.php';
