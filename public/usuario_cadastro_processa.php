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
    die("Erro ao preparar o cadastro: " . $conexao->error);
}

$stmt->bind_param("ss", $nome, $email);

if ($stmt->execute()) {
    header("Location: ../index.php");
    exit;
} else {
    die("Erro ao cadastrar usuário: " . $stmt->error);
}

$stmt->close();
$conexao->close();