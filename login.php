<?php
    session_start();
    require_once "config/database.php";

    function enviarCodigoVerificacao($email, $codigo) {
    $apiKey = ''; 

    $payload = [
        'from' => 'Arandu <onboarding@resend.dev>',
        'to' => [$email],
        'subject' => 'Código de Verificação - Arandu',
        'html' => "<p>Seu código de verificação para acessar a conta é: <strong>{$codigo}</strong></p>"
    ];

    $ch = curl_init('https://api.resend.com/emails');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);

    $resultado = curl_exec($ch);
    curl_close($ch);
    return $resultado;
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if(empty($email) || empty($senha)){
            echo "Preencha todos os campos";
        }else{
            $sql = "SELECT id_usuario, nome, email, senha,  tipo_usuario, email_verificado FROM usuario WHERE email = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            $loginValido = false;
            if (password_verify($senha, $usuario['senha']) || $senha === $usuario['senha']) {
                $loginValido = true;
                $senhaHash = password_hash(
                $senha,
                PASSWORD_DEFAULT
                );
            }if($loginValido){
                if ($usuario['email_verificado'] == 0) {
                    $codigo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                    $stmtUpdate = $conexao->prepare("UPDATE usuario SET codigo_verificacao = ? WHERE id_usuario = ?");
                    $stmtUpdate->bind_param("si", $codigo, $usuario['id_usuario']);
                    $stmtUpdate->execute();

                    enviarCodigoVerificacao($usuario['email'], $codigo);

                    $_SESSION['temp_usuario_id'] = $usuario['id_usuario'];
                    header("Location: verificarCodigo.php");
                    exit;
                }
                $_SESSION['usuarioId'] = $usuario['id_usuario'];
                $_SESSION['usuarioNome'] = $usuario['nome'];
                $_SESSION['usuarioEmail'] = $usuario['email'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                $_SESSION['logado'] = true;

                if($usuario['tipo_usuario'] == 2){
                    header("Location: admin/index.php");
                }else{
                header("Location: index.php");
                }
                exit;
                }else{
                    echo "E-mail ou senha incorretos.";
                }
            }else{
                echo "E-mail ou senha incorretos.";
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
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="login-page">
    <header class="top-header login-header">
        <a class="brand" href="index.php" aria-label="Arandu - página inicial">
            <img src="img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="#">Sobre nós</a>
            <a href="#">+ Procurados</a>
            <a href="#">Novidades</a>
        </nav>

    </header>

    <main class="container">
        <div class="caixa-login">
            <h1>Seja bem-vindo<br>à Arandu!</h1>

            <form action="login.php" method="POST">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <a href="verificarCodigo.php" class="esqueci">
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