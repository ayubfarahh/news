<?php 
session_start();
require '../templates/functions.php';

$output = loadTemplate('../templates/register.html.php',[]);

require '../templates/layout.html.php';
