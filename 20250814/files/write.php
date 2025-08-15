<?php

function isPrime($number)
{
    if ($number < 2)
        return false;
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0)
            return false;
    }
    return true;
}

function generatePrimes($count)
{
    $primes = [];
    $number = 2;

    while (count($primes) < $count) {
        if (isPrime($number)) {
            $primes[] = $number;
        }
        $number++;
    }

    return $primes;
}

$primes = generatePrimes(10000);

$filename = "primos.txt";
$file = fopen($filename, "w");

if ($file) {
    foreach ($primes as $index => $prime) {
        fwrite($file, ($index + 1) . "- " . $prime . "\n");
    }

    fclose($file);
    echo "Números primos salvos!";
} else {
    echo "Erro ao abrir o arquivo!\n";
}