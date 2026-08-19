<?php
session_start();
?>

<?php if (isset($_SESSION["id_usuario"])): ?>

    <p>
        Olá,
        <strong>
            <?= htmlspecialchars($_SESSION["nome_usuario"]) ?>
        </strong>
    </p>

    <a href="logout.php">Sair</a>

<?php else: ?>

    <a href="login.php">Entrar</a>

<?php endif; ?>

<?php

require_once "infra/conexao.php";

$sql = "SELECT id, nome, descricao, preco, categoria
        FROM prato
        ORDER BY id DESC";

$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro ao buscar pratos: " . $conexao->error);
}

$sql = "
    SELECT
        prato.id,
        prato.nome,
        prato.descricao,
        prato.preco,
        prato.categoria,
        usuario.nome AS nome_usuario
    FROM prato
    INNER JOIN usuario
        ON prato.id_usuario = usuario.id_usuario
    ORDER BY prato.id DESC
";
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Pratos</title>

    <link rel="stylesheet" href="style/styles.css">

</head>

<body>

    <header>
        <h1>Sistema de Cadastro de Pratos</h1>
    </header>

    <main>

        <section>

            <h2>Adicione um novo prato!</h2>

            <form action="public/cadastrar.php" method="POST">

                <label for="nome">Nome:</label>

                <input type="text" id="nome" name="nome" required>

                <br>

                <label for="descricao">Descrição:</label>

                <input type="text" id="descricao" name="descricao" required>

                <br>

                <label for="preco">Preço:</label>

                <input type="number" id="preco" name="preco" step="0.01" min="0" required>

                <br>

                <label for="categoria">Categoria:</label>

                <input type="text" id="categoria" name="categoria" required>

                <br>

                <?php while ($prato = $resultado->fetch_assoc()): ?>

                    <div class="prato">

                        <h2><?= htmlspecialchars($prato["nome"]) ?></h2>

                        <p><?= htmlspecialchars($prato["descricao"]) ?></p>

                        <p>R$ <?= htmlspecialchars($prato["preco"]) ?></p>

                        <p>
                            Cadastrado por:
                            <strong><?= htmlspecialchars($prato["nome_usuario"]) ?></strong>
                        </p>

                    </div>

                <?php endwhile; ?>

                <button type="submit">
                    Cadastrar
                </button>

            </form>

        </section>


        <section>

            <h2>Pratos cadastrados</h2>

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>

                </thead>

                <tbody>

                    <?php while ($prato = $resultado->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($prato["id"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($prato["nome"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($prato["descricao"]) ?>
                            </td>

                            <td>
                                R$
                                <?= number_format(
                                    $prato["preco"],
                                    2,
                                    ",",
                                    "."
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($prato["categoria"]) ?>
                            </td>

                            <td>

                                <a href="public/editar.php?id=<?= $prato["id"] ?>">
                                    Editar
                                </a>

                                |

                                <a href="public/excluir.php?id=<?= $prato["id"] ?>"
                                    onclick="return confirm('Tem certeza que deseja excluir este prato?')">
                                    Excluir
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </section>

    </main>

</body>

</html>

<?php
$conexao->close();
?>