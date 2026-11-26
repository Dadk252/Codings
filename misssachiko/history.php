
<?php
include "db.php";

$message = "";

// UPDATE SALE
if (isset($_POST["update"])) {
    $id = (int)$_POST["id"];
    $name = trim($_POST["product_name"]);
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if ($id < 1 || $name == "" || !is_numeric($price) || $price <= 0
        || filter_var($quantity, FILTER_VALIDATE_INT) === false
        || $quantity < 1) {

        $message = "Please enter valid information.";
    } else {
        $total = round($price * $quantity, 2);

        $stmt = $db->prepare("UPDATE sales SET
        product_name = :name, price = :price,
        quantity = :quantity, total = :total
        WHERE id = :id");

        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":price", $price, SQLITE3_FLOAT);
        $stmt->bindValue(":quantity", $quantity, SQLITE3_INTEGER);
        $stmt->bindValue(":total", $total, SQLITE3_FLOAT);
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);

        $stmt->execute();

        header("Location: history.php");
        exit;
    }
}

// DELETE SALE
if (isset($_POST["delete"])) {
    $id = (int)$_POST["id"];

    $stmt = $db->prepare("DELETE FROM sales WHERE id = :id");
    $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
    $stmt->execute();

    header("Location: history.php");
    exit;
}

// GET SALE TO EDIT
$editSale = null;

if (isset($_GET["edit"])) {
    $id = (int)$_GET["edit"];

    $stmt = $db->prepare("SELECT * FROM sales WHERE id = :id");
    $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    $editSale = $result->fetchArray(SQLITE3_ASSOC);
}

// SEARCH SALES
$search = $_GET["search"] ?? "";

$stmt = $db->prepare("SELECT * FROM sales
WHERE product_name LIKE :search OR CAST(id AS TEXT) LIKE :search
ORDER BY id DESC");

$stmt->bindValue(":search", "%" . $search . "%", SQLITE3_TEXT);
$result = $stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales History</title>
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
    <h1>Sales History</h1>

    <?php if ($editSale) { ?>
    <div class="card form-card">
        <h2>Edit Sale #<?php echo $editSale["id"]; ?></h2>

        <form method="POST">
            <input type="hidden" name="id"
            value="<?php echo $editSale["id"]; ?>">

            <label>Product Name</label>
            <input type="text" name="product_name"
            value="<?php echo htmlspecialchars($editSale["product_name"]); ?>"
            required>

            <label>Price</label>
            <input type="number" name="price" step="0.01" min="0.01"
            value="<?php echo $editSale["price"]; ?>" required>

            <label>Quantity</label>
            <input type="number" name="quantity" min="1" step="1"
            value="<?php echo $editSale["quantity"]; ?>" required>

            <button type="submit" name="update">Update Sale</button>
            <a class="button secondary" href="history.php">Cancel</a>
        </form>
    </div>
    <?php } ?>

    <form method="GET" class="search">
        <input type="text" name="search"
        placeholder="Search product or ID"
        value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
        <a class="button secondary" href="history.php">Reset</a>
    </form>

    <div class="table-wrap">
    <table>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo htmlspecialchars($row["product_name"]); ?></td>
            <td>₱<?php echo number_format($row["price"], 2); ?></td>
            <td><?php echo $row["quantity"]; ?></td>
            <td>₱<?php echo number_format($row["total"], 2); ?></td>
            <td><?php echo $row["sale_date"]; ?></td>
            <td>
                <a href="history.php?edit=<?php echo $row["id"]; ?>">Edit</a>

                <form method="POST" class="delete-form"
                onsubmit="return confirm('Delete this sale?');">
                    <input type="hidden" name="id"
                    value="<?php echo $row["id"]; ?>">
                    <button type="submit" name="delete" class="delete-btn">
                    Delete
                    </button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>

</body>
</html>
