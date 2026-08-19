<?php

require_once "../infra/conexao.php";

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

if ($nome === "" || $email === "" || $senha === "") {
    die("Preencha todos os campos.");
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (nome, email, senha)
        VALUES (?, ?, ?)";

$stmt = $conexao->prepare($sql);

$stmt->bind_param(
    "sss",
    $nome,
    $email,
    $senhaHash
);

$stmt = $conexao->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar cadastro: " . $conexao->error);
}

$stmt->bind_param("sss", $nome, $email, $senhaHash);

if (!$stmt->execute()) {
    die("Erro ao cadastrar usuário: " . $stmt->error);
}

header("Location: ../login.php");
exit;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   
<h1>Cadastrar usuário</h1>

<form action="cadastrar_usuario.php" method="POST">

    <label>Nome:</label>
    <input type="text" name="nome" required>

    <br><br>

    <label>E-mail:</label>
    <input type="email" name="email" required>

    <br><br>

    <label>Senha:</label>
    <input type="password" name="senha" required>

    <br><br>

    <button type="submit">Cadastrar</button>

</form>

</body>
</html>

