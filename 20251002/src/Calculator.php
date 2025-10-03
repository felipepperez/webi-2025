<?php

namespace App;

class Calculator
{

    public function add($a, $b)
    {
        return $a + $b;
    }

    public function divide($a, $b)
    {
        if ($b == 0)
            throw new \InvalidArgumentException("Divisão por zero não é permitida");
        return $a / $b;
    }

}