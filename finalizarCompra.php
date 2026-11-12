<?php
    session_start();
    require_once "config/database.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $pagamento = $_POST['pagamento'] ?? '';

        if($pagamento == 'pix'){
            header("Location: pagamentoPix.php");
            exit;
        }elseif($pagamento == 'credito'){
            header("Location: pagamentoCredito.php");
            exit;
        }elseif($pagamento == 'debito'){
            header("Location: pagamentoDebito.php");
            exit;
        }
    }

    $id_usuario = $_SESSION['usuarioId'] ?? $_SESSION['usuario_id'] ?? $_GET['id_usuario'] ?? $_GET['id'] ?? null;
    
    if(!$id_usuario){
        die("Erro: Nenhum usuário logado ou identificado.");
    }
    
    $sqlEnd = "SELECT e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep 
               FROM usuario u 
               LEFT JOIN endereco e ON u.id_usuario = e.id_usuario 
               WHERE u.id_usuario = ?";
            
    $stmtEnd = $conexao->prepare($sqlEnd);
    $stmtEnd->bind_param("i", $id_usuario);
    $stmtEnd->execute();
    $resultadoEnd = $stmtEnd->get_result();
    $cliente = $resultadoEnd->fetch_assoc();
    $stmtEnd->close();

    $subtotal = 0;
    if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
        foreach($_SESSION['carrinho'] as $item){
            $subtotal += ($item['preco'] * $item['quantidade']);
        }
    }
    $cepDestino = '';
    if(!empty($cliente['cep'])){
        $cepDestino = preg_replace('/[^0-9]/', '', $cliente['cep']);
    }

    $valorFrete = 0.00;
    if(!empty($cepDestino) && strlen($cepDestino) === 8 && $subtotal > 0){
        $primeiroDigito = intval(substr($cepDestino, 0, 1));
        if($primeiroDigito >= 8){
            $valorFrete = 10.00;
        }elseif($primeiroDigito >= 0 && $primeiroDigito <= 3){
            $valorFrete = 20.00;
        }else{
            $valorFrete = 30.00;
        }
    }

    $totalGeral = $subtotal + $valorFrete;

    $id_livro = $_GET['id_livro'] ?? 1;

    $sqlLivro = "SELECT l.*, ed.nome_edi,
                GROUP_CONCAT(DISTINCT c.nome_cat SEPARATOR ', ') AS nome_cat, 
                GROUP_CONCAT(DISTINCT a.nome_aut SEPARATOR ', ') AS autor
                FROM livro l
                LEFT JOIN editora ed ON l.id_edi = ed.id_edi
                LEFT JOIN liv_cat lc ON l.id_liv = lc.id_liv
                LEFT JOIN categoria c ON lc.id_cat = c.id_cat
                LEFT JOIN liv_aut la ON l.id_liv = la.id_liv 
                LEFT JOIN autor a ON la.id_aut = a.id_aut
                WHERE l.id_liv = ?
                GROUP BY l.id_liv";
        $stmtLivro = $conexao->prepare($sqlLivro);
        $stmtLivro->bind_param("i", $id_livro);
        $stmtLivro->execute();
        $resultadoLivro = $stmtLivro->get_result();
        $livro = $resultadoLivro->fetch_assoc();
        $stmtLivro->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar compra - Arandu</title>
    <link rel="stylesheet" href="css/style.css?v=6">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="carrinho-page finalizar-compra-page">
    <header class="top-header">
        <div class="brand">
            <img src="img/logo.png" alt="Arandu">
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="maisProcurados.php">+ Procurados</a>
            <a href="novidades.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="header-actions">
                <div class="user-tools">
                    <a href="carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                        <span aria-hidden="true">🛍</span>
                    </a>
                    <a href="login.php" class="header-button login-link">Entrar</a>
                    <a href="usuario/perfil.php" class="header-button admin-link">
                        <span aria-hidden="true">👤</span>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="conteudo">
        <section class="carrinho caixa-finalizar" aria-labelledby="titulo-finalizar">
            <h1 id="titulo-finalizar">Finalize sua compra</h1>

            <section class="secao-finalizar" aria-labelledby="titulo-endereco">
                <h2 id="titulo-endereco">Endereço de entrega</h2>
                <address class="endereco-entrega">
                    <?php if (!empty($cliente['rua'])): ?>
                    <p><?= htmlspecialchars($cliente['rua']) ?>, 
                    <?= htmlspecialchars($cliente['numero']) ?>,
                    <?= htmlspecialchars($cliente['complemento']) ?></p>
                    <p><?= htmlspecialchars($cliente['bairro']) ?>, 
                    <?= htmlspecialchars($cliente['cidade']) ?> —
                    <?= htmlspecialchars($cliente['estado']) ?> </p>
                    <p>CEP: <?= htmlspecialchars($cliente['cep']) ?></p>
                <?php else: ?>
                    Nenhum endereço cadastrado.
                <?php endif; ?>
                </address>
                <button class="botao-alterar-endereco" type="button">Alterar endereço</button>
            </section>
            <br>
            <form action="finalizarCompra.php" method="POST">
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
            <br>

            <section class="secao-finalizar" aria-labelledby="titulo-resumo">
                <h2 id="titulo-resumo">Resumo do pedido</h2>
                    <article class="finalizar-card">
                        <img
                            class="finalizar-capa"
                            src="<?= htmlspecialchars($livro['imagem'] ?? '') ?>"
                            alt="Capa do livro <?= htmlspecialchars($livro['titulo_liv'] ?? '') ?>">

                        <div class="finalizar-conteudo">
                            <h3 class="finalizar-titulo"><?= htmlspecialchars($livro['titulo_liv'] ?? '') ?></h3>
                            <p class="finalizar-autor">Por: <?= htmlspecialchars($livro['autor'] ?? '') ?></p>
                            <p class="finalizar-qntd">Quantidade: <?= htmlspecialchars($item['quantidade'] ?? '') ?></p>
                            <span class="finalizar-preco">R$ <?= number_format($livro['preco'], 2, ',', '.') ?></span>
                        </div>
                    </article>
                    <br>
                    <div class="finalizar-total">
                        <div class="total-row">
                            <span>Subtotal</span>
                            <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                        </div>
                        <div class="total-row">
                            <span>Frete</span>
                            <span>R$ <?= number_format($valorFrete, 2, ',', '.') ?></span>
                        </div>
                        <div class="total-row total-final">
                            <span>Total</span>
                            <span>R$ <?= number_format($totalGeral, 2, ',', '.') ?></span>
                        </div>
                    </div>
            </section>
            <br>
            <button class="botao-alterar-endereco" type="submit">Confirmar compra</button>
            </form>
        </section>
         <nav class="cadastro-links" aria-label="Links institucionais">
            <a href="termosDeUso.php">Termos de uso</a>
            <a href="politicaDePrivacidade.php">Política de privacidade</a>
        </nav>
    </main>    
</body>
</html>