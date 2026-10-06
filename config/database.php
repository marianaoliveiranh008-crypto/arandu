<?php
    $host = 'localhost';
    $usuario = 'root';
    $bancodedados = 'ARANDU';
    $senha = '';

    $conexao = new mysqli(
        'localhost',
        'root',
        '',
        'ARANDU'
    );

    if ($conexao->connect_error) {
        die("Erro na conexão: ".$conexao->connect_error);
    }

    $conexao->set_charset("utf8");
?>