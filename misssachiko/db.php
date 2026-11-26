<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to SQLite database
$db = new SQLite3(__DIR__ . '/sales.db');

// Create sales table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS sales (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    product_name TEXT NOT NULL,
    price REAL NOT NULL,
    quantity INTEGER NOT NULL,
    total REAL NOT NULL,
    sale_date DATETIME DEFAULT CURRENT_TIMESTAMP
)");
?>