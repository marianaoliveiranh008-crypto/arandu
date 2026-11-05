<?php
    session_start();
    require_once "config/database.php";

    if(isset($_GET['id'])){
        $_SESSION['produto_pendente'] = [
            'id_liv' => $_GET['id']
        ];
        $_SESSION['url_retorno'] = 'carrinho.php';
    }elseif(isset($_GET['id_liv'])){
        $_SESSION['produto_pendente'] = [
            'id_liv' => $_GET['id_liv']
        ];
        $_SESSION['url_retorno'] = 'carrinho.php';
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if(empty($email) || empty($senha)){
            echo "Preencha todos os campos";
        }else{
            $sql = "SELECT id_usuario, nome, email, senha,  tipo_usuario FROM usuario WHERE email = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            $loginValido = false;
            if(password_verify($senha, $usuario['senha']) || $senha === $usuario['senha']) {
                $loginValido = true;
            }
            if($loginValido){
                $_SESSION['usuarioId'] = $usuario['id_usuario'];
                $_SESSION['usuarioNome'] = $usuario['nome'];
                $_SESSION['usuarioEmail'] = $usuario['email'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                $_SESSION['logado'] = true;

                $id_usuario = $usuario['id_usuario'];

                $sqlCar = "SELECT id_car FROM carrinho WHERE id_usuario = ?";
                $stmtCar = $conexao->prepare($sqlCar);
                $stmtCar->bind_param("i", $id_usuario);
                $stmtCar->execute();
                $resultadoCar = $stmtCar->get_result();

                if($resultadoCar->num_rows>0){
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
                    header("Location: ".$url_destino);
                }
                exit;
            }else{
                echo "E-mail ou senha incorretos.";
            }
        }else{
            echo "E-mail ou senha incorretos.";
        }
        $stmt->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Arandu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="login-page">
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

    <main class="container">
        <div class="caixa-login">
            <h1>Seja bem-vindo<br>à Arandu!</h1>

            <form method="POST">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <a href="verificarCodigo.php" class="esqueci">
                    Esqueci minha senha
                </a>

                <button type="submit">Entrar</button>
            </form>

            <p class="cadastro">
                Ainda não tem uma conta?
                <a href="cadastro.php">Cadastre-se</a>
            </p>
        </div>
    </main>
</body>
</html>