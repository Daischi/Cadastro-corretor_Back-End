<?php
$host = "localhost";
$user = "root";  // Coloque o usuário do MySQL
$password = "";  // Se houver senha no MySQL, coloque aqui
$dbname = "imobiliaria";  // Certifique-se de que esse banco existe

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

echo "Conexão bem-sucedida!";
?>
