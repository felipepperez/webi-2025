<?php

if (extension_loaded("pdo") && extension_loaded("pdo_mysql")) {
    echo "PDO e PDO_MYSQL estão habilitadas";
} else {
    echo "Extensões não encontradas";
}

include("config/database.php");

$database = new Database();

echo "<br>";

//$database->create('usuarios', ["nome" => "Felipe Perez", "email" => "felipe1@perez.com", "idade" => "35", "cidade" => "Dourados"]);

//$database->read("usuarios", [],3,9);

//$database->delete("usuarios", ["idade" => 25]);

var_dump($database->update("usuarios",["nome"=>"Felipe Pereira Perez"]));