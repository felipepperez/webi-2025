<?php

$message_global = "Esta variável é global";

function scopeSample()
{
    $message_global = "Esta é uma variável local";
    return $message_global;
}

function scopeOverideSample(){
    global $message_global;
    $message_global = "Esta é uma variável local";
    return $message_global;
}

echo "<br>$message_global " . scopeSample(). " $message_global";

echo "<br>$message_global " . scopeOverideSample(). " $message_global";


