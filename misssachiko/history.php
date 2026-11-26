
<?php
include "db.php";

// DELETE A SALE
if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];

    $stmt = $conn->prepare("DELETE FROM sales WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: history.php");
    exit;
}

// SEARCH SALES
$search = $_GET["search"] ?? "";

$stmt = $conn->prepare("SELECT * FROM sales
WHERE product_name LIKE ? OR id LIKE ?
ORDER BY id DESC");

$keyword = "%$search%";
$stmt->bind_param("ss", $keyword, $keyword);
$stmt->execute();

$sales = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales History</title>
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
    <h1>Sales History</h1>

    <form method="GET" class="search">
        <input type="text" name="search"
        placeholder="Search product or transaction ID"
        value="<?php echo htmlspecialchars($search); ?>">

        <button type="submit">Search</button>
        <a class="button secondary" href="history.php">Reset</a>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $sales->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo htmlspecialchars($row["product_name"]); ?></td>
            <td>₱<?php echo number_format($row["price"], 2); ?></td>
            <td><?php echo $row["quantity"]; ?></td>
            <td>₱<?php echo number_format($row["total"], 2); ?></td>
            <td><?php echo $row["sale_date"]; ?></td>
            <td>
                <a href="history.php?delete=<?php echo $row["id"]; ?>"
                onclick="return confirm('Delete this sale?')">
                Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
