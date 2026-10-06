<?php
    $host = 'localhost';
    $bancodedados = 'ARANDU';
    $usuario = 'root';
    $senha = '';

    $conexao = new mysqli(
        $host,
        $bancodedados,
        $usuario,
        $senha
    );

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    $conexao->set_charset("utf8");
?>