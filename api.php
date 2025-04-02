<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "imobiliaria";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Erro de conexão: " . $conn->connect_error]));
}

// Pegando todos os corretores
$sql = "SELECT * FROM corretores";
$result = $conn->query($sql);

$corretores = [];
while ($row = $result->fetch_assoc()) {
    $corretores[] = $row;
}

echo json_encode($corretores);
?>
