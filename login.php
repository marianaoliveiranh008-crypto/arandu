<?php
    require_once "config/database.php";

    $mensagem = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if(empty($email) || empty($senha)){
            echo "Preencha todos os campos";
        }else{
            $sql = "SELECT id_usuario, nome, email, senha, tipo_usuario FROM usuario WHERE email = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows === 1){
                $usuario = $resultado->fetch_assoc();
                if(password_verify($senha, $usuario['senha'])){
                    $_SESSION['usuarioId'] = $usuario['usuarioId'];
                    $_SESSION['usuarioNome'] = $usuario['nome'];
                    $_SESSION['usuarioEmail'] = $usuario['email'];
                    $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                    $stmt->close();
                    header("Location: index.php");
                    exit;
                }else{
                    $mensagem = "E-mail ou senha incorretos.";
                }
            }else{
                $mensagem = "Usuário não encontrado!";
            }
            $stmt->close();
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
</head>
<body>
    <main class="container">
        <img src="img/logo.png" alt="Arandu" class="logo">
        <div class="caixa-login">
            <h1>Seja bem-vindo<br>à Arandu!</h1>

            <form action="login.php" method="POST">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <a href="usuario/alterarSenha.php" class="esqueci">
                    Esqueci minha senha
                </a>

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