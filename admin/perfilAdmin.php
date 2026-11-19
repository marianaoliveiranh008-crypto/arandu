<?php
    session_start();
    require_once "../config/database.php";

    $sql = "SELECT u.nome, u.email, u.telefone
            FROM usuario u
            WHERE u.id_usuario = ?";
            
    $stmt = $conexao->prepare($sql);

    if($stmt){
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    
    $resultado = $stmt->get_result();
    $cliente = $resultado->fetch_assoc();

    $stmt->close();
    }else{
        die("Erro no preparo da consulta: ".$conexao->error);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil - Arandu</title>
    <link rel="stylesheet" href="../css/style.css?v=7">
    <link rel="icon" href="../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page">
    <header class="cabecalho">
        <a class="marca" href="index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="produtos/indexLivros.php">Livros</a>
            <a href="pedidos/indexPedidos.php">Pedidos</a>
            <a href="usuarios/listaUsuarios.php">Clientes</a>
            <a href="produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="perfilAdmin.php" aria-label="Perfil" title="Perfil">
                <img src="../img/perfil.png" alt="Perfil">
            </a>
        </nav>
    </header>

    <main class="perfil-conteudo">
        <section class="perfil-cartao" aria-labelledby="titulo-dados">
            <h1 id="titulo-dados">Dados pessoais</h1>

            <div class="perfil-dados">
                <span class="perfil-avatar" aria-hidden="true">♙</span>
                <div>
                    <p><strong>Nome: </strong><?= htmlspecialchars($cliente['nome'] ?? 'Não informado') ?></p>
                    <p><strong>E-mail: </strong><?= htmlspecialchars($cliente['email'] ?? 'Não informado') ?></p>
                    <p><strong>Telefone: </strong><?= htmlspecialchars($cliente['telefone'] ?? 'Não informado') ?></p>
                </div>
            </div>

            <section class="perfil-secao perfil-seguranca" aria-labelledby="titulo-seguranca">
                <h2 id="titulo-seguranca">Segurança</h2>
                <a class="perfil-adicionar" href="../alterarSenha.php"><span class="perfil-mais" aria-hidden="true">+</span>Alterar senha</a>
                <a class="perfil-adicionar" href="../verificarCodigo.php"><span class="perfil-mais" aria-hidden="true">+</span>Verificação em duas etapas</a>
            </section>

            <div class="perfil-acoes">
                <a href="../excluirConta.php">Excluir conta</a>
                <a href="../logout.php">Sair</a>
            </div>
        </section>
    </main>
</body>
</html>