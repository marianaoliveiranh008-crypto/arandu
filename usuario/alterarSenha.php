<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar senha - Arandu</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
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