
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
    <title>Reservations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Student Reservations</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Computer</th>
        </tr>

        <?php foreach ($reservations as $r): ?>
        <tr>
            <td><?php echo htmlspecialchars($r["name"]); ?></td>
            <td><?php echo htmlspecialchars($r["studentID"]); ?></td>
            <td>PC <?php echo $r["seat"]; ?></td>
        </tr>
        <?php endforeach; ?>

    </table>

    <a href="index.php">Home</a>
    <a href="admin.php">Admin</a>
</div>

</body>
</html>
