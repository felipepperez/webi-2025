<?php 
    $parametro_get = $_GET['parametro'] ?? 'Nenhum parâmetro GET recebido';
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
        <h2>$_GET - Parâmetro na URL</h2>
        <div class="explicacao">
            <p>A váriavel <code>$_GET</code> contém todos os parâmetros enviados via URL (método GET).</p>
            <p>Exemplo: <code>pagina.php?nome=Jo"ao&idade=25</code></p>
        </div>

        <div class="links">
            <p><strong>Teste os links abaixo:</strong></p>
            <a href="?parametro=olá_mundo" class="link-exemplo">?parametro=olá_mundo</a>
            <a href="?parametro=<?= urlencode('valor com espaços') ?>" class="link-exemplo">?parametro=valor com espaços</a>
            <a href="?parametro=123&outro=dados" class="link-exemplo">?parametro=123&outro=dados</a>
            <a href="?" class="link-exemplo">Limpar parâmetros</a>
        </div>

        <div class="resultado">
            <h4>Parâmetro GET Atual:</h4>
            <p><strong>Valor: </strong><?= htmlspecialchars($parametro_get) ?></p>
        </div>
    </div>

    <?php
    require("server.php");
    ?>
</body>

</html>