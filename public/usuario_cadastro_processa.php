<?php

require_once "../infra/conexao.php";

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");

if ($nome === "" || $email === "") {
    die("Preencha todos os campos.");
}

$sql = "INSERT INTO usuario (nome, email) VALUES (?, ?)";

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar cadastro: " . $conexao->error);
}

$stmt->bind_param("ss", $nome, $email);

if ($stmt->execute()) {
    echo "Usuário cadastrado com sucesso!";
    echo "<br><a href='usuario_cadastro.php'>Cadastrar outro usuário</a>";
} else {
    echo "Erro ao cadastrar usuário: " . $stmt->error;
}

$stmt->close();
$conexao->close();