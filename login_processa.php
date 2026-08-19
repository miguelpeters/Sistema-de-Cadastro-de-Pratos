<?php

session_start();

require_once "infra/conexao.php";

$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

if ($email === "" || $senha === "") {
    die("Informe e-mail e senha.");
}

$sql = "SELECT id_usuario, nome, email, senha
        FROM usuario
        WHERE email = ?";

$stmt = $conexao->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar login: " . $conexao->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows !== 1) {
    die("E-mail ou senha inválidos.");
}

$usuario = $resultado->fetch_assoc();

if (!password_verify($senha, $usuario["senha"])) {
    die("E-mail ou senha inválidos.");
}

$_SESSION["id_usuario"] = $usuario["id_usuario"];
$_SESSION["nome_usuario"] = $usuario["nome"];
$_SESSION["email_usuario"] = $usuario["email"];

header("Location: index.php");
exit;