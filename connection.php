<?php

if(empty(session_id())) {
    session_start();
}

$servername = "localhost";
$username = "root";
$dbname = "hyip";

$conn = new mysqli($servername, $username, null, $dbname);

if($conn->connect_error) {
    die("connecion failed: " . $conn->connect_error);
};

function getUser()
{
    global $conn;
    $sql = "SELECT * FROM users WHERE id = {$_SESSION['user']['id']}";
    $user = $conn->query($sql)->fetch_assoc();
    return $user;
}


require "transaction.php"; # ./transaction.php
require "inc/Investment.php";
