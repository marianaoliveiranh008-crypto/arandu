<?php
    session_start();
    require_once '../config/database.php';

    if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true){
        header("Location: login.php");
        exit;
    }

    $id_usuario = $_SESSION['usuarioId'];

    $endereco = ['rua' => '', 'numero' => '', 'complemento' => '', 'bairro' => '', 'cidade' => '', 'estado' => '', 'cep' => ''];

    $sql = "SELECT * FROM endereco WHERE id_usuario = ? LIMIT 1";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows === 1){
        $endereco = $resultado->fetch_assoc();
    }

    $stmt->close();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $cep = $_POST['cep'] ?? '';
        $rua = $_POST['rua'] ?? '';
        $numero = $_POST['numero'] ?? '';
        $complemento = $_POST['complemento'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $estado = $_POST['estado'] ?? '';

        $sqlUp = "UPDATE endereco SET rua = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id_usuario = ?";
        $stmtUp = $conexao->prepare($sqlUp);
        
        if(!$stmtUp){
            die("Erro ao preparar consulta: " . $conexao->error);
        }

        $stmtUp->bind_param("sssssssi", $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep, $id_usuario);
            
        if($stmtUp->execute()){
            header("Location: perfil.php");
            exit;
        }else{
            $erro = "Erro ao atualizar o endereço: " . $stmtUp->error;
        }
        $stmtUp->close();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar endereço - Arandu</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="senha-page">
    <header class="top-header">
        <div class="brand">
            <img src="../img/logo.png" alt="Arandu">
        </div>

        <nav class="nav-menu" aria-label="Menu principal">
            <a href="../index.php">Home</a>
            <a href="../sobreNos.php">Sobre nós</a>
            <a href="../maisProcurados.php">+ Procurados</a>
            <a href="../novidades.php">Novidades</a>
        </nav>

        <div class="header-actions">
            <div class="header-actions">
                <div class="user-tools">
                    <a href="../carrinho.php" class="header-button cart-link" aria-label="Carrinho de compras">
                        <span aria-hidden="true">🛍</span>
                    </a>
                    <a href="../login.php" class="header-button login-link">Entrar</a>
                    <a href="perfil.php" class="header-button admin-link">
                        <span aria-hidden="true">👤</span>
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container senha-container">
        <section class="caixa-login" aria-labelledby="titulo-alterar-senha">

            <h1 id="titulo-alterar-senha">Editar endereço</h1>
            <form method="post">
                <div class="campo-cadastro">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($endereco['cep']) ?>"placeholder="00000-000" required>
                </div>

                <div>
                    <label for="rua">Rua:</label>
                    <input type="text" id="rua" name="rua" value="<?= htmlspecialchars($endereco['rua']) ?>"placeholder="Hipotética" required>
                </div>

                <div>
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" value="<?= htmlspecialchars($endereco['numero']) ?>"placeholder="0000" required>
                </div>

                <div>
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" value="<?= htmlspecialchars($endereco['complemento']) ?>" placeholder="Casa/Apartamento/Condomínio" required>
                </div>

                <div>
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($endereco['bairro']) ?>" placeholder="Hipotético" required>
                </div>

                <div>
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($endereco['cidade']) ?>" placeholder="Hipotética" required>
                </div>

                <div>
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($endereco['estado']) ?>" placeholder="Hipotético" required>
                </div>

                <button class="cadastro-submit" type="submit">Salvar</button>
            </form>

        </section>
    </main>

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

</body>
</html>