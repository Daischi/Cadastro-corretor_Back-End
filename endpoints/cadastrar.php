<?php
include_once __DIR__ . '/../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados brutos do JSON
    $dados = json_decode(file_get_contents("php://input"), true);

    // Verifica se os campos existem
    if (isset($dados['cpf'], $dados['creci'], $dados['name'])) {
        $cpf = $dados['cpf'];
        $creci = $dados['creci'];
        $name = $dados['name'];

        $stmt = $conn->prepare("INSERT INTO corretores (cpf, creci, name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $cpf, $creci, $name);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Cadastro realizado com sucesso!"]);
        } else {
            echo json_encode(["error" => "Erro ao cadastrar!"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Campos obrigatórios não preenchidos!"]);
    }
}
$conn->close();
