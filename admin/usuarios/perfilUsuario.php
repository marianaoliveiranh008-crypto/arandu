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
    <link rel="stylesheet" href="../../css/style.css?v=11">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page perfil-cliente-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M5 21v-2a7 7 0 0 1 14 0v2" />
                </svg>
            </a>
        </nav>
    </header>

    <main class="perfil-cliente-conteudo">
        <section class="perfil-cliente-cartao" aria-labelledby="perfil-cliente-titulo">
            <h1 id="perfil-cliente-titulo">Perfil do cliente</h1>

            <div class="perfil-cliente-dados">
                <div class="perfil-cliente-avatar" aria-hidden="true">♙</div>
                <div class="perfil-cliente-informacoes">
                    <p><strong>Nome completo</strong><span><?= htmlspecialchars($cliente['nome'] ?? 'Não informado') ?></span></p>
                    <p><strong>E-mail</strong><span><?= htmlspecialchars($cliente['email'] ?? 'Não informado') ?></span></p>
                    <p><strong>Telefone</strong><span><?= htmlspecialchars($cliente['telefone'] ?? 'Não informado') ?></span></p>
                </div>
            </div>

            <div class="perfil-cliente-endereco">
                <h2>Informações de envio</h2>
                <p>
                    <?php if (!empty($cliente['rua'])): ?>
                        <?= htmlspecialchars($cliente['rua']) ?>,
                        <?= htmlspecialchars($cliente['numero']) ?> -
                        <?= htmlspecialchars($cliente['bairro']) ?>,
                        <?= htmlspecialchars($cliente['cidade']) ?>.
                    <?php else: ?>
                        Nenhum endereço cadastrado.
                    <?php endif; ?>
                </p>
            </div>

            <form class="perfil-cliente-acoes" action="excluirUsuario.php" method="POST">
                <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                <button type="submit">Excluir cliente</button>
            </form>
        </section>
    </main>
    
</body>
</html>