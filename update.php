<?php
include 'dbConfig.php';

// Update record
$sql = "UPDATE eserGrocery SET price_retail = 5.99 WHERE id = 1";
$conn->exec($sql);

echo "Record updated successfully!";
?>