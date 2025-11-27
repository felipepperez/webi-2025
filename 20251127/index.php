<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Prova PHP</title>
</head>
<body>
    <h2>Cadastro de Produtos</h2>

    <form id="form">
        <input type="hidden" id="id">
        
        <label>Nome:</label>
        <input type="text" id="nome" required><br><br>

        <label>Preço:</label>
        <input type="number" id="preco" required><br><br>

        <label>Categoria:</label>
        <input type="text" id="categoria" required><br><br>

        <button type="submit">Salvar</button>
    </form>

    <hr>

    <h3>Lista de Produtos</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="lista"></tbody>
    </table>

<script>
const API = "20251127/backend.php"; // ajustar se necessário

async function carregar() {
    const res = await fetch(API + "?acao=listar");
    const dados = await res.json();

    const tbody = document.getElementById("lista");
    tbody.innerHTML = "";

    dados.forEach(prod => {
        tbody.innerHTML += `
            <tr>
                <td>${prod.id}</td>
                <td>${prod.nome}</td>
                <td>${prod.preco}</td>
                <td>${prod.categoria}</td>
                <td>
                    <button onclick='editar(${JSON.stringify(prod)})'>Editar</button>
                    <button onclick="excluir(${prod.id})">Excluir</button>
                </td>
            </tr>
        `;
    });
}

function editar(p) {
    document.getElementById("id").value = p.id;
    document.getElementById("nome").value = p.nome;
    document.getElementById("preco").value = p.preco;
    document.getElementById("categoria").value = p.categoria;
}

async function excluir(id) {
    await fetch(API + "?acao=excluir&id=" + id);
    carregar();
}

document.getElementById("form").addEventListener("submit", async (e) => {
    e.preventDefault();

    const dados = {
        id: document.getElementById("id").value,
        nome: document.getElementById("nome").value,
        preco: document.getElementById("preco").value,
        categoria: document.getElementById("categoria").value,
    };

    await fetch(API + "?acao=salvar", {
        method: "POST",
        body: JSON.stringify(dados)
    });

    e.target.reset();
    carregar();
});

carregar();
</script>

</body>
</html>
