
<?php
include "db.php";

$result = $conn->query("SELECT COUNT(*) AS count FROM sales
WHERE DATE(sale_date) = CURDATE()");
$transactions = $result->fetch_assoc()["count"];

$result = $conn->query("SELECT SUM(total) AS total FROM sales
WHERE DATE(sale_date) = CURDATE()");
$income = $result->fetch_assoc()["total"] ?? 0;

$result = $conn->query("SELECT SUM(quantity) AS total FROM sales
WHERE DATE(sale_date) = CURDATE()");
$items = $result->fetch_assoc()["total"] ?? 0;

$result = $conn->query("SELECT SUM(total) AS total FROM sales");
$overall = $result->fetch_assoc()["total"] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h2>Sales Recording System</h2>
    <a href="index.php">Dashboard</a>
    <a href="sales.php">Record Sale</a>
    <a href="history.php">Sales History</a>
</div>

<div class="container">
    <h1>Dashboard</h1>
    <p>Sales summary and monitoring</p>

    <div class="cards">
        <div class="card">
            <h3>Transactions Today</h3>
            <h2><?php echo $transactions; ?></h2>
        </div>

        <div class="card">
            <h3>Today's Income</h3>
            <h2>₱<?php echo number_format($income, 2); ?></h2>
        </div>

        <div class="card">
            <h3>Items Sold Today</h3>
            <h2><?php echo $items; ?></h2>
        </div>

        <div class="card">
            <h3>Total Sales Recorded</h3>
            <h2>₱<?php echo number_format($overall, 2); ?></h2>
        </div>
    </div>

    <a class="button" href="sales.php">+ Record New Sale</a>
</div>

</body>
</html>
