<?php
function inverso($x) {
    if (!$x) {
        throw new Exception('División por cero.');
    }
    else return 1/$x;
}

try {
    echo inverso(5) . "<br>";
    echo inverso(0) . "<br>";
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

// Continuar la ejecución
echo 'Hola Mundo';
?>