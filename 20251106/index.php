<?php

$pdo_sqlite_loaded = extension_loaded('pdo_sqlite');
$sqlite3_loaded = extension_loaded('sqlite3');

$pdo_drivers = PDO::getAvailableDrivers();
$connection_test = false;
$connection_error = '';

try {
    $test_pdo = new PDO('sqlite::memory:');
    $connection_test = true;
    $test_pdo = null;
} catch (PDOException $e) {
    $connection_error = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        .form-section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background: #0056b3;
        }

        .btn-edit {
            background: #28a745;
            padding: 5px 15px;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background: #218838;
        }

        .btn-delete {
            background: #dc3545;
            padding: 5px 15px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:hover {
            background: #f5f5f5;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-section {
            background: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .status-section h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .status-item {
            margin-bottom: 10px;
            padding: 8px;
            background: white;
            border-radius: 4px;
        }

        .status-ok {
            color: #28a745;
            font-weight: bold;
        }

        .status-error {
            color: #dc3545;
            font-weight: bold;
        }

        .status-list {
            margin-top: 10px;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="status-session">
            <div class="status-item">
                PDO SQLite:
                <span class="<?= $pdo_sqlite_loaded ? 'status-ok' : 'status-error' ?>">
                    <?= $pdo_sqlite_loaded ? '✓ Carregado' : '✗ Não carregado' ?>
                </span>
            </div>
            <div class="status-item">
                SQLite3:
                <span class="<?= $sqlite3_loaded ? 'status-ok' : 'status-error' ?>">
                    <?= $sqlite3_loaded ? '✓ Carregado' : '✗ Não carregado' ?>
                </span>
            </div>
            <div class="status-item">
                Teste de conexão:
                <span class="<?= $connection_test ? 'status-ok' : 'status-error' ?>">
                    <?= $connection_test ? '✓ Conexão bem-sucedida' : '✗ Erro: ' . htmlspecialchars($connection_error) ?>
                </span>
            </div>
            <div class="status-item">
                PDO Drivers Disponíveis:
                <div class="status-list">
                    <?php if (!empty($pdo_drivers)): ?>
                        <?php foreach ($pdo_drivers as $driver): ?>
                            <span class="status-ok"><?= htmlspecialchars($driver) ?></span> 
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="status-error">Nenhum driver PDO Disponivel</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>