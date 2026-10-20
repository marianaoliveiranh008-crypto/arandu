<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil - Arandu</title>
    <link rel="stylesheet" href="../css/style.css?v=7">
</head>
<body class="perfil-page">
    <header class="top-header login-header">
        <a class="brand" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="../index.php">Home</a>
            <a href="../sobreNos.php">Sobre nós</a>
            <a href="#">+ Procurados</a>
            <a href="#">Novidades</a>
        </nav>

        <div class="perfil-atalhos" aria-label="Atalhos">
            <a href="../carrinho.php" aria-label="Carrinho" title="Carrinho">🛍</a>
            <a href="perfil.php" aria-label="Meu perfil" title="Meu perfil">♙</a>
        </div>
    </header>

    <main class="perfil-conteudo">
        <section class="perfil-cartao" aria-labelledby="titulo-dados">
            <h1 id="titulo-dados">Dados pessoais</h1>

            <div class="perfil-dados">
                <span class="perfil-avatar" aria-hidden="true">♙</span>
                <div>
                    <p><strong>Nome completo:</strong> Fulano de Tal</p>
                    <p><strong>CPF:</strong> 123******45</p>
                    <p><strong>E-mail:</strong> fulanodetal@gmail.com</p>
                    <p><strong>Telefone:</strong> 51 999999020</p>
                </div>
            </div>

            <section class="perfil-secao" aria-labelledby="titulo-envio">
                <h2 id="titulo-envio">Informações de envio</h2>
                <p class="perfil-endereco"><strong>Endereço:</strong> Rua dos Bobos, 000 - Lomba Grande, Novo Hamburgo.</p>
                <a class="perfil-adicionar" href="#"><span class="perfil-mais" aria-hidden="true">+</span>Adicionar novo endereço</a>
                <a class="perfil-adicionar" href="#"><span class="perfil-mais" aria-hidden="true">+</span>Adicionar forma de pagamento</a>
            </section>

            <section class="perfil-secao perfil-seguranca" aria-labelledby="titulo-seguranca">
                <h2 id="titulo-seguranca">Segurança</h2>
                <a href="alterarSenha.php">Alterar senha</a>
                <a href="../verificarCodigo.php">Verificação em duas etapas</a>
            </section>

            <div class="perfil-acoes">
                <button type="button">Excluir conta</button>
                <a href="../logout.php">Sair</a>
            </div>
        </section>
    </main>
</body>
</html>