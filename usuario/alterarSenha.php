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
        <a class="brand" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação principal">
            <a href="../index.php">Home</a>
            <a href="">Sobre nós</a>
            <a href="">+ Procurados</a>
            <a href="">Novidades</a>
        </nav>

        <div class="header-actions">
            <label class="search-box">
                <span aria-hidden="true">⌕</span>
                <input type="search" placeholder="Pesquisar..." aria-label="Pesquisar livros">
            </label>

            <div class="user-tools">
                <a href="../carrinho.php" class="cart-link" aria-label="Carrinho de compras">
                    <span aria-hidden="true">🛍</span>
                </a>
                <a href="../login.php" class="link-ghost" aria-label="Minha conta">♙</a>
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