<?php
    session_start();
    require_once '../config/database.php';

    if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true){
        header("Location: login.php");
        exit;
    }

    $id_usuario = $_SESSION['usuarioId'];

    $cliente = ['nome' => '', 'cpf_usuario' => '', 'e-mail' => '', 'telefone' => ''];

    $sql = "SELECT * FROM usuario WHERE id_usuario = ? LIMIT 1";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows === 1){
        $cliente = $resultado->fetch_assoc();
    }
    $stmt->close();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';

        $sqlUp = "UPDATE usuario SET nome = ?, cpf_usuario = ?, email = ?, telefone = ? WHERE id_usuario = ?";
        $stmtUp = $conexao->prepare($sqlUp);
        
        if(!$stmtUp){
            die("Erro ao preparar consulta: " . $conexao->error);
        }

        $stmtUp->bind_param("ssssi", $nome, $cpf, $email, $telefone, $id_usuario);
            
        if($stmtUp->execute()){
            header("Location: perfil.php");
            exit;
        }else{
            $erro = "Erro ao atualizar o endereço: " . $stmtUp->error;
        }
        $stmtUp->close();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informações - Arandu</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="senha-page">
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

    <main class="container senha-container">
        <section class="caixa-login" aria-labelledby="titulo-alterar-senha">

            <h1 id="titulo-alterar-senha">Editar informações</h1>
            <form method="post">

                <div class="campo-cadastro">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" placeholder="Seu nome" required>
                </div>

                <div class="campo-cadastro">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($cliente['cpf_usuario']) ?>" placeholder="000.000.000-00" required>
                </div>

                <div class="campo-cadastro">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" placeholder="seu@email.com" required>
                </div>

                <div class="campo-cadastro">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" placeholder="(00) 00000-0000" required>
                </div>

                <button class="cadastro-submit" type="submit">Salvar</button>
            </form>

        </section>
    </main>
</body>
</html>