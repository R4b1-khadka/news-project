<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$hostname= 'http://localhost/news-project';
  $conn= mysqli_connect("localhost","dev","dev123","news-site") or die("connection eroor");