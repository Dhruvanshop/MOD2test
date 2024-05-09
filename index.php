<?php
require __DIR__ . '/vendor/autoload.php';
$requestUri = $_SERVER['REQUEST_URI'];
// Define routes and corresponding PHP files
$str = substr($requestUri, 1);

$urlComponents = explode("/", $str);

if (empty($urlComponents[0])) {
  $urlComponents[0] = "dashboard";
}

$fileName = './app/' . $urlComponents[0] . '.php';
if (!file_exists($fileName)) {
  echo "Error 404 Found";
}
include_once($fileName);