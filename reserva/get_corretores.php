<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");



$sql = "SELECT * FROM corretores";
$result = $conn->query($sql);

$corretores = [];
while ($row = $result->fetch_assoc()) {
    $corretores[] = $row;
}

echo json_encode($corretores);
?>
