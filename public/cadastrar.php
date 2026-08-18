<?php

require_once "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
}

$nome = trim($_POST["nome"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");
$preco = $_POST["preco"] ?? "";
$categoria = trim($_POST["categoria"] ?? "");

if ($nome === "" || $descricao === "" || $preco === "" || $categoria === "") {
    die("Todos os campos são obrigatórios.");
}

$sql = "INSERT INTO prato (nome, descricao, preco, categoria)
        VALUES (?, ?, ?, ?)";

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar cadastro: " . $conexao->error);
}

$stmt->bind_param(
    "ssds",
    $nome,
    $descricao,
    $preco,
    $categoria
);

if (!$stmt->execute()) {
    die("Erro ao cadastrar prato: " . $stmt->error);
}

$stmt->close();
$conexao->close();

header("Location: ../index.php");
exit;