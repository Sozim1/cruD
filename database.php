<?php
$hostname = "localhost";
$bancodedados = "cadastro";
$usuario = "root";
$senha = "";
$conn = "";

try {
    $conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);
} catch (mysqli_sql_exception $e) {
    echo "falha ao conectar";
}
?>
