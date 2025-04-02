<?php
header("Content-Type: application/json"); // Define JSON na resposta

$host = "localhost";
$user = "root"; // Seu usuário do MySQL
$password = ""; // Senha do MySQL (se tiver)
$dbname = "imobiliaria";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["erro" => "Falha na conexão com o banco de dados"]));
}

$sql = "SELECT id, name, cpf, creci FROM corretores";
$result = $conn->query($sql);

$corretores = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $corretores[] = $row;
    }
}

echo json_encode($corretores); // Retorna SOMENTE o JSON
$conn->close();
?>
