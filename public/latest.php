<?php 
session_start();
require '../templates/functions.php';

$output = loadTemplate('../templates/latest.html.php',[]);

require '../templates/layout.html.php';