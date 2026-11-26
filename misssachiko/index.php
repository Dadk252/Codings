
<?php
include "db.php";

$transactions = $db->query("SELECT COUNT(*) AS total FROM sales
WHERE date(sale_date) = date('now','localtime')")->fetchArray()["total"];

$income = $db->query("SELECT SUM(total) AS total FROM sales
WHERE date(sale_date) = date('now','localtime')")->fetchArray()["total"] ?? 0;

$items = $db->query("SELECT SUM(quantity) AS total FROM sales
WHERE date(sale_date) = date('now','localtime')")->fetchArray()["total"] ?? 0;

$overall = $db->query("SELECT SUM(total) AS total FROM sales")->fetchArray()["total"] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <h2>Sales System</h2>
    <a href="index.php">Dashboard</a>
    <a href="sales.php">Record Sale</a>
    <a href="history.php">Sales History</a>
</nav>

<div class="container">
    <h1>Dashboard</h1>
    <p>Sales overview for your store</p>

    <div class="cards">
        <div class="card">
            <h3>Transactions Today</h3>
            <h2><?php echo $transactions; ?></h2>
        </div>

        <div class="card">
            <h3>Today's Sales</h3>
            <h2>₱<?php echo number_format($income ?? 0, 2); ?></h2>
        </div>

        <div class="card">
            <h3>Items Sold Today</h3>
            <h2><?php echo $items ?? 0; ?></h2>
        </div>

        <div class="card">
            <h3>Total Sales</h3>
            <h2>₱<?php echo number_format($overall ?? 0, 2); ?></h2>
        </div>
    </div>

    <a href="sales.php" class="button">+ Record New Sale</a>
    <a href="history.php" class="button secondary">View Sales</a>
</div>

</body>
</html>
