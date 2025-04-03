<?php
include_once '../conexao.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data['id'])) {
        echo json_encode(["error" => "ID não fornecido!"]);
        exit;
    }

    $id = $data['id'];

    $stmt = $conn->prepare("DELETE FROM corretores WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Registro excluído com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao excluir!"]);
    }
    
    $stmt->close();
}

$conn->close();