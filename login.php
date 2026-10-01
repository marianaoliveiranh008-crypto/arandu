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
        <img src="https://drive.google.com/file/d/1Pi_dgjH8JAQ3Syyeug5O_XeIaLA6icGI/view?usp=sharing" alt="Logo Arandu" class="logo">

        <div class="caixa-login">
            <h1>Seja bem-vindo<br>à Arandu!</h1>

            <form>
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