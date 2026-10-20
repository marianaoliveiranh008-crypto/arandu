<?php
    session_start();
    require_once "../../config/database.php";

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
    <title>Lista de Usuários - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=2">
</head>
<body class="usuarios-page">
    <header class="top-header login-header">
        <a class="brand" href="../../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../../compras/historico.php">Pedidos</a>
            <a class="ativo" href="../usuarios/listaUsuarios.php" aria-current="page">Clientes</a>
            <a href="../produtos/listaLivros.php">Estoque</a>
        </nav>

        <nav class="usuarios-atalhos" aria-label="Atalhos">
            <a href="../../index.php" aria-label="Página inicial" title="Página inicial">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z" /></svg>
            </a>
            <a href="#notificacoes" aria-label="Notificações" title="Notificações">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" /></svg>
            </a>
            <a href="../../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4" /><path d="M5 21v-2a7 7 0 0 1 14 0v2" /></svg>
            </a>
        </nav>
    </header>

    <main>
        <h1>Perfil do Cliente</h1>
        <div class="dados-cliente">

                <div class="avatar">♙</div>

                <div class="informacoes">
                    <p><strong>Nome completo:</strong> <?= htmlspecialchars($cliente['nome'] ?? 'Não informado') ?></p>
                    <p><strong>E-mail:</strong> <?= htmlspecialchars($cliente['email'] ?? 'Não informado') ?></p>
                    <p><strong>Telefone:</strong> <?= htmlspecialchars($cliente['telefone'] ?? 'Não informado') ?></p>
                </div>

            </div>

            <h2>Informações de envio</h2>

            <p class="endereco">
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

        </section>

        <form action="excluirUsuario.php" method="POST">
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
            <button type="submit">Excluir cliente</button>
        </form>
    </main>
    
</body>
</html>