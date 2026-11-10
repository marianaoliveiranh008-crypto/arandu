<?php
    session_start();
    require_once "../config/database.php";

    if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true){
        header("Location: ../login.php");
        exit;
    }

    $id_usuario = $_SESSION['usuarioId'];

    $sql = "SELECT u.nome, u.cpf_usuario, u.email, u.telefone, e.id_end, e.rua, e.numero, e.bairro, e.cidade
            FROM usuario u
            LEFT JOIN endereco e ON u.id_usuario = e.id_usuario
            WHERE u.id_usuario = ?
            ORDER BY e.id_end DESC
            LIMIT 1";
            
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

    if(!$id_usuario){
        die("Usuário não encontrado.");
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
<body class="perfil-page">
    <header class="top-header">
        <div class="brand">
            <img src="../img/logo.png" alt="Arandu">
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="../index.php">Home</a>
            <a href="../sobreNos.php">Sobre nós</a>
            <a href="../maisProcurados.php">+ Procurados</a>
            <a href="../novidades.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="header-actions">
                <div class="user-tools">
                    <a href="../carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                        <span aria-hidden="true">🛍</span>
                    </a>
                    <a href="../login.php" class="header-button login-link">Entrar</a>
                    <a href="perfil.php" class="header-button admin-link">
                        <span aria-hidden="true">👤</span>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="perfil-conteudo">
        <section class="perfil-cartao" aria-labelledby="titulo-dados">
            <h1 id="titulo-dados">Dados pessoais</h1>

            <div class="perfil-dados">
                <span class="perfil-avatar" aria-hidden="true">♙</span>
                <div>
                    <p><strong>Nome completo: </strong><?= htmlspecialchars($cliente['nome'] ?? 'Não informado') ?></p>
                    <p><strong>CPF: </strong><?= htmlspecialchars($cliente['cpf_usuario'] ?? 'Não informado') ?></p>
                    <p><strong>E-mail: </strong><?= htmlspecialchars($cliente['email'] ?? 'Não informado') ?></p>
                    <p><strong>Telefone: </strong><?= htmlspecialchars($cliente['telefone'] ?? 'Não informado') ?></p>
                </div>
            </div>

            <section class="perfil-secao" aria-labelledby="titulo-envio">
                <h2 id="titulo-envio">Informações de envio</h2>
                <p class="perfil-endereco">
                    <strong>Endereço:</strong> 
                    <?php if (!empty($cliente['rua'])): ?>
                        <?= htmlspecialchars($cliente['rua']) ?>, 
                        <?= htmlspecialchars($cliente['numero']) ?> - 
                        <?= htmlspecialchars($cliente['bairro']) ?>, 
                        <?= htmlspecialchars($cliente['cidade']) ?>.
                    <?php else: ?>
                        Nenhum endereço cadastrado.
                    <?php endif; ?>
                </p>
                <a class="perfil-adicionar" href="editarEndereco.php"><span class="perfil-mais" aria-hidden="true">+</span>Editar endereço</a>
                <a class="perfil-adicionar" href="../compras/historico.php"><span class="perfil-mais" aria-hidden="true">+</span>Histórico de compras</a>
            </section>

            <section class="perfil-secao perfil-seguranca" aria-labelledby="titulo-seguranca">
                <h2 id="titulo-seguranca">Segurança</h2>
                <a class="perfil-adicionar" href="alterarSenha.php"><span class="perfil-mais" aria-hidden="true">+</span>Alterar senha</a>
                <a class="perfil-adicionar" href="../verificarCodigo.php"><span class="perfil-mais" aria-hidden="true">+</span>Verificação em duas etapas</a>
            </section>

            <div class="perfil-acoes">
                <a href="../editarInformacoes.php">Editar</a>
                <a href="../excluirConta.php">Excluir conta</a>
                <a href="../logout.php">Sair</a>
            </div>
        </section>
    </main>
</body>
</html>