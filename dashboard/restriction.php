<?php

if(empty(session_id())) {
    session_start();
};

// check if user is logged in

if(isset($_SESSION['user']) === false) {
    header("location: ../signin.php");
    die();
}
