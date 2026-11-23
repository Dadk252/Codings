
<?php
include "classes.php";

$reservations = [];
$file = "reservations.json";

if (file_exists($file)) {
    $reservations = json_decode(file_get_contents($file), true);
}

$total = 20;
$reserved = count($reservations);
$available = $total - $reserved;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Computer Laboratory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="dashboard-header">
        <h1>Computer Laboratory</h1>
        <p>Seat Reservation System</p>
        <h3>Available Computer Seats</h3>
    </div>

    <div class="seat-stats">

        <div class="stat-card total-card">
            <span>Total Seats</span>
            <h2><?php echo $total; ?></h2>
        </div>

        <div class="stat-card available-card">
            <span>Available</span>
            <h2><?php echo $available; ?></h2>
        </div>

        <div class="stat-card reserved-card">
            <span>Reserved</span>
            <h2><?php echo $reserved; ?></h2>
        </div>

    </div>

    <div class="seats">

        <?php for ($i = 1; $i <= 20; $i++): ?>

            <?php
            $status = "Available";

            foreach ($reservations as $r) {
                if ($r["seat"] == $i) {
                    $status = "Reserved";
                }
            }
            ?>

            <div class="seat <?php echo strtolower($status); ?>">
                PC <?php echo $i; ?><br>
                <?php echo $status; ?>
            </div>

        <?php endfor; ?>

    </div>

    <a href="reserve.php">Reserve Seat</a>
    <a href="reservations.php">View Reservations</a>

</div>

</body>
</html>
