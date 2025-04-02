<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");



$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data["name"]) && !empty($data["cpf"]) && !empty($data["creci"])) {
    $name = $conn->real_escape_string($data["name"]);
    $cpf = $conn->real_escape_string($data["cpf"]);
    $creci = $conn->real_escape_string($data["creci"]);

    $sql = "INSERT INTO corretores (name, cpf, creci) VALUES ('$name', '$cpf', '$creci')";
    
    if ($conn->query($sql)) {
        echo json_encode(["message" => "Corretor cadastrado com sucesso"]);
    } else {
        echo json_encode(["error" => "Erro ao cadastrar corretor: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Dados incompletos"]);
}
?>
