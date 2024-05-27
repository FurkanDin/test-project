<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'vendor/autoload.php';
require_once 'src/classes/Main.php';

// Set the error handler

$main = new Main();
$main->run();
