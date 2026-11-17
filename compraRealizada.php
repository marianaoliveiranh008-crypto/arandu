<?php
    session_start();
    require_once "config/database.php";

    $id_usuario = $_SESSION['usuarioId'] ?? $_SESSION['usuario_id'] ?? null;
    if(!$id_usuario){
        die("Erro: Usuário não identificado.");
    }

    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $metodo_pagamento = $_POST['metodo_pagamento'] ?? 'desconhecido';

        $sqlEnd = "SELECT id_end, cep FROM endereco WHERE id_usuario = ? LIMIT 1";
        $stmtEnd = $conexao->prepare($sqlEnd);
        $stmtEnd->bind_param("i", $id_usuario);
        $stmtEnd->execute();
        $resultadoEnd = $stmtEnd->get_result();
        $endereco = $resultadoEnd->fetch_assoc();
        $stmtEnd->close();

        $id_end = $endereco['id_end'] ?? null;

        if(!$id_end) {
            die("Erro: Endereço não encontrado para finalizar o pedido.");
        }

        if(empty($_SESSION['carrinho'])){
            header("Location: carrinho.php");
            exit;
        }

        $subtotal = 0;
        foreach($_SESSION['carrinho'] as $item){
            $subtotal += ($item['preco'] * $item['quantidade']);
        }

        $cepDestino = preg_replace('/[^0-9]/', '', $endereco['cep'] ?? '');
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

        $conexao->begin_transaction();

        try{
            $sqlPedido = "INSERT INTO pedido (status_pe, valor_total, valor_frete, id_end, id_usuario) VALUES ('Aprovado', ?, ?, ?, ?)";
            $stmtPedido = $conexao->prepare($sqlPedido);
            $stmtPedido->bind_param("ddii", $totalGeral, $valorFrete, $id_end, $id_usuario);
            $stmtPedido->execute();
            $id_ped = $stmtPedido->insert_id;
            $stmtPedido->close();

            foreach($_SESSION['carrinho'] as $id_liv => $item){
                $quantidade = $item['quantidade'];
                $preco = $item['preco'];

                $sqlItem = "INSERT INTO pedido_item (quantidade_ped, preco_unit, id_ped, id_liv) VALUES (?, ?, ?, ?)";
                $stmtItem = $conexao->prepare($sqlItem);
                $stmtItem->bind_param("idii", $qtd, $preco, $id_ped, $id_liv);
                $stmtItem->execute();
                $stmtItem->close();

                $sqlEstoque = "UPDATE livro SET quanti_estoq = quanti_estoq - ? WHERE id_liv = ?";
                $stmtEstoque = $conexao->prepare($sqlEstoque);
                $stmtEstoque->bind_param("ii", $quantidade, $id_liv);
                $stmtEstoque->execute();
                $stmtEstoque->close();
            }

            $sqlPagamento = "INSERT INTO pagamento (metodo_pag, status_pag, data_pag, id_ped) VALUES (?, 'Aprovado', NOW(), ?)";
            $stmtPagamento = $conexao->prepare($sqlPagamento);
            $stmtPagamento->bind_param("si", $metodo_pagamento, $id_ped);
            $stmtPagamento->execute();
            $stmtPagamento->close();

            $conexao->commit();

            unset($_SESSION['carrinho']);

            $sqlDelCarrinho = "DELETE ci FROM carrinho_item ci INNER JOIN carrinho c ON ci.id_car = c.id_car WHERE c.id_usuario = ?";
            $stmtDel = $conexao->prepare($sqlDelCarrinho);
            $stmtDel->bind_param("i", $id_usuario);
            $stmtDel->execute();
            $stmtDel->close();
        }catch(Exception $e){
            $conexao->rollback();
            die("Erro ao concluir a compra: " . $e->getMessage());
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimento - Arandu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="perfil-page compra-realizada-page">
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

    <main class="compra-realizada-conteudo">
        <h1>Obrigada por comprar conosco!</h1>
        <a href="index.php"><button>Procurar novas histórias</button></a>
    </main>
</body>
</html>