<?php
include 'dbConfig.php';

// Delete record
$sql = "DELETE FROM eserGrocery WHERE id = 61";
$conn->exec($sql);

echo "Record deleted successfully!";
?>