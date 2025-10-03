<?php

require_once 'vendor/autoload.php';

require 'Logger.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MeuHttpClient
{
    private $client;
    private $logger;

    public function __construct()
    {
        $this->logger = new MeuLogger();
        $this->client = new Client([
            'verify' => false,
            'timeout' => 30
        ]);
    }

    public function buscarDados($url)
    {
        try {
            $response = $this->client->get($url);
            $json = json_decode($response->getBody(), true);
            $this->logger->logInfo('Foi possível chamar a url ' . $url);
            return $json;
        } catch (RequestException $e) {
            echo "Erro na requisição: " . $e->getMessage();
            $this->logger->logError('Não Foi possível chamar a url ' . $url);
            return null;
        }
    }
}


$httpClient = new MeuHttpClient();
$dados = $httpClient->buscarDados('https://viacep.com.br/ws/79823590/json/');
print_r($dados);