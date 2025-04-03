<?php
include_once __DIR__ . '/../conexao.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados brutos do JSON
    $dados = json_decode(file_get_contents("php://input"), true);

    // Verifica se os campos existem
    if (isset($dados['cpf'], $dados['creci'], $dados['name'])) {
        // Remove pontos e traços do CPF
        $cpf = preg_replace('/\D/', '', $dados['cpf']);
        $creci = $dados['creci'];
        $name = $dados['name'];

        $stmt = $conn->prepare("INSERT INTO corretores (cpf, creci, name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $cpf, $creci, $name);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Cadastro realizado com sucesso!"]);
        } else {
            echo json_encode(["error" => "Erro ao cadastrar!", "mysql_error" => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Campos obrigatórios não preenchidos!"]);
    }
}
$conn->close();
