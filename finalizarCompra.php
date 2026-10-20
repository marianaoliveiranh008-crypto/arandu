<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar compra - Arandu</title>
    <link rel="stylesheet" href="css/style.css?v=6">
</head>
<body class="carrinho-page finalizar-compra-page">
    <header class="cabecalho">
        <div class="logo">
            <a href="index.php" aria-label="Arandu - página inicial">
                <img src="img/logo.png" alt="Arandu">
            </a>
        </div>

        <nav class="carrinho-nav" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="#">+ Procurados</a>
            <a href="#">Novidades</a>
        </nav>

        <div class="icones" aria-label="Atalhos da conta">
            <a href="carrinho.php" title="Carrinho" aria-label="Carrinho">🛍</a>
            <a href="login.php" title="Entrar" aria-label="Entrar">♙</a>
        </div>
    </header>

    <main class="conteudo">
        <section class="carrinho caixa-finalizar" aria-labelledby="titulo-finalizar">
            <h1 id="titulo-finalizar">Finalize sua compra</h1>

            <section class="secao-finalizar" aria-labelledby="titulo-endereco">
                <h2 id="titulo-endereco">Endereço de entrega</h2>
                <address class="endereco-entrega">
                    Rua Exemplo, 123 - Centro<br>
                    Cidade - UF<br>
                    CEP: 00000-000
                </address>
                <button class="botao-alterar-endereco" type="button">Alterar endereço</button>
            </section>

            <fieldset class="secao-finalizar opcoes-pagamento">
                <legend>Formas de pagamento</legend>

                <label class="opcao-pagamento">
                    <input type="radio" name="pagamento" value="pix" checked>
                    <span>Pix</span>
                </label>

                <label class="opcao-pagamento">
                    <input type="radio" name="pagamento" value="credito">
                    <span>Cartão de crédito</span>
                </label>

                <label class="opcao-pagamento">
                    <input type="radio" name="pagamento" value="debito">
                    <span>Cartão de débito</span>
                </label>
            </fieldset>
        </section>
         <nav class="cadastro-links" aria-label="Links institucionais">
            <a href="#">Termos de uso</a>
            <a href="#">Política de privacidade</a>
            <a href="#">Contato</a>
        </nav>
    </main>
</body>
</html>