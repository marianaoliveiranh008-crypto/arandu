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
    <title>Pagamento Crédito - Arandu</title>
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

        <div class="header-actions">
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
        </div>
    </header>

    <main class="perfil-conteudo">
        <section class="perfil-cartao" aria-labelledby="titulo-dados">
            <h1 id="titulo-dados">Cartão de crédito</h1>
            <div class="campo-cadastro campo-cadastro--wide">
                <label for="parcelas">Bandeira:</label>
                <select id="parcelas" name="parcelas" required>
                    <option value="visa">Visa</option>
                    <option value="mastercard">Mastercard</option>
                    <option value="elo">Elo</option>
                </select>
            </div>
            <div class="campo-cadastro campo-cadastro--wide">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="campo-cadastro campo-cadastro--wide">
                <label for="numero-cartao">Número do cartão:</label>
                <input type="password" id="numero-cartao" name="numero-cartao" required>
            </div>
            <div class="campo-cadastro campo-cadastro--wide">
                <label for="validade">Validade:</label>
                <input type="text" id="validade" name="validade" placeholder="MM/AA" required>
            </div>
            <div class="campo-cadastro campo-cadastro--wide">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <div class="campo-cadastro campo-cadastro--wide">
                <label for="parcelas">Parcelas:</label>
                <select id="parcelas" name="parcelas" required>
                    <option value="">Selecione</option>
                    <option value="1">1x sem juros</option>
                    <option value="2">2x sem juros</option>
                    <option value="3">3x sem juros</option>
                </select>
            </div>
            <a href="finalizarCompra.php"><button>Cancelar</button></a>
            <a href="compraRealizada.php"><button>Finalizar</button></a>
        </section>
    </main>
</body>
</html>