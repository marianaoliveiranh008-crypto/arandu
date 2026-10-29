<?php
    session_start();

    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = [];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'adicionar'){
        if(!isset($_SESSION['usuario_id'])){    
            $_SESSION['produto_pendente']=[
                $id = trim($_POST['id_livro']),
                $nome = trim($_POST['nome']),
                $preco = $_POST['preco'],
                $imagem = trim($_POST['imagem']),
                $autor = trim($_POST['autor'])
            ];
            
            $_SESSION['url_retorno'] = $_SERVER['HTTP_REFERER'] ?? 'detalhes.php';
            
            header("Location: login.php");
            exit;
        }

        $id = trim($_POST['id_livro']);
        $nome = trim($_POST['nome']);
        $preco = $_POST['preco'];
        $imagem = trim($_POST['imagem']);
        $autor = trim($_POST['autor']);

        if(isset($_SESSION['carrinho'][$id])){
            $_SESSION['carrinho'][$id]['quantidade'] += 1;
        }else{
            $_SESSION['carrinho'][$id] = [
                'nome'=>$nome,
                'preco'=>$preco,
                'imagem'=>$imagem,
                'autor'=>$autor,
                'quantidade'=>1
            ];
        }

        header ("Location: carrinho.php");
        exit;
    }

    if(isset($_GET['acao']) && isset($_GET['id'])){
        $id = $_GET['id'];
        $acao = $_GET['acao'];

        if(isset($_SESSION['carrinho'][$id])){
            if($acao === 'aumentar'){
                $_SESSION['carrinho'][$id]['quantidade'] += 1;
            }elseif($acao === 'diminuir'){
                $_SESSION['carrinho'][$id]['quantidade'] -= 1;
                
                if ($_SESSION['carrinho'][$id]['quantidade'] <= 0) {
                unset($_SESSION['carrinho'][$id]);
                }
            }elseif($acao === 'remover'){
                unset($_SESSION['carrinho'][$id]);
            }
        }
        header("Location: carrinho.php");
        exit;
    }

    $subtotal = 0;
    $totalItens = 0;

    foreach($_SESSION['carrinho'] as $item){
        $subtotal += $item['preco'] * $item['quantidade'];
        $totalItens += $item['quantidade'];
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - Arandu</title>
    <link rel="stylesheet" href="css/style.css?v=4">
</head>
<body class="carrinho-page">

    <header class="cabecalho">
        <div class="logo">
            <a href="index.php" aria-label="Arandu - página inicial">
                <img src="img/logo.png" alt="Arandu">
            </a>
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="maisProcurados.php">+ Procurados</a>
            <a href="novidades.php">Novidades</a>
        </nav>

        <div class="icones" aria-label="Atalhos da conta">
            <a href="carrinho.php" title="Carrinho" aria-label="Carrinho">🛍</a>
            <a href="login.php" title="Entrar" aria-label="Entrar">♙</a>
        </div>
    </header>

    <main class="conteudo">
        <section class="carrinho">
            <h1>Meu carrinho</h1>

           <?php if (empty($_SESSION['carrinho'])): ?>
                <div class="carrinho-vazio" style="padding: 20px 0;">
                    <p>Seu carrinho está vazio no momento.</p>
                    <a href="index.php" style="text-decoration: underline;">Voltar às compras</a>
                </div>
            <?php else: ?>
                <?php foreach ($_SESSION['carrinho'] as $id => $item): ?>
                    <div class="livro">
                        <img src="<?= htmlspecialchars($item['imagem']) ?>" alt="Capa do livro <?= htmlspecialchars($item['nome']) ?>">

                        <div class="informacoes">
                            <h2><?= htmlspecialchars($item['nome']) ?></h2>
                            <p class="autor">Por: <?= htmlspecialchars($item['autor']) ?></p>

                            <div class="quantidade">
                                <a href="carrinho.php?acao=diminuir&id=<?= urlencode($id) ?>" style="text-decoration:none;" aria-label="Diminuir quantidade">-</a>
                                <span><?= $item['quantidade'] ?></span>
                                <a href="carrinho.php?acao=aumentar&id=<?= urlencode($id) ?>" style="text-decoration:none;" aria-label="Aumentar quantidade">+</a>
                            </div>

                            <div class="preco">
                                <span>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></span>
                                <a href="carrinho.php?acao=remover&id=<?= urlencode($id) ?>" class="excluir" style="text-decoration:none;" aria-label="Remover item">Excluir</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="resumo">
                    <p><span>Subtotal</span><strong>R$ <?= number_format($subtotal, 2, ',', '.') ?></strong></p>
                    <p><span>Frete</span><strong>A calcular</strong></p>
                    <p class="resumo-total"><span>Total</span><strong>R$ <?= number_format($subtotal, 2, ',', '.') ?></strong></p>
                </div>

                <div class="botoes">
                    <button type="button">Calcular frete</button>
                    <a href="finalizarCompra.php">Finalizar compra</a>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>