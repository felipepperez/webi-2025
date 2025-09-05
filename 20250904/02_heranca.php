<?php
abstract class Animal
{
    protected $nome;
    protected $idade;
    protected $especie;

    protected $dormir;

    protected $comer;

    public function __construct($nome, $idade, $especie)
    {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->especie = $especie;
        $this->comer = false;
        $this->dormir = false;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getIdade()
    {
        return $this->idade;
    }
    public function getEspecie()
    {
        return $this->especie;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
    }
    public function setEspecie($especie)
    {
        $this->especie = $especie;
    }

    public function comer()
    {
        $this->comer = true;
        $this->dormir = false;
    }

    public function dormir()
    {
        $this->comer = false;
        $this->dormir = true;
    }

    public function pararDeComer()
    {
        $this->comer = false;
    }

    public function acordar()
    {
        $this->dormir = false;
    }

    /* public function estado()
    {
        if ($this->comer) {
            return "{$this->nome} está comendo!";
        }
        if ($this->dormir) {
            return "{$this->nome} está dormindo!";
        }
        return "{$this->nome} está acordado e não está comendo!";
    } */

    abstract public function estado();
}

class Cachorro extends Animal
{
    private $raca;

    private $latindo;

    public function __construct($nome, $idade, $raca)
    {
        parent::__construct($nome, $idade, "Cachorro");
        $this->raca = $raca;
        $this->latindo = false;
    }

    public function getRaca()
    {
        return $this->raca;
    }

    public function setRaca($raca)
    {
        $this->raca = $raca;
    }

    public function latir()
    {
        $this->latindo = true;
        parent::acordar();
        parent::pararDeComer();
    }

    public function pararlatir()
    {
        $this->latindo = false;
    }

    public function estado()
    {
        $estado = $this->latindo ? "E está latindo!" : "E não está latindo";
        if ($this->comer) {
            return "{$this->nome} está comendo! " . $estado;
        }
        if ($this->dormir) {
            return "{$this->nome} está dormindo! " . $estado;
        }
        return "{$this->nome} está acordado e não está comendo! " . $estado;
    }
}

echo "<h2>Exemplo de Herança</h2>";
$cachorro = new Cachorro("Rex", 3, "Pastor Alemão");

echo "<h3>Animais:<h3>";
$cachorro->dormir();
echo "<p>{$cachorro->estado()}</p>";
$cachorro->acordar();
echo "<p>{$cachorro->estado()}</p>";
$cachorro->comer();
echo "<p>{$cachorro->estado()}</p>";
$cachorro->latir();
echo "<p>{$cachorro->estado()}</p>";

