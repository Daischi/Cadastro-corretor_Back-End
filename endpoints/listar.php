<?php
// CORS Headers - Allow requests from any origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$host = "localhost";
$user = "root"; // Seu usuário do MySQL
$password = ""; // Senha do MySQL (se tiver)
$dbname = "imobiliaria";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Set character set to handle special characters
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    die(json_encode(["erro" => "Falha na conexão com o banco de dados: " . $conn->connect_error]));
}

// Query to get all corretores
$sql = "SELECT id, name, cpf, creci FROM corretores";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    http_response_code(500); // Internal Server Error
    die(json_encode(["erro" => "Erro na consulta: " . $conn->error]));
}

$corretores = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $corretores[] = $row;
    }
}

// Return data as JSON
echo json_encode($corretores);
$conn->close();
?>