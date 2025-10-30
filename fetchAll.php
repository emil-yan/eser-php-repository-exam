<?php
include 'dbConfig.php';

// Fetch all records
$stmt = $conn->prepare("SELECT * FROM eserGrocery");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($result);
echo "</pre>";
?>