<?php
include_once '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM corretores");
    $corretores = [];
    while ($row = $result->fetch_assoc()) {
        $corretores[] = $row;
    }
    echo json_encode($corretores);
}
$conn->close();