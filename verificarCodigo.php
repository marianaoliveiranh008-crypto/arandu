<?php
    session_start();
    require_once "config/database.php";

    if(!isset($_SESSION['codigo_verificacao']) || !isset($_SESSION['usuario_temp'])){
        header("Location: login.php");
        exit;
    }

    if(isset($_GET['reenviar'])){
        $_SESSION['codigo_verificacao'] = rand(100000, 999999);
    }

    $erro = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $codigoDig = trim($_POST['codigo'] ?? '');

        if($codigoDig == $_SESSION['codigo_verificacao']){
            $usuario = $_SESSION['usuario_temp'];
            $id_usuario = $usuario['id_usuario'];

            $_SESSION['usuarioId'] = $usuario['id_usuario'];
            $_SESSION['usuarioNome'] = $usuario['nome'];
            $_SESSION['usuarioEmail'] = $usuario['email'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            $_SESSION['logado'] = true;

            unset($_SESSION['codigo_verificacao']);
            unset($_SESSION['usuario_temp']);

            $sqlCar = "SELECT id_car FROM carrinho WHERE id_usuario = ?";
            $stmtCar = $conexao->prepare($sqlCar);
            $stmtCar->bind_param("i", $id_usuario);
            $stmtCar->execute();
            $resultadoCar = $stmtCar->get_result();

            if($resultadoCar->num_rows > 0){
                $carrinho = $resultadoCar->fetch_assoc();
                $id_car = $carrinho['id_car'];
            }else{
                $sqlCriar = "INSERT INTO carrinho (id_usuario) VALUES (?)";
                $stmtCriar = $conexao->prepare($sqlCriar);
                $stmtCriar->bind_param("i", $id_usuario);
                $stmtCriar->execute();
                $id_car = $conexao->insert_id;
                $stmtCriar->close();
            }
            $stmtCar->close();

            if(isset($_SESSION['produto_pendente']) && isset($_SESSION['produto_pendente']['id_liv'])){
                $id_livro = $_SESSION['produto_pendente']['id_liv'];
                $quantidade = 1;
                $sqlItem = "SELECT id_carit, quantidade_car FROM carrinho_item WHERE id_car = ? AND id_liv = ?";
                $stmtItem = $conexao->prepare($sqlItem);
                $stmtItem->bind_param("ii", $id_car, $id_livro);
                $stmtItem->execute();
                $resultadoItem = $stmtItem->get_result();


                if($resultadoItem->num_rows > 0){
                    $rowItem = $resultadoItem->fetch_assoc();
                    $novaQuantidade = $rowItem['quantidade_car'] + 1;
                    $id_carit = $rowItem['id_carit'];

                    $sqlUpdate = "UPDATE carrinho_item SET quantidade_car = ? WHERE id_carit = ?";
                    $stmtUp = $conexao->prepare($sqlUpdate);
                    $stmtUp->bind_param("ii", $novaQuantidade, $id_carit);
                    $stmtUp->execute();
                    $stmtUp->close();
                }else{
                    $sqlIns = "INSERT INTO carrinho_item (id_car, id_liv, quantidade_car) VALUES (?, ?, ?)";
                    $stmtIns = $conexao->prepare($sqlIns);
                    $stmtIns->bind_param("iii", $id_car, $id_livro, $quantidade);
                    $stmtIns->execute();
                    $stmtIns->close();
                }
                $stmtItem->close();
                unset($_SESSION['produto_pendente']);
            }

            $url_destino = $_SESSION['url_retorno'] ?? 'index.php';
            unset($_SESSION['url_retorno']);

            if($usuario['tipo_usuario'] == 2){
                header("Location: admin/index.php");
            }else{
                header("Location: " . $url_destino);
            }
            exit;
        }else{
            $erro = "Código de verificação incorreto.";
        }
    }
?>
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

   <main class="verificacao-main">
       <section class="caixa-verificacao">
           <h1>Verificação em 2 etapas</h1>
           <p class="descricao">
               Digite o código de 6 dígitos gerado abaixo para confirmar seu acesso:
           </p>

           <div style="background-color: #f4f4f4; border: 1px dashed #333; padding: 12px; margin: 15px 0; text-align: center; border-radius: 6px;">
               <span style="font-size: 14px; color: #555;">Seu código de verificação:</span><br>
               <strong style="font-size: 24px; letter-spacing: 4px; color: #000;">
                   <?php echo $_SESSION['codigo_verificacao']; ?>
               </strong>
           </div>

           <label class="rotulo-codigo" for="codigo">Código de verificação</label>
           <form method="POST">
               <input
                   class="campo-codigo"
                   id="codigo"
                   name="codigo"
                   type="text"
                   inputmode="numeric"
                   pattern="[0-9]{6}"
                   maxlength="6"
                   autocomplete="one-time-code"
                   aria-describedby="dica-codigo"
                   placeholder="Digite os 6 dígitos"
                   required
               />
               <button type="submit" class="verificacao-voltar">Verificar</button>
           </form>
            <br>
           <?php if (!empty($erro)) { ?>
               <p style="color:red;"><?php echo $erro; ?></p>
           <?php } ?>
           <br>
           <p class="dica-codigo" id="dica-codigo">
               Deseja gerar outro? <a href="verificarCodigo.php?reenviar=1">Gerar novo código</a>
           </p>

           <a href="login.php" class="verificacao-voltar">Voltar para o login</a>
       </section>
   </main>
</body>
</html>