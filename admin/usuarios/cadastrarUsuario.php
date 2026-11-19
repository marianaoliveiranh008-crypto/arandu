<?php
    session_start();
    require_once '../../config/database.php';

    $erro = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? 0;
        $senha = $_POST['senha'] ?? '';
        $tipo_usuario = $_POST['tipo_usuario'] ?? 1;

        if(empty($nome) || empty($email) || empty($senha)){
            $erro = "Preencha nome, e-mail e senha.";
        }else{
            $sqlSel = "SELECT id_usuario FROM usuario WHERE email = ? LIMIT 1";
            $stmtSel = $conexao->prepare($sqlSel);

            if($stmtSel){
                $stmtSel->bind_param("s", $email);
                $stmtSel->execute();
                $resultadoSel = $stmtSel->get_result();

                if($resultadoSel->num_rows > 0){
                    $erro = "Este e-mail já está cadastrado.";
                }else{
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                    $sqlIns = "INSERT INTO usuario (nome, cpf_usuario, email, telefone, senha, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmtIns = $conexao->prepare($sqlIns);

                    if(!$stmtIns){
                        $erro = "Erro ao preparar consulta: ".$conexao->error;
                    }else{
                        $stmtIns->bind_param("sssssi", $nome, $cpf, $email, $telefone, $senhaHash, $tipo_usuario);

                        if($stmtIns->execute()){
                            $stmtIns->close();
                            $stmtSel->close();
                            header("Location: listaUsuarios.php");
                            exit;
                        } else {
                            $erro = "Erro ao cadastrar usuário: " . $stmtIns->error;
                        }
                        $stmtIns->close();
                    }
                }
                $stmtSel->close();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=11">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page usuarios-page cadastro-livro-page">
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

    <main class="cadastro-livro-conteudo">
        <section class="cadastro-livro-cartao" aria-labelledby="cadastro-livro-titulo">
            <h1 id="cadastro-livro-titulo">Adicionar usuário</h1>

            <form class="cadastro-livro-form" method="POST">
                <input type="hidden" name="nome" value="<?= $nome ?>">
                <div class="cadastro-livro-campos">
                    <p class="cadastro-livro-campo">
                        <label for="nome">Nome completo</label>
                        <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($nome ?? '')?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="cpf">CPF</label>
                        <input id="cpf" type="text" name="cpf" value="<?= htmlspecialchars($cpf ?? '')?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="email-aut">E-mail</label>
                        <input id="email-aut" type="text" name="email" value="<?= htmlspecialchars($email ?? '')?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="telefone">Telefone</label>
                        <input id="telefone" type="text" name="telefone" value="<?= htmlspecialchars($telefone ?? '')?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="senha">Senha</label>
                        <input id="senha" name="senha" type="password" value="<?= htmlspecialchars($senha ?? '')?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="tipo-usuario">Tipo de usuário</label>
                        <select id="tipo-usuario" name="tipo_usuario">
                            <option value="1"<?= (isset($tipo_usuario) && $tipo_usuario === 1) ? 'selected' : '' ?>>Cliente</option>
                            <option value="2"<?= (isset($tipo_usuario) && $tipo_usuario === 2) ? 'selected' : '' ?>>Administrador</option>
                        </select>
                    </p>
                </div>
                <br>

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

                <div class="cadastro-livro-acoes">
                    <button type="submit">Salvar usuário</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>