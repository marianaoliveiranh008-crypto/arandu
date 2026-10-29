<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nós</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="sobre-page">
    <header class="top-header login-header">
        <a class="brand" href="index.php" aria-label="Arandu - página inicial">
			<img src="img/logo.png" alt="Arandu">
		</a>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="maisProcurados.php">+ Procurados</a>
            <a href="novidades.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="user-tools">
                <a href="carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                    <span aria-hidden="true">🛍</span>
                    <span></span>
                    <span class="cart-count">0</span>
                </a>
                <a href="login.php" class="header-button login-link">Entrar</a>
                <a href="usuario/perfil.php" class="header-button admin-link">
                    <span aria-hidden="true">👤</span>
                    <span></span>
                </a>
            </div>
        </div>
    </header>

	<main class="sobre-container">
		<section class="sobre-box" aria-labelledby="sobre-titulo">
			<div class="sobre-texto">
				<p class="sobre-eyebrow">Nossa livraria</p>
				<h1 id="sobre-titulo">Histórias que aproximam pessoas.</h1>
				<p>Arandu significa sabedoria, conhecimento ou entendimento na língua guarani.
Este projeto consiste no desenvolvimento de um site de livraria online voltado exclusivamente para a literatura brasileira. A plataforma tem como objetivo disponibilizar obras de autores nacionais, proporcionando aos usuários uma forma prática e organizada de conhecer, pesquisar e adquirir livros.
O sistema busca também valorizar a produção literária brasileira, reunindo diferentes gêneros, autores e obras em um único ambiente digital. Dessa forma, pretende-se oferecer uma experiência simples e acessível aos leitores, além de facilitar a divulgação e o acesso à literatura nacional.
</p>
				<p></p>
			</div>

			<aside class="sobre-contatos" aria-labelledby="contato-titulo">
				<h2 id="contato-titulo">Fale com a gente</h2>
				<p class="contato-aviso">Entre em contato conosco através dos canais abaixo:</p>

				<dl>
					<div>
						<dt>E-mail</dt>
						<dd><a>contato@livrariaarandu.com</a></dd>
					</div>
					<div>
						<dt>Contato</dt>
						<dd><a>(51) 99999-2026</a></dd>
					</div>
					<div>
						<dt>Instagram</dt>
						<dd><a>@livrariaarandu</a></dd>
					</div>
					<div>
						<dt>Endereço</dt>
						<dd>Rua das Letras, 211, Novo Hamburgo - RS</dd>
					</div>
				</dl>
			</aside>
		</section>

		<nav class="cadastro-links sobre-links" aria-label="Links institucionais">
			<a href="#">Termos de uso</a>
			<a href="#">Política de privacidade</a>
			<a href="#contato-titulo">Contato</a>
		</nav>
	</main>
</body>
</html>
