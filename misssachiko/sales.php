
<?php
include "db.php";

$message = "";

if (isset($_POST["save"])) {
    $name = trim($_POST["product_name"]);
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if ($name == "" || !is_numeric($price)
        || !is_numeric($quantity) || $price <= 0
        || $quantity <= 0) {
        $message = "Please enter valid information.";
    } else {
        $total = $price * $quantity;

        $stmt = $conn->prepare("INSERT INTO sales
        (product_name, price, quantity, total)
        VALUES (?, ?, ?, ?)");

        $stmt->bind_param("sdid",
            $name, $price, $quantity, $total);

        $stmt->execute();

        $message = "Sale recorded successfully!";
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

<div class="navbar">
    <h2>Sales Recording System</h2>
    <a href="index.php">Dashboard</a>
    <a href="sales.php">Record Sale</a>
    <a href="history.php">Sales History</a>
</div>

<div class="container">
    <h1>Record a Sale</h1>
    <p><?php echo $message; ?></p>

    <div class="card">
        <form method="POST">

            <label>Product Name</label>
            <input type="text" name="product_name"
            placeholder="Enter product name" required>

            <label>Price per Item (₱)</label>
            <input type="number" name="price" id="price"
            step="0.01" min="0.01" placeholder="0.00" required>

            <label>Quantity Sold</label>
            <input type="number" name="quantity" id="quantity"
            min="1" placeholder="Enter quantity" required>

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
