
<?php
session_start();
include "classes.php";

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = [];
}

$reservations = $_SESSION["reservations"];
$search = "";

if (isset($_GET["search"])) {
    $search = trim($_GET["search"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Reservations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Student Reservations</h1>

    <form method="GET">
        <input type="text" name="search"
        placeholder="Search Name, ID or Seat"
        value="<?php echo htmlspecialchars($search); ?>">

        <button type="submit">Search</button>
    </form>

    <table>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Computer</th>
        </tr>

        <?php foreach ($reservations as $r): ?>

            <?php
            $student = new Student();
            $student->setName($r["name"]);
            $student->setStudentID($r["studentID"]);

            $reservation = new Reservation(
                $student,
                $r["seat"]
            );

            $name = $student->getName();
            $studentID = $student->getStudentID();
            $seat = $reservation->getSeat();

            $match = stripos($name, $search) !== false ||
                     stripos($studentID, $search) !== false ||
                     stripos("PC " . $seat, $search) !== false;
            ?>

            <?php if ($search == "" || $match): ?>
            <tr>
                <td><?php echo htmlspecialchars($name); ?></td>
                <td><?php echo htmlspecialchars($studentID); ?></td>
                <td>PC <?php echo $seat; ?></td>
            </tr>
            <?php endif; ?>

        <?php endforeach; ?>

    </table>

    <a href="index.php">Home</a>
    <a href="admin.php">Admin</a>

</div>

</body>
</html>
