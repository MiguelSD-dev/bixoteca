<?php
session_start();

if (isset($_SESSION["user"])) {
    $email = $_SESSION["user"];
    echo $email;
} else {
    header("Location: ./");
}
