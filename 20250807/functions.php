<?php

function minor($a, $b)
{
    return $a < $b ? $a : $b;
}

echo minor(1, 2);

function dist($p1, $p2)
{
    return sqrt(pow($p2[0] - $p1[0], 2) + pow($p2[1] - $p1[1], 2));
}

$p1 = [1, 2];
$p2 = [3, 4];
echo "<br>";
echo dist($p1, $p2);

function average($notes, $type)
{
    switch ($type) {
        case 'A':
            return array_sum($notes) / count($notes);
            break;
        case 'P':
            $weights = [5, 3, 2];
            $weightedSum = 0;
            for ($i = 0; $i < count($notes); $i++) {
                $weightedSum += $notes[$i] * $weights[$i];
            }
            return $weightedSum / array_sum($weights);
            break;
        case 'H':
            return 3 / (1 / $notes[0] + 1 / $notes[1] + 1 / $notes[2]);
            break;
        default:
            return "Invalid type";
            break;
    }
}

$notes = [10, 8, 7];
echo "<br>";
echo average($notes, 'A');
echo "<br>";
echo average($notes, 'P');
echo "<br>";
echo average($notes, 'H');

function sortArray($array){
    $lenght = count($array);

    for($i = 0; $i < $lenght - 1;$i++){
        for($j =0; $j< $lenght - $i -1; $j++){
            if($array[$j] > $array[$j+1]){
                $temp = $array[$j];
                $array[$j] = $array[$j+1];
                $array[$j+1] = $temp;
            }
        }
    }
    return $array;
}

$array = [64,34,25,12,22,11,90];
echo "<br>";
$arr = sortArray($array);
print_r($arr);

function findDivisors($number){
    $divisors = [];

    for($i=1;$i<$number;$i++){
        if($number % $i == 0){
            $divisors[] = $i;
        }
    }

    return $divisors;
}

$testNumber = [12,16,20,25,30];

foreach($testNumber as $num){
    $divisors = findDivisors($num);
    echo "<br>Os divisores de $num são: ".implode(", " ,$divisors);
}

?>