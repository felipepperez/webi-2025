<?php

class Pessoa {
    private $nome;
    private $idade;
    private $email;

    public function __construct($nome, $idade, $email){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->email = $email;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getIdade(){
        return $this->idade;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setIdade($idade){
        $this->idade = $idade;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function apresentar(){
        return "Olá, eu sou {$this->nome}, tenho {$this->idade} anos e meu email é {$this->email}";
    }

    public function fazerAniversario(){
        $this->idade++;
        return "Parabéns! Agora tenho {$this->idade} anos";
    }

}

echo "<h2>Exemplo de Classes e Objetos</h2>";

$pessoa1 = new Pessoa("João Silva", 25, "joao@silva.com");
$pessoa2 = new Pessoa("Maria Santos",30, "maria@santos.com");

echo "<h3>Pessoas:<h3>";

echo "<p>{$pessoa1->apresentar()}</p>";
echo "<p>{$pessoa2->apresentar()}</p>";


echo "<p>{$pessoa2->fazerAniversario()}</p>";

echo "<p>{$pessoa2->apresentar()}</p>";

