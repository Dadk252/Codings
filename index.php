
<?php
session_start();

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = [];
}

$reservations = $_SESSION["reservations"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>COMPUTER LABORATORY SEAT RESERVATION SYSTEM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Computer Laboratory</h1>
    <p>Seat Reservation System</p>

    <h3>Available Computer Seats</h3>

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
