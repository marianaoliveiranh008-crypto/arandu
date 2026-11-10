<?php
    session_start();
    require_once '../config/database.php';

    if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true){
        header("Location: login.php");
        exit;
    }

    $id_usuario = $_SESSION['usuarioId'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $senhaAtual = $_POST['senhaAtual'] ?? '';
        $novaSenha = $_POST['novaSenha'] ?? '';
        $confirmarSenha = $_POST['confirmarSenha'] ?? '';

        $sqlSel = "SELECT senha FROM usuario WHERE id_usuario = ?";
        $stmtSel = $conexao->prepare($sqlSel);
        $stmtSel->bind_param("i", $id_usuario);
        $stmtSel->execute();

        $resultadoSel = $stmtSel->get_result();
        $usuario = $resultadoSel->fetch_assoc();

        $stmtSel->close();

        if(!$usuario){
            echo "Usuário não encontrado.";
        }elseif(!password_verify($senhaAtual, $usuario['senha'])){
            echo "A senha atual está incorreta.";
        }elseif($novaSenha !== $confirmarSenha){
            echo "A nova senha e a confirmação não coincidem";
        }else{
            $senhaHash = password_hash(
                $novaSenha,
                PASSWORD_DEFAULT
            );

        $sqlUp = "UPDATE usuario SET senha = ? WHERE id_usuario = ?";
        $stmtUp = $conexao->prepare($sqlUp);
        
        if(!$stmtUp){
            die("Erro ao preparar consulta: ".$conexao->error);
        }

        $stmtUp->bind_param("si", $senhaHash, $id_usuario);

        if($stmtUp->execute()){
            header("Location: perfil.php");
            exit;
        }else{
            $erro = "Erro ao atualizar a senha: ".$stmtUp->error;
        }
        $stmtUp->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar senha - Arandu</title>
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

            <h1 id="titulo-alterar-senha">Alterar senha</h1>
            <p class="senha-intro">Atualize sua senha para manter sua conta protegida.</p>

            <form method="post">

                <label for="senha-atual">Senha atual:</label>
                <input type="password" id="senha-atual" name="senhaAtual" maxlength="8" autocomplete="current-password" placeholder="••••••••" required>

                <a href="verificarCodigo.php" class="esqueci">Esqueci minha senha</a>

                <label for="nova-senha">Nova senha:</label>
                <input type="password" id="nova-senha" name="novaSenha" maxlength="8" autocomplete="new-password" placeholder="••••••••" required>

                <small class="aviso">Máximo de 8 caracteres</small>

                <label for="confirmar-senha">Confirmar nova senha:</label>
                <input type="password" id="confirmar-senha" name="confirmarSenha" maxlength="8" autocomplete="new-password" placeholder="••••••••" required>

                <button type="submit">Salvar nova senha</button>

            </form>

        </section>
    </main>

</body>
</html>