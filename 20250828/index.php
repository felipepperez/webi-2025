<?php
session_start();

include_once("utils.php");

$products = loadProducts();

$message = "";
$categoria_filtro = $_COOKIE["categoria_filtro"] ?? 'todas';
$username = $_SESSION["username"] ?? '';

$carrinho = $_SESSION['carrinho'] ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    if (isset($_POST['filter'])) {
        $categoria_filtro = $_POST['categoria_filtro'];
        setcookie('categoria_filtro', $categoria_filtro, time() + 86400, '/');
        $message = "Filtro de categoria salvo!";
    }

    if (isset($_POST["add-cart"])) {
        $produto_id = $_POST["produto_id"];
        $produto_selecionado = encontrarProdutoPorId($products, $produto_id);

        if ($produto_selecionado) {
            if (isset($carrinho[$produto_id])) {
                $carrinho[$produto_id]['quantidade']++;
            } else {
                $carrinho[$produto_id] = [
                    'id' => $produto_id,
                    'nome' => $produto_selecionado['nome'],
                    'preco' => $produto_selecionado['preco'],
                    'quantidade' => 1
                ];
            }
            $_SESSION['carrinho'] = $carrinho;
            $message = "Produto adicionao ao carrinho";
        }
    }

    if (isset($_POST["remove-cart"])) {
        $produto_id = $_POST["produto_id"];
        if (isset($carrinho[$produto_id])) {
            unset($carrinho[$produto_id]);
            $_SESSION['carrinho'] = $carrinho;
            $message = "Produto removido do carrinho";
        } else {
            $message = "Item não encontrado no carrinho";
        }
    }

    if(isset($_POST["clear-cart"])) {
        unset($_SESSION["carrinho"]);
        $carrinho = [];
        $message = " Carrinho foi limpo!";
    }
}

$produtos_filtrados = $products;
if ($categoria_filtro !== 'todas') {
    $produtos_filtrados = array_filter($products, function ($product) use ($categoria_filtro) {
        return $product['categoria'] == $categoria_filtro;
    });
}

$categorias = array_unique(array_column($products, 'categoria'));
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
            <div class="carrinho-section">
                <h2>Carrinho</h2>

                <?php if (empty($carrinho)): ?>
                    <p>Carrinho vazio. Adicione produtos!</p>
                <?php else:
                    $total_cart = 0;
                    ?>
                    <?php foreach ($carrinho as $item):
                        $total_cart += $item['preco'] * $item['quantidade'];
                        ?>
                        <div class="carrinho-item">
                            <div class="item-info">
                                <div class="item-nome"><?= htmlspecialchars($item['nome']) ?></div>
                                <div class="item-detalhes">
                                    Qtd: <?= $item['quantidade']; ?> x
                                    R$<?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?>
                                </div>
                            </div>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="produto_id" value="<?= $item['id'] ?>">
                                <button type="submit" name="remove-cart" class="btn btn-danger">Remover</button>
                            </form>
                        </div>
                    <?php endforeach; ?>

                    <div class="carrinho-total">
                        Total: R$<?= number_format($total_cart, 2, ',', '.') ?>
                    </div>

                    <div style="margin-top: 15px;">
                        <form method="post" style="display: inline;">
                        <button type="submit" name="clear-cart" class="btn btn-danger">Limpar Carrinho</button>
                        </form>
                    </div>

                <?php endif; ?>
            </div>
            <div class="produtos-section">
                <h2>Produtos Disponíveis</h2>

                <div class="filtro">
                    <form method="POST">
                        <label for="categoria_filtro">Filtrar por categoria:</label>
                        <select name="categoria_filtro" id="categoria_filtro">
                            <option value="todas" <?= $categoria_filtro === 'todas' ? 'selected' : '' ?>>Todas as
                                categorias</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria ?>" <?= $categoria_filtro === $categoria ? 'selected' : '' ?>>
                                    <?= $categoria ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="filter" class="btn btn-primary">Aplicar Filtro</button>
                    </form>
                </div>
                <div class="produtos-grid">
                    <?php foreach ($produtos_filtrados as $product): ?>
                        <div class="produto-card">
                            <div class="produto-nome"><?= htmlspecialchars($product["nome"]) ?></div>
                            <div class="produto-categoria"><?= htmlspecialchars($product["categoria"]) ?></div>
                            <div class="produto-preco"><?= number_format($product["preco"], 2, ',', '.') ?></div>
                            <form method="post">
                                <input type="hidden" name="produto_id" value="<?= $product["id"] ?>">
                                <button type="submit" name="add-cart" class="btn btn-primary">Adicionar ao Carrinho</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>