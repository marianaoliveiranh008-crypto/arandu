<?php
    session_start();
    require_once 'config/database.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = trim($_POST['nome'] ?? '');
        $cpfLimpo   = preg_replace('/[^0-9]/', '',$_POST['cpf'] ?? '');
        $telefone   = preg_replace('/[^0-9]/', '',$_POST['telefone'] ?? '');
        $cepLimpo   = preg_replace('/[^0-9]/', '',$_POST['cep'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
        $confirmar = trim($_POST['confirmar'] ?? '');

        if(empty($nome) || empty($cpfLimpo) || empty($telefone) || empty($cepLimpo) || empty($email) || empty($senha) || empty($confirmar)) {
            echo "Por favor, preencha todos os campos corretamente.";
        }elseif($senha !== $confirmar){
            echo "As senhas não coincidem!";
        }elseif(strlen($senha)<6){
            echo "A senha deve ter pelo menos 6 caracteres.";
        }else{
            $sqlVerificar = "SELECT id_usuario FROM usuario WHERE email = ? OR cpf_usuario = ?";
            $stmtVerificar = $conexao->prepare($sqlVerificar);
            $stmtVerificar->bind_param("ss", $email, $cpfLimpo);
            $stmtVerificar->execute();
            $resultadoVerificar = $stmtVerificar->get_result();

            if($resultadoVerificar->num_rows>0){
                echo "E-mail ou CPF já cadastrados.";
                $stmtVerificar->close();
            }else{
                $stmtVerificar->close();
                
            $senhaHash = password_hash(
                $senha,
                PASSWORD_DEFAULT
            );

            $conexao->begin_transaction();

            try{
                $sqlInsertUsuario = "INSERT INTO usuario (nome, email, senha, telefone, cpf_usuario) VALUES (?, ?, ?, ?, ?)";
                $stmtUsuario = $conexao->prepare($sqlInsertUsuario);
                $stmtUsuario->bind_param(
                    "sssss",
                    $nome,
                    $email,
                    $senhaHash,
                    $telefone,
                    $cpfLimpo
                );
                $stmtUsuario->execute();
                $idUsuarioCriado = $conexao->insert_id;
                $stmtUsuario->close();

                $sqlInsertEndereco = "INSERT INTO endereco (cep, id_usuario) VALUES (?, ?)";
                $stmtEndereco = $conexao->prepare($sqlInsertEndereco);
                $stmtEndereco->bind_param(
                    "si",
                    $cepLimpo,
                    $idUsuarioCriado
                );
                $stmtEndereco->execute();
                $stmtEndereco->close();

                $conexao->commit();

                $_SESSION['usuario_id'] = $idUsuarioCriado;
                    $_SESSION['usuario_nome'] = $nome;

                    if(isset($_SESSION['produto_pendente'])){
                        $produto = $_SESSION['produto_pendente'];
                        $id_livro = $produto['id_livro'];

                        if(isset($_SESSION['carrinho'][$id_livro])){
                            $_SESSION['carrinho'][$id_livro]['quantidade'] += 1;
                        }else{
                            $_SESSION['carrinho'][$id_livro] = [
                                'nome'       => $produto['nome'],
                                'preco'      => $produto['preco'],
                                'imagem'     => $produto['imagem'],
                                'autor'      => $produto['autor'],
                                'quantidade' => 1
                            ];
                        }

                        unset($_SESSION['produto_pendente']);
                    }

                    $url_destino = $_SESSION['url_retorno'] ?? 'detalhes.php';
                    unset($_SESSION['url_retorno']);

                    $_SESSION['sucesso'] = "Conta criada com sucesso!";
                    header("Location: " . $url_destino);
                    exit;

                }catch(Exception $e){
                    $conexao->rollback();
                    echo "Erro ao realizar o cadastro. Tente novamente.";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Arandu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="cadastro-page">
    <header class="top-header login-header">
        <a class="brand" href="index.php" aria-label="Arandu - página inicial">
            <img src="img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="index.php">Home</a>
            <a href="sobreNos.php">Sobre nós</a>
            <a href="#">+ Procurados</a>
            <a href="#">Novidades</a>
        </nav>
    </header>

    <main class="container">
        <div class="caixa-login">
            <h1>Crie sua conta<br>na Arandu!</h1>

            <form action="cadastro.php" method="POST">
                <div class="campo-cadastro campo-cadastro--wide">
                    <label for="nome">Nome completo:</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome" required>
                </div>

                <div class="campo-cadastro">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                </div>

                <div class="campo-cadastro">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                </div>

                <div class="campo-cadastro">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" placeholder="00000-000" required>
                </div>

                <div class="campo-cadastro campo-cadastro--wide">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="campo-cadastro">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="••••••••" required>
                </div>

                <div class="campo-cadastro">
                    <label for="confirmar">Confirmar senha:</label>
                    <input type="password" id="confirmar" name="confirmar" placeholder="••••••••" required>
                </div>

                <input type="hidden" id="rua" name="rua">
                <input type="hidden" id="numero" name="numero" value="">
                <input type="hidden" id="complemento" name="complemento" value="">
                <input type="hidden" id="bairro" name="bairro">
                <input type="hidden" id="cidade" name="cidade">
                <input type="hidden" id="estado" name="estado">

                <button class="cadastro-submit" type="submit">Cadastrar</button>
            </form>

            <p class="cadastro">
                Já tem uma conta?
                <a href="login.php">Entrar</a>
            </p>
        </div>

        <nav class="cadastro-links" aria-label="Links institucionais">
            <a href="#">Termos de uso</a>
            <a href="#">Política de privacidade</a>
            <a href="#">Contato</a>
        </nav>
    </main>
</body>
</html>