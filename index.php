<?php
session_start();
include "classes.php";

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = [];
}

$reservations = $_SESSION["reservations"];

$total = 20;
$reserved = count($reservations);
$available = $total - $reserved;
?>