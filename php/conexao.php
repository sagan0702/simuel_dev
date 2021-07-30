<?php
$bdServidor = '127.0.0.1';
$bdUsuario = 'sevin';
$bdSenha = '@sevin2021!';
$bdBanco = 'simuel_dev';
$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

// Checa conexão
if (mysqli_connect_errno()) {
    echo "Falha na conexão com o servido MySQL:  " . mysqli_connect_error();
    die();
 } 
/* else {
    echo 'Conexão Ok! Host info: ' . 
} */
 

