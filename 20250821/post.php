<?php
$formulario_enviado = false;
$nome = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formulario_enviado = true;
    $nome = $_POST["nome"] ?? "Não informado";
    $email = $_POST["email"] ?? "Não informado";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula - Váriaveis Super Globais</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="conceito">
        <h2>$_POST - Dados de Formulários</h2>
        <div class="explicacao">
            <p>A váriavel <code>$_POST</code> contém todos os dados enviados via formulário (método POST).</p>
            <p>Diferente do GET, os dados não aparecem na URL e são mais seguros.</p>
        </div>

        <div class="formulario">
            <h4>Formulário de Exemplo:</h4>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" required>
                </div>
                <button type="submit" class="btn">Enviar Dados</button>
            </form>
        </div>

        <?php if ($formulario_enviado): ?>
            <div class="resultado">
                <h4>Dados recebidos via $_POST:</h4>
                <p><strong>Nome: </strong><?= htmlspecialchars(($nome)) ?></p>
                <p><strong>Email: </strong><?= htmlspecialchars(($email)) ?></p>
            </div>
        <?php endif; ?>
    </div>

    <?php
    require("server.php");
    ?>
</body>

</html>