<?php
$file = "reservations.json";

$reservations = [];

if (file_exists($file)) {
    $reservations = json_decode(file_get_contents($file), true);
}

$total = count($reservations);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Keep your original CSS here -->
</head>
<body>
<div class="container">

    <div class="nav">
        <a href="index.php" class="active">Dashboard</a>
        <a href="book.php">Book Seat</a>
        <a href="reservations.php">View Reservations</a>
        <a href="status.php">Lab Status</a>
    </div>

    <h1>Computer Lab Dashboard</h1>

    <p>Welcome to the Computer Lab Seat Reservation Portal.</p>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Active Reservations</h3>
            <div class="stat-number"><?= $total ?></div>
        </div>

        <div class="stat-card">
            <h3>Total Workstations</h3>
            <div class="stat-number">6</div>
        </div>
    </div>

</div>
</body>
</html>
