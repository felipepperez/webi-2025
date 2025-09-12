<?php
session_start();

if (!isset($_SESSION['animais'])) {
    $_SESSION['animais'] = [];
}

$mensagem = "";
$tipo_mensagem = "";

$tipos_animais = ['Cachorro', 'Gato', "Pássaro", "Peixe", "Hamster", "Jacaré"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'inserir':
                if (!empty($_POST['nome']) && !empty($_POST['especie']) && !empty($_POST['idade'])) {
                    if (array_search($_POST['especie'], $tipos_animais)) {
                        $novo_animal = [
                            'id' => uniqid(),
                            'nome' => $_POST['nome'],
                            'especie' => $_POST['especie'],
                            'idade' => $_POST['idade']
                        ];

                        $_SESSION['animais'][] = $novo_animal;

                        $mensagem = "Animal inserido com sucesso!";
                        $tipo_mensagem = "sucesso";
                    } else {
                        $mensagem = "Espécie invalida!";
                        $tipo_mensagem = "erro";
                    }
                } else {
                    $mensagem = "Preencha todos os campos obrigatórios!";
                    $tipo_mensagem = "erro";
                }
                break;

            case 'excluir':
                if (!empty($_POST['id'])) {
                    foreach ($_SESSION['animais'] as $key => $animal) {
                        if ($animal['id'] === $_POST['id']) {
                            unset($_SESSION['animais'][$key]);
                            $_SESSION['animais'] = array_values($_SESSION['animais']);

                            $mensagem = "Animal excluido com sucesso!";
                            $tipo_mensagem = "sucesso";
                            break;
                        }
                    }
                }
                break;
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <?php if ($mensagem): ?>
                <div class="mensagem <?= $tipo_mensagem ?>">
                    <?= $mensagem ?>
                </div>
            <?php endif; ?>
            <h2>Inserir Novo Animal</h2>
            <form method="POST">
                <input type="hidden" name="acao" value="inserir">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="especie">Espécie</label>
                    <select id="especie" name="especie" required>
                        <option value="">Selecione uma espécie</option>
                        <?php foreach ($tipos_animais as $key => $value): ?>
                            <option value="<?= $value ?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="idade">Idade</label>
                    <input type="number" id="idade" name="idade" min="0" max="50" required>
                </div>
                <button type="submit" class="btn btn-success">Inserir Animal</button>
            </form>
        </div>

        <h2>Lista de Animais</h2>
        <?php if (empty($_SESSION['animais'])): ?>
            <p>Nenhum anima cadastrado ainda.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Idade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['animais'] as $animal): ?>
                        <tr>
                            <td><?= htmlspecialchars($animal['nome']); ?></td>
                            <td><?= htmlspecialchars($animal['especie']); ?></td>
                            <td><?= htmlspecialchars($animal['idade']); ?></td>
                            <td class="acoes">
                                <form method="POST" class="form-inline">
                                    <input type="hidden" name="acao" value="excluir">
                                    <input type="hidden" name="id" value="<?= $animal['id']; ?>">
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>