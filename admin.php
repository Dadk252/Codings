
<?php
session_start();

if (!isset($_SESSION["reservations"])) {
    $_SESSION["reservations"] = [];
}

if (isset($_GET["cancel"])) {

    $id = $_GET["cancel"];

    if (isset($_SESSION["reservations"][$id])) {
        unset($_SESSION["reservations"][$id]);
        $_SESSION["reservations"] = array_values($_SESSION["reservations"]);
    }

    header("Location: admin.php");
    exit;
}

$reservations = $_SESSION["reservations"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Admin Dashboard</h1>

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
                <a href="admin.php?cancel=<?php echo $id; ?>"
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
