<?php

include "../infra/conexao.php";

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];


$sql = "INSERT INTO prato (nome,descricao,preco,categoria) VALUES ('$nome','$descricao','$preco','$categoria')";

mysqli_query($conexao, $sql);

header("Location: ../index.php");
?>