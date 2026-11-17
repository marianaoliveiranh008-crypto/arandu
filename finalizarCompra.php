<?php
    session_start();
    require_once "config/database.php";

    $id_usuario = $_SESSION['usuarioId'] ?? $_SESSION['usuario_id'] ?? $_GET['id_usuario'] ?? $_GET['id'] ?? null;
    if(!$id_usuario){
        die("Erro: Nenhum usuário logado ou identificado.");
    }

    $sqlEnd = "SELECT e.id_end, e.rua, e.numero, e.complemento, e.bairro, e.cidade, e.estado, e.cep 
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

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pagamento'])){
        $pagamento = $_POST['pagamento'] ?? '';
        $id_end = $cliente['id_end'] ?? null;

        if(!$id_end){
            die("Erro: Você precisa cadastrar um endereço de entrega antes de finalizar a compra.");
        }

        if(empty($_SESSION['carrinho'])){
            header("Location: carrinho.php");
            exit;
        }
        $conexao->begin_transaction();

        try{
            $sqlPedido = "INSERT INTO pedido (status_pe, valor_total, valor_frete, id_end, id_usuario) VALUES ('Pendente', ?, ?, ?, ?)";
            $stmtPedido = $conexao->prepare($sqlPedido);
            $stmtPedido->bind_param("ddii", $totalGeral, $valorFrete, $id_end, $id_usuario);
            $stmtPedido->execute();
            $id_ped = $stmtPedido->insert_id;
            $stmtPedido->close();

            foreach($_SESSION['carrinho'] as $id_liv => $item){
                $quantidade = $item['quantidade'];
                $preco_unit = $item['preco'];

                $sqlItemPedido = "INSERT INTO pedido_item (quantidade_ped, preco_unit, id_ped, id_liv) VALUES (?, ?, ?, ?)";
                $stmtItemPedido = $conexao->prepare($sqlItemPedido);
                $stmtItemPedido->bind_param("idii", $quantidade, $preco_unit, $id_ped, $id_liv);
                $stmtItemPedido->execute();
                $stmtItemPedido->close();

                $sqlEstoque = "UPDATE livro SET quanti_estoq = quanti_estoq - ? WHERE id_liv = ?";
                $stmtEstoque = $conexao->prepare($sqlEstoque);
                $stmtEstoque->bind_param("ii", $quantidade, $id_liv);
                $stmtEstoque->execute();
                $stmtEstoque->close();
            }

            $sqlPag = "INSERT INTO pagamento (metodo_pag, status_pag, data_pag, id_ped) VALUES (?, 'Pendente', NOW(), ?)";
            $stmtPag = $conexao->prepare($sqlPag);
            $stmtPag->bind_param("si", $pagamento, $id_ped);
            $stmtPag->execute();
            $stmtPag->close();

            $conexao->commit();

            $sqlDelCarrrinho = "DELETE ci FROM carrinho_item ci INNER JOIN carrinho c ON ci.id_car = c.id_car WHERE c.id_usuario = ?";
            $stmtDel = $conexao->prepare($sqlDelCarrrinho);
            $stmtDel->bind_param("i", $id_usuario);
            $stmtDel->execute();
            $stmtDel->close();

            unset($_SESSION['carrinho']);

            if($pagamento == 'pix'){
                header("Location: pagamentoPix.php?id_ped=".$id_ped);
                exit;
            }elseif($pagamento == 'credito'){
                header("Location: pagamentoCredito.php?id_ped=".$id_ped);
                exit;
            }elseif($pagamento == 'debito'){
                header("Location: pagamentoDebito.php?id_ped=".$id_ped);
                exit;
            }else{
                header("Location: index.php");
                exit;
            }
        }catch(Exception $e) {
            $conexao->rollback();
            die("Erro ao processar o pedido: " . $e->getMessage());
        }
    }
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
                    <a href="carrinho.php" aria-label="Carrinho de compras" class="carrinho-perfil-png">
                        <img src="img/carrinho.png" alt="Arandu">
                    </a>
                    <a href="usuario/perfil.php" aria-label="Perfil do usuário" class="carrinho-perfil-png">
                        <img src="img/perfil.png" alt="Arandu">
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
                <a href="usuario/editarEndereco.php"><button class="botao-alterar-endereco" type="button">Alterar endereço</button></a>
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
                <?php if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])): ?>
                <?php foreach($_SESSION['carrinho'] as $item): ?>
                    <article class="finalizar-card">
                        <img
                            class="finalizar-capa"
                            src="<?=htmlspecialchars($item['imagem'] ?? '') ?>"
                            alt="Capa do livro <?=htmlspecialchars($item['titulo_liv'] ?? '')?>">

                        <div class="finalizar-conteudo">
                            <h3 class="finalizar-titulo" style="font-size: 1rem;"><?= htmlspecialchars($item['nome'] ?? '') ?></h3>
                            <p class="finalizar-autor" style="font-size: 0.9rem;">Por: <?= htmlspecialchars($item['autor'] ?? '') ?></p>
                            <p class="finalizar-qntd">Quantidade: <?= htmlspecialchars($item['quantidade'] ?? '') ?></p>
                            <span class="finalizar-preco">R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></span>
                        </div>
                    </article>
                    <?php endforeach; ?>
                    <?php else: ?><p>Seu carrinho está vazio. <a href="carrinho.php">Voltar ao carrinho</a></p><?php endif; ?>
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