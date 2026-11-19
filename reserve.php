
<?php
session_start();

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = [];
}

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $studentID = $_POST["studentID"];
    $seat = $_POST["seat"];

    $reserved = false;

    foreach ($_SESSION["reservations"] as $r) {
        if ($r["seat"] == $seat) {
            $reserved = true;
        }
    }

    if (!$reserved) {

        $_SESSION["reservations"][] = [
            "name" => $name,
            "studentID" => $studentID,
            "seat" => $seat
        ];

        echo "<script>
        alert('Reservation Successful!');
        window.location='reservations.php';
        </script>";

    } else {
        echo "<script>alert('Seat Already Reserved!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reserve Seat</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>

<div class="container">
    <h1>Reserve a Seat</h1>

    <form method="POST" onsubmit="return confirmReservation()">

        <input type="text" name="name"
        placeholder="Student Name" required>

        <input type="text" name="studentID"
        placeholder="Student ID" required>

        <select name="seat" required>
            <option value="">Select Computer</option>

            <?php for ($i = 1; $i <= 20; $i++): ?>
                <option value="<?php echo $i; ?>">
                    Computer <?php echo $i; ?>
                </option>
            <?php endfor; ?>

        </select>

        <button type="submit" name="submit">
            Reserve Now
        </button>

    </form>

    <a href="index.php">Back to Home</a>
</div>

</body>
</html>
