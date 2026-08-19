<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
</head>

<body>

    <h1>Cadastrar Usuário</h1>

    <form action="usuario_cadastro_processa.php" method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label>E-mail:</label>
        <input type="email" name="email" required>

        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

    <br>

    <a href="index.php">Voltar</a>

</body>

</html>