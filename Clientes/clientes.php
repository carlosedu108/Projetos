<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Senha em branco por padrão no XAMPP
$dbname = "cadastro_clientes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $cpf_cnpj = $_POST["cpf_cnpj"];

    // Prepared statement
    $stmt = $conn->prepare("INSERT INTO clientes (nome, sobrenome, email, telefone, endereco, cpf_cnpj) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $sobrenome, $email, $telefone, $endereco, $cpf_cnpj);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
        echo "<form action='clientes.html'><input type='submit' value='Voltar para Clientes'></form>";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>