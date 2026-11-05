<?php
    session_start();
    require_once "config/database.php";

    $id_usuario = $_GET['id_usuario'] ?? $_GET['id'] ?? 2;

    $sql = "SELECT u.nome, u.email, u.telefone, e.rua, e.numero, e.bairro, e.cidade
    FROM usuario u
    LEFT JOIN endereco e ON u.id_usuario = e.id_usuario
    WHERE u.id_usuario = ?";
            
    $stmt = $conexao->prepare($sql);

    if($stmt){
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();

    $stmt->close();
    }else{
        die("Erro no prepare da consulta: ".$conexao->error);
    }

    if(!$id_usuario){
        die("Usuário não encontrado.");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento - Arandu</title>
    <link rel="stylesheet" href="css/style.css?v=7">
</head>
<body class="perfil-page">
    <header class="top-header login-header">
        <a class="brand" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="../index.php">Home</a>
            <a href="../sobreNos.php">Sobre nós</a>
            <a href="#">+ Procurados</a>
            <a href="#">Novidades</a>
        </nav>

        <div class="perfil-atalhos" aria-label="Atalhos">
            <a href="../carrinho.php" aria-label="Carrinho" title="Carrinho">🛍</a>
            <a href="perfil.php" aria-label="Meu perfil" title="Meu perfil">♙</a>
        </div>
    </header>

    <main class="perfil-conteudo">
        <section class="perfil-cartao" aria-labelledby="titulo-dados">
            <h1 id="titulo-dados">Chave pix</h1>
            <div class="campo-cadastro campo-cadastro--wide">
                <label for="nome">Chave:</label>
                <p>033.463.920-40 (Luiza de Morais Favero)</p>
            </div>
            <br>
            <a href="finalizarCompra.php"><button>Cancelar</button></a>
            <a href="compraRealizada.php"><button>Finalizar</button></a>
        </section>
    </main>
</body>
</html>