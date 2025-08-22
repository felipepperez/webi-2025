<div class="conceito">
    <h2>$_SERVER - Informações do Servidor</h2>
    <div class="explicacao">
        <p>A váriavel <code>$_SERVER</code> contém Informações sobre o servidor web e a requisição atual</p>
    </div>
    <div class="grid">
        <div class="card">
            <h3>Informações da Requisição</h3>
            <p><strong>Método PHP: </strong> <?= $_SERVER['REQUEST_METHOD'] ?></p>
            <p><strong>Protocolo: </strong> <?= $_SERVER['SERVER_PROTOCOL'] ?></p>
            <p><strong>URL atual: </strong> <?= $_SERVER['REQUEST_URI'] ?></p>
            <p><strong>Script: </strong> <?= $_SERVER['SCRIPT_NAME'] ?></p>
        </div>
        <div class="card">
            <h3>Informações do Servidor</h3>
            <p><strong>Servidor: </strong> <?= $_SERVER['SERVER_NAME'] ?></p>
            <p><strong>Porta: </strong> <?= $_SERVER['SERVER_PORT'] ?></p>
            <p><strong>Versão do PHP: </strong> <?= PHP_VERSION ?></p>
        </div>
        <div class="card">
            <h3>Informações do Cliente</h3>
            <p><strong>IP do Cliente: </strong> <?= $_SERVER['REMOTE_ADDR'] ?></p>
            <p><strong>User Agent: </strong> <?= $_SERVER['HTTP_USER_AGENT'] ?></p>
        </div>
    </div>
</div>