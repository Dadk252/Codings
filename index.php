<!DOCTYPE html>
<html>
<head>
    <title>Computer Lab Reservation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="dashboard-header">
        <h1>Computer Lab Reservation</h1>
        <p>Check seat availability and reserve a computer</p>
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

    <h3>Computer Seat Map</h3>

    <div class="seats">
        <?php for ($i = 1; $i <= $total; $i++): ?>
            <?php
            $isReserved = false;
            foreach ($reservations as $r) {
                if ($r["seat"] == $i) {
                    $isReserved = true;
                    break;
                }
            }
            ?>
            <div class="seat <?php echo $isReserved ? 'reserved' : 'available'; ?>">
                <strong>PC <?php echo $i; ?></strong><br>
                <span><?php echo $isReserved ? 'Reserved' : 'Available'; ?></span>
            </div>
        <?php endfor; ?>
    </div>

    <a href="reserve.php">Reserve a Seat</a>
    <a href="reservations.php">View Reservations</a>
    <a href="admin.php">Admin Dashboard</a>

</div>

</body>
</html>
