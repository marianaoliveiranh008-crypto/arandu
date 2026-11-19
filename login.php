<?php
    session_start();
    require_once "config/database.php";

    if(isset($_GET['id'])){
        $_SESSION['produto_pendente'] = [
            'id_liv' => $_GET['id']
        ];
        $_SESSION['url_retorno'] = 'carrinho.php';
    }elseif(isset($_GET['id_liv'])){
        $_SESSION['produto_pendente'] = [
            'id_liv' => $_GET['id_liv']
        ];
        $_SESSION['url_retorno'] = 'carrinho.php';
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if(empty($email) || empty($senha)){
            echo "Preencha todos os campos";
        }else{
            $sql = "SELECT id_usuario, nome, email, senha,  tipo_usuario FROM usuario WHERE email = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows === 1){
                $usuario = $resultado->fetch_assoc();
                $loginValido = password_verify($senha, $usuario['senha']);

                if($loginValido){
                    $codigo = rand(100000, 999999);
                    $_SESSION['codigo_verificacao'] = $codigo;
                    $_SESSION['usuario_temp'] = ['id_usuario' => $usuario['id_usuario'],
                                                'nome' => $usuario['nome'],
                                                'email' => $usuario['email'],
                                                'tipo_usuario' => $usuario['tipo_usuario']
                                                ];
                    header("Location: verificarCodigo.php");
                    exit;
                }else{
                    $erro = "E-mail ou senha incorretos.";
                }
            }else{
                $erro = "E-mail ou senha incorretos.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Arandu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="login-page">
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
                    <a href="carrinho.php" aria-label="Carrinho de compras" class="carrinho-perfil-png">
                        <img src="img/carrinho.png" alt="Arandu">
                    </a>
                    <a href="usuario/perfil.php" aria-label="Perfil do usuário" class="carrinho-perfil-png">
                        <img src="img/perfil.png" alt="Arandu">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="caixa-login">
            <h1>Seja bem-vindo<br>à Arandu!</h1>

            <form method="POST">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" maxlength="8" required>

                <div class="mensagem-erro">
                   <?= htmlspecialchars($erro ?? '')?> 
                </div>

                <a href="verificarCodigo.php" class="esqueci">
                    Esqueci minha senha
                </a>

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

                <button type="submit">Entrar</button>
            </form>

            <p class="cadastro">
                Ainda não tem uma conta?
                <a href="cadastro.php">Cadastre-se</a>
            </p>
        </div>
    </main>
</body>
</html>