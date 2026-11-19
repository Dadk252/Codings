
<?php
session_start();
include "classes.php";

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = [];
}

$message = "";

if (isset($_POST["submit"])) {

    $name = trim($_POST["name"]);
    $studentID = trim($_POST["studentID"]);
    $seat = (int) $_POST["seat"];

    $reserved = false;

    foreach ($_SESSION["reservations"] as $r) {
        if ($r["seat"] == $seat) {
            $reserved = true;
        }
    }

    if ($name == "" || $studentID == "") {
        $message = "Please complete all fields.";

    } elseif ($seat < 1 || $seat > 20) {
        $message = "Invalid computer seat.";

    } elseif ($reserved) {
        $message = "Seat already reserved!";

    } else {

        $student = new Student();
        $student->setName($name);
        $student->setStudentID($studentID);

        $reservation = new Reservation($student, $seat);

        $_SESSION["reservations"][] = $reservation->toArray();

        header("Location: reservations.php");
        exit;
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

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST" onsubmit="return confirmReservation()">

        <input type="text" name="name"
        placeholder="Student Name" required>

        <input type="text" name="studentID"
        placeholder="Student ID" required>

        <select name="seat" required>
            <option value="">Select Computer</option>

            <?php for ($i = 1; $i <= 20; $i++): ?>

                <?php
                $reserved = false;

                foreach ($_SESSION["reservations"] as $r) {
                    if ($r["seat"] == $i) {
                        $reserved = true;
                    }
                }
                ?>

                <?php if (!$reserved): ?>
                    <option value="<?php echo $i; ?>">
                        Computer <?php echo $i; ?>
                    </option>
                <?php endif; ?>

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
