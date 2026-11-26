
<?php
include "db.php";

$message = "";

if (isset($_POST["save"])) {
    $name = trim($_POST["product_name"]);
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if ($name == "" || !is_numeric($price) || $price <= 0
        || filter_var($quantity, FILTER_VALIDATE_INT) === false
        || $quantity < 1) {

        $message = "Please enter valid product, price, and quantity.";
    } else {
        $total = round($price * $quantity, 2);

        $stmt = $db->prepare("INSERT INTO sales
        (product_name, price, quantity, total)
        VALUES (:name, :price, :quantity, :total)");

        $stmt->bindValue(":name", $name, SQLITE3_TEXT);
        $stmt->bindValue(":price", $price, SQLITE3_FLOAT);
        $stmt->bindValue(":quantity", $quantity, SQLITE3_INTEGER);
        $stmt->bindValue(":total", $total, SQLITE3_FLOAT);

        if ($stmt->execute()) {
            $message = "Sale recorded successfully!";
        } else {
            $message = "Unable to save sale.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Record Sale</title>
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
    <h1>Record a Sale</h1>

    <p class="message"><?php echo htmlspecialchars($message); ?></p>

    <div class="card form-card">
        <form method="POST">
            <label>Product Name</label>
            <input type="text" name="product_name"
            placeholder="Enter product name" required>

            <label>Price per Item (₱)</label>
            <input type="number" name="price" id="price"
            step="0.01" min="0.01" placeholder="0.00" required>

            <label>Quantity</label>
            <input type="number" name="quantity" id="quantity"
            min="1" step="1" placeholder="Enter quantity" required>

            <label>Total Amount</label>
            <input type="text" id="total" placeholder="₱0.00" readonly>

            <button type="submit" name="save">Save Sale</button>
        </form>
    </div>
</div>

<script>
const price = document.getElementById("price");
const quantity = document.getElementById("quantity");
const total = document.getElementById("total");

function calculateTotal() {
    let result = Number(price.value) * Number(quantity.value);
    total.value = "₱" + result.toFixed(2);
}

price.addEventListener("input", calculateTotal);
quantity.addEventListener("input", calculateTotal);
</script>

</body>
</html>
