<?php

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MeuLogger
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger('meu-app');
        $this->logger->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
    }

    public function logInfo($mensagem){
        $this->logger->info($mensagem);
    }

    public function logError($mensagem){
        $this->logger->error($mensagem);
    }
}

//$logger = new MeuLogger();
//$logger->logError('Erro na conexão com o banco.');
//$logger->logInfo('Aplicação iniciada.');