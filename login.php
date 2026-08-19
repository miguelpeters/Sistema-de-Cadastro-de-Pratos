<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

    <h1>Login</h1>

    <form action="login_processa.php" method="POST">

        <label>E-mail:</label>

        <input type="text" name="email" required>

        <br><br>

        <label>Senha:</label>

        <input type="password" name="senha" required>

        <br><br>

        <button type="submit">
            Entrar
        </button>
    </form>

    <br>

    

</body>

</html>