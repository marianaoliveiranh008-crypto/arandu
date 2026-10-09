<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação - ARANDU</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>

<body class="verificacao-page">
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

    <main class="verificacao-main">
        <section class="caixa-verificacao">
            <h1>Verificação em 2 etapas</h1>
            <p class="descricao">
                Enviamos um código de 6 dígitos para o e-mail cadastrado.
            </p>

            <label class="rotulo-codigo" for="codigo">Código de verificação</label>
            <input
                class="campo-codigo"
                id="codigo"
                type="text"
                inputmode="numeric"
                pattern="[0-9]{6}"
                maxlength="6"
                autocomplete="one-time-code"
                aria-describedby="dica-codigo"
                placeholder="Digite os 6 dígitos"
            >
            <p class="dica-codigo" id="dica-codigo">
                Não recebeu o código? <a href="">Reenviar código</a>
            </p>

            <a href="login.php" class="verificacao-voltar">Voltar para o login</a>
        </section>
    </main>
</body>
</html>