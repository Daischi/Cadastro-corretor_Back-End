<?php
include_once '../conexao.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Captura os dados enviados pelo PUT corretamente
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica se os dados necessários foram enviados
    if (!isset($data['id'], $data['cpf'], $data['creci'], $data['name'])) {
        echo json_encode(["error" => "Dados incompletos"]);
        http_response_code(400);
        exit;
    }

    // Preenche as variáveis e remove pontos e traços do CPF
    $id = $data['id'];
    $cpf = preg_replace('/\D/', '', $data['cpf']); // Remove tudo que não for número
    $creci = $data['creci'];
    $name = $data['name'];

    // Prepara a query SQL
    $stmt = $conn->prepare("UPDATE corretores SET cpf = ?, creci = ?, name = ? WHERE id = ?");
    $stmt->bind_param("sssi", $cpf, $creci, $name, $id);

    // Executa e verifica se houve sucesso
    if ($stmt->execute()) {
        echo json_encode(["message" => "Registro atualizado com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao atualizar!", "mysql_error" => $stmt->error]);
        http_response_code(500);
    }

    // Fecha o statement
    $stmt->close();
}

// Fecha a conexão com o banco
$conn->close();
