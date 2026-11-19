<?php
    session_start();
    require_once "../../config/database.php";
    
    $erro = "";
    $id_usuario = $_GET['id_usuario'] ?? $_GET['id'] ?? 2;
    
    if(!$id_usuario){
            $erro= "Usuário não encontrado.";
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    var_dump($_POST);    
    $id_excluir = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
        if(!$id_excluir){
            $erro = "ID do usuário inválido.";
        }else{
            try{
                $conexao->begin_transaction();
                $sqlEnd = "DELETE FROM endereco WHERE id_usuario = ?";
                $stmtEnd = $conexao->prepare($sqlEnd);
                $stmtEnd->bind_param("i", $id_excluir);
                $stmtEnd->execute();
                $stmtEnd->close();

                $sqlDel = "DELETE FROM usuario WHERE id_usuario = ?";
                $stmtDel = $conexao->prepare($sqlDel);
                $stmtDel->bind_param("i", $id_excluir);
                $stmtDel->execute();

                if($stmtDel->affected_rows > 0){
                    $stmtDel->close();
                    $conexao->commit();
                    header("Location: listaUsuarios.php");
                    exit;
                }else{
                    $stmtDel->close();
                    throw new Exception("Cliente não encontrado.");
                }
            }catch(Exception $e){
                $conexao->rollback();
                $erro = "Erro ao excluir cliente.";
            }
        }
    }

    if(empty($erro) && $id_usuario){
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
        if(!$cliente){
            $erro = "Usuário não encontrado.";
        }
        }else{
            $erro = "Erro no preparo da consulta: ".$conexao->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=7">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../perfilAdmin.php" aria-label="Perfil" title="Perfil">
                <img src="../../img/perfil.png" alt="Perfil">
            </a>
        </nav>
    </header>

    <main class="perfil-conteudo">
        <section class="perfil-cartao" aria-labelledby="titulo-dados">
            <h1 id="titulo-dados">Perfil do cliente</h1>

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
            </section>

            <?php if (!empty($erro)) { ?>
            <p
                style="background-color: #780000;
                        color: #ffffff;
                        padding: 8px 12px;
                        border-radius: 6px;
                        text-align: center;
                        width: max-content;
                        max-width: 100%;
                        margin: 10px auto;">
                <?php echo $erro; ?>
            </p>
            <?php } ?>
            
            <form method="POST">
                <input type="hidden" name="id_usuario" value="<?= htmlspecialchars((string)$id_usuario) ?>">
                <div class="perfil-acoes">
                    <button tyoe="submit" value="excluir">Excluir cliente</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>