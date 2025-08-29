<?php
session_start();

include_once("utils.php");

$products = loadProducts();

$message = "";
$username = $_SESSION["username"] ?? '';

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    if ($username) {
        $_SESSION['username'] = $username;
        $message = "Bem-vindo, $username";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    $username = "";
    $message = 'Logout realizado!';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie e Session</title>
    <link rel="stylesheet" href="/20250828/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Loja Online</h1>
            </div>
            <div class="user-info">
                <?php if ($username): ?>
                    <p><strong>Olá. <?= htmlspecialchars($username); ?>!</strong></p>
                    <form method="POST" style="display: inline;">
                        <button type="submit" name="logout" class="btn btn-danger">Sair</button>
                    </form>
                <?php else: ?>
                    <form method="POST" class="login-form">
                        <input type="text" name="username" placeholder="Seu nome" required>
                        <button type="submit" name="login" class="btn btn-success">Entrar</button>
                    </form>
                <?php endif; ?>

            </div>
        </div>

        <?php if ($message): ?>
            <div class="mensagem">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="grid">
            <div class="produtos-section">
                <h2>Produtos Disponíveis</h2>

                <div class="produtos-grid">
                    <?php foreach ($products as $product): ?>
                        <div class="produto-card">
                            <div class="produto-nome"><?= htmlspecialchars($product["nome"]) ?></div>
                            <div class="produto-categoria"><?= htmlspecialchars($product["categoria"]) ?></div>
                            <div class="produto-preco"><?= number_format($product["preco"], 2, ',', '.') ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>