<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "voyage";

$conn = new PDO(
    "mysql:host=$hostname; dbname=$database;
    charset=utf8", $username, $password
);
