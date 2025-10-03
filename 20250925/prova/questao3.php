<?php
$nome = "";
$idade = "";

if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["nome"]) && isset($_POST["idade"])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if ($nome != "" & $idade != ""): ?>
        <h1><?= $nome ?> tem <?= $idade ?> anos</h1>
    <?php else: ?>
        <h1>Parâmetros incorretos.</h1>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nome">
        <input type="number" name="idade">
        <button type="submit">Enviar</button>
    </form>
</body>

</html>