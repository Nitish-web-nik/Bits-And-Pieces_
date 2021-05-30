<?php

$hostname = "localhost";
$username1 = "root";
$password = "";
$db =  "bitsandpieces";
$conn = new mysqli($hostname,$username1,$password,$db);
if($conn->connect_error){
die("connection error".$conn->connect_error);
header('location: 404.html');
}
session_start();
error_reporting('1');