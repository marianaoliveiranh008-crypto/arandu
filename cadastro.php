<?php
    session_start();
    require_once 'config/database.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = trim($_POST['nome'] ?? '');
        $cpfLimpo   = preg_replace('/[^0-9]/', '',$_POST['cpf'] ?? '');
        $telefone   = preg_replace('/[^0-9]/', '',$_POST['telefone'] ?? '');
        $cepLimpo   = preg_replace('/[^0-9]/', '',$_POST['cep'] ?? '');
        $rua = trim($_POST['rua'] ?? '');
        $numero = trim($_POST['numero'] ?? '');
        $complemento = trim($_POST['complemento'] ?? '');
        $bairro = trim($_POST['bairro'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');
        $estado = trim($_POST['estado'] ?? '');
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

                $sqlInsertEndereco = "INSERT INTO endereco (rua, numero, complemento, bairro, cidade, estado, cep, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmtEndereco = $conexao->prepare($sqlInsertEndereco);
                $stmtEndereco->bind_param(
                    "sssssssi",
                    $rua,
                    $numero,
                    $complemento,
                    $bairro,
                    $cidade,
                    $estado,
                    $cepLimpo,
                    $idUsuarioCriado
                );
                $stmtEndereco->execute();
                $stmtEndereco->close();

                $conexao->commit();

                $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
                header("Location: index.php");
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
            <a href="#">Sobre nós</a>
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

            <script>
                const cep = document.getElementById("cep");
                cep.addEventListener("blur", buscarCEP);

                async function buscarCEP(){
                    let valorCEP = cep.value.replace(/\D/g,'');
                    if(valorCEP.length != 8){
                        alert("CEP inválido!");
                        return;
                    }try{
                        const resposta = await fetch(`https://viacep.com.br/ws/${valorCEP}/json/`);
                        const dados = await resposta.json();
                        if(dados.erro){
                            alert("CEP não encontrado.");
                            return;
                        }
                        document.getElementById("rua").value = dados.logradouro;
                        document.getElementById("bairro").value = dados.bairro;
                        document.getElementById("cidade").value = dados.localidade;
                        document.getElementById("estado").value = dados.uf;
                    }catch(erro){
                        alert("Erro ao consultar a API.");
                    }
                }
            </script>

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