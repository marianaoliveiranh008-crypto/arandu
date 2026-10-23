<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capitães de Areia | Arandu</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="detalhes-page">
    <header class="top-header">
        <a class="brand" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="../index.php">Home</a>
            <a href="../sobreNos.php">Sobre nós</a>
            <a href="../index.php">+ Procurados</a>
            <a href="../index.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="user-tools">
                <a href="../carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                    <span aria-hidden="true">🛍</span>
                </a>
                <a href="../login.php" class="header-button login-link">Entrar</a>
                <a href="../usuario/perfil.php" class="header-button admin-link" aria-label="Perfil">
                    <span aria-hidden="true">👤</span>
                </a>
            </div>
        </div>
    </header>

    <main class="detalhes-main">
        <article class="detalhes-card">
            <img
                class="detalhes-capa"
                src="https://m.media-amazon.com/images/I/81t7altQZxL._SL1500_.jpg"alt="Capa do livro Capitães de Areia">

            <div class="detalhes-conteudo">
                <h1>Capitães de Areia</h1>
                <p class="detalhes-autor">Por: Jorge Amado</p>

                <p class="detalhes-descricao">
                    Nas ruas de Salvador, um grupo de meninos abandonados enfrenta a pobreza,
                    a violência e a luta diária pela sobrevivência. Conhecidos como Capitães da
                    Areia, eles encontram amizade e coragem enquanto tentam construir o próprio
                    destino. Um dos romances mais marcantes de Jorge Amado, que retrata a infância
                    e as desigualdades sociais no Brasil.
                </p>

                <dl class="detalhes-metadados">
                    <div><dt>Editora:</dt><dd>Companhia das Letras</dd></div>
                    <div><dt>Categoria:</dt><dd>Romance brasileiro</dd></div>
                    <div><dt>Publicado em:</dt><dd>1937</dd></div>
                </dl>

                <div class="detalhes-compra">
                    <p class="detalhes-preco"><span>R$</span> 24,99</p>
                    <a href="../carrinho.php" class="detalhes-comprar">Adicionar ao carrinho</a>
                </div>
            </div>
        </article>
    </main>
</body>
</html>