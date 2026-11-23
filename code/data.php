<?php
session_start();

$totalSeats = 20;

// Sample reservations loaded on first visit
$sampleReservations = [
    ["name" => "Alex Rivera", "studentID" => "2026-001", "seat" => 2],
    ["name" => "Mia Santos", "studentID" => "2026-002", "seat" => 7],
    ["name" => "Liam Cruz", "studentID" => "2026-003", "seat" => 14],
];

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = $sampleReservations;
}

function isSeatTaken($seatNumber, $reservations, $ignoreIndex = null) {
    foreach ($reservations as $index => $item) {
        if ($ignoreIndex !== null && $index == $ignoreIndex) {
            continue;
        }
        if ($item["seat"] == $seatNumber) {
            return true;
        }
    }
    return false;
}
