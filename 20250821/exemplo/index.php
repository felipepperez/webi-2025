<?php

function carregaUsuarios($arquivo)
{
    if (file_exists($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        return json_decode($conteudo, true) ?: [];
    }
    return [];
}

function salvarUsuarios($arquivo, $usuarios)
{
    $json = json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($arquivo, $json) !== false;
}

$arquivo = 'usuarios.json';

$usuarios = carregaUsuarios($arquivo);

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $idade = $_POST['idade'] ?? '';

    if ($nome && $email && $idade) {
        $novo_id = count($usuarios) + 1;
        $usuarios[] = [
            'id' => $novo_id,
            'nome' => $nome,
            'email' => $email,
            'idade' => $idade
        ];
        if (salvarUsuarios($arquivo, $usuarios)) {
            $message = "Usuário cadastrado com sucesso!";
        } else {
            $message = "Erro ao salvar usuário!";
        }
    } else {
        $message = "Todos os campos são obrigatórios!";
    }
}

$termo_busca = $_GET['busca'] ?? '';
$usuarios_filtrados = $usuarios;


if ($termo_busca) {
    $usuarios_filtrados = array_filter($usuarios, function ($usuario) use ($termo_busca) {
        return stripos($usuario["nome"], $termo_busca) !== false || stripos($usuario["email"], $termo_busca) !== false;
    });
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="exemplo/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Sistema de Usuários</h1>
        </div>
        <div class="content">
            <?php if ($message): ?>
                <div class="mensagem <?= strpos($message, 'sucesso') !== false ? '' : 'erro' ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            <div class="section">
                <h2>Cadastro de usuário</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="idade">Idade:</label>
                        <input type="number" id="idade" name="idade" min="1" max="120" required>
                    </div>
                    <button type="submit" class="btn">Cadastrar Usuário</button>
                </form>
            </div>
            <div class="section">
                <h2>Lista de Usuários</h2>

                <div class="busca">
                    <form method="GET" action="">
                        <input type="text" name="busca" value="<?= htmlspecialchars($termo_busca) ?>"
                            placeholder="Digite nome ou email para buscar..." required>
                        <button type="submit" class="btn">Buscar</button>
                        <a href="exemplo" class="btn btn-secondary">Limpar</a>
                    </form>
                </div>

                <table class="tabela">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Idade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios_filtrados as $usuario): ?>
                            <tr>
                                <td><?= $usuario['id'] ?></td>
                                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><?= $usuario['idade'] ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>