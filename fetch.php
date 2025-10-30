<?php
include 'dbConfig.php';

// Fetch single record
$stmt = $conn->prepare("SELECT * FROM eserGrocery WHERE id = 1");
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($row);
echo "</pre>";
?>