<?php
function loadProducts()
{
    $arquivo = "products.json";
    if (file_exists($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        return json_decode($conteudo, true) ?: [];
    }
    return [];
}

function encontrarProdutoPorId($produtos, $id)
{
    foreach ($produtos as $produto) {
        if ($produto["id"] == $id) {
            return $produto;
        }
    }
    return null;
}