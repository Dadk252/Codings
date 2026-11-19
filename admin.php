
<?php
session_start();
include "classes.php";

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = [];
}

$message = "";

// Delete Reservation
if (isset($_GET["cancel"])) {

    $id = (int) $_GET["cancel"];

    if (isset($_SESSION["reservations"][$id])) {
        unset($_SESSION["reservations"][$id]);

        $_SESSION["reservations"] =
            array_values($_SESSION["reservations"]);
    }

    header("Location: admin.php");
    exit;
}

// Update Reservation
if (isset($_POST["update"])) {

    $id = (int) $_POST["id"];
    $name = trim($_POST["name"]);
    $studentID = trim($_POST["studentID"]);
    $seat = (int) $_POST["seat"];

    $reserved = false;

    foreach ($_SESSION["reservations"] as $key => $r) {
        if ($key != $id && $r["seat"] == $seat) {
            $reserved = true;
        }
    }

    if (!isset($_SESSION["reservations"][$id])) {
        $message = "Reservation not found.";

    } elseif ($name == "" || $studentID == "") {
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

        $_SESSION["reservations"][$id] =
            $reservation->toArray();

        header("Location: admin.php");
        exit;
    }
}

// Select Reservation to Edit
$edit = null;

if (isset($_GET["edit"])) {
    $id = (int) $_GET["edit"];

    if (isset($_SESSION["reservations"][$id])) {
        $edit = $_SESSION["reservations"][$id];
    }
}

$reservations = $_SESSION["reservations"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>

<div class="container">

    <h1>Admin Dashboard</h1>

    <p><?php echo htmlspecialchars($message); ?></p>

    <?php if ($edit): ?>

        <h3>Update Reservation</h3>

        <form method="POST">

            <input type="hidden" name="id"
            value="<?php echo $id; ?>">

            <input type="text" name="name"
            value="<?php echo htmlspecialchars($edit["name"]); ?>"
            required>

            <input type="text" name="studentID"
            value="<?php echo htmlspecialchars($edit["studentID"]); ?>"
            required>

            <select name="seat" required>

                <?php for ($i = 1; $i <= 20; $i++): ?>

                    <?php
                    $taken = false;

                    foreach ($reservations as $key => $r) {
                        if ($key != $id && $r["seat"] == $i) {
                            $taken = true;
                        }
                    }
                    ?>

                    <?php if (!$taken || $edit["seat"] == $i): ?>
                        <option value="<?php echo $i; ?>"
                        <?php echo $edit["seat"] == $i ? "selected" : ""; ?>>
                            Computer <?php echo $i; ?>
                        </option>
                    <?php endif; ?>

                <?php endfor; ?>

            </select>

            <button type="submit" name="update">
                Update Reservation
            </button>

        </form>

        <a href="admin.php">Back</a>

    <?php endif; ?>

    <h3>Manage Reservations</h3>

    <table>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Seat</th>
            <th>Action</th>
        </tr>

        <?php foreach ($reservations as $id => $r): ?>

        <tr>
            <td><?php echo htmlspecialchars($r["name"]); ?></td>
            <td><?php echo htmlspecialchars($r["studentID"]); ?></td>
            <td>PC <?php echo $r["seat"]; ?></td>

            <td>
                <a href="admin.php?edit=<?php echo $id; ?>">
                    Edit
                </a>

                <a class="cancel"
                href="admin.php?cancel=<?php echo $id; ?>"
                onclick="return confirm('Cancel reservation?')">
                    Cancel
                </a>
            </td>
        </tr>

        <?php endforeach; ?>

    </table>

    <a href="index.php">Back to Home</a>

</div>

</body>
</html>
