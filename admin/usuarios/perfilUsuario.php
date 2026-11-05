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
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="usuarios-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M5 21v-2a7 7 0 0 1 14 0v2" />
                </svg>
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