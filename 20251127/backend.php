<?php
header("Content-Type: application/json; charset=utf-8");

// Criar ou abrir banco SQLite
$db = new PDO("sqlite:banco.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Criar tabela se não existir
$db->exec("
    CREATE TABLE IF NOT EXISTS produtos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        preco REAL NOT NULL,
        categoria TEXT NOT NULL
    )
");

$acao = $_GET['acao'] ?? '';

$post = json_decode(file_get_contents("php://input"), true);

var_dump($post);
var_dump($_GET);
