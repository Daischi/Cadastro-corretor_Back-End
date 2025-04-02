<?php
include_once '../conexao.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'];
    $cpf = $_PUT['cpf'];
    $creci = $_PUT['creci'];
    $name = $_PUT['name'];
    
    $stmt = $conn->prepare("UPDATE corretores SET cpf = ?, creci = ?, name = ? WHERE id = ?");
    $stmt->bind_param("sssi", $cpf, $creci, $name, $id);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Registro atualizado com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao atualizar!"]);
    }
    
    $stmt->close();
}
$conn->close();
