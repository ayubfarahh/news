<?php 
session_start();
require '../templates/functions.php';

$output = loadTemplate('../templates/advertise.html.php',[]);

require '../templates/layout.html.php';
