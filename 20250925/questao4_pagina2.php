<?php

session_start();

$usuario = "";

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
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
    <?php if ($usuario != ""): ?>
        <h1>Sessão ativa para o usuario <?= $usuario ?></h1>
    <?php else: ?>
        <h1>Sessão não ativa.</h1>
    <?php endif; ?>
</body>

</html>