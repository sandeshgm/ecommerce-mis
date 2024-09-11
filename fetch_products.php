<?php
include 'connection.php';

$sql = "SELECT * FROM  products";
$result = $conn->query($sql);
$products = array();

while ($row = $result->fetch_assoc());
 {
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>