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
    <title>Pagamento Pix - Arandu</title>
    <link rel="stylesheet" href="css/style.css?v=7">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="perfil-page">
     <header class="top-header">
        <div class="brand">
            <img src="img/logo.png" alt="Arandu">
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="maisProcurados.php">+ Procurados</a>
            <a href="novidades.php">Novidades</a>
        </nav>

        <div class="search-box">
            <input type="text" placeholder="Pesquisar...">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>

        <div class="header-actions">
            <div class="user-tools">
                <a href="carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                    <span aria-hidden="true">🛍</span>
                </a>
                <a href="login.php" class="header-button login-link">Entrar</a>
                <a href="usuario/perfil.php" class="header-button admin-link">
                    <span aria-hidden="true">👤</span>
                    <span></span>
                </a>
            </div>
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