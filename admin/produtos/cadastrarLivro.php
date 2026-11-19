<?php
    session_start();
    require_once "../../config/database.php";

    $erro = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $titulo = $_POST['titulo_liv'] ?? '';
        $isbn = $_POST['isbn'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $estoque = $_POST['quanti_estoq'] ?? 0;
        $paginas = !empty($_POST['numero_pag']) ? $_POST['numero_pag'] : null;
        $ano = !empty($_POST['ano_public']) ? $_POST['ano_public'] : null;
        $imagem = $_POST['imagem'] ?? '';
        $nome_editora = trim($_POST['nome_edi'] ?? '');
        $nome_autor = trim($_POST['nome_aut'] ?? '');

        $id_edi = null;
        if(!empty($nome_editora)){
            $stmtEdi = $conexao->prepare("SELECT id_edi FROM editora WHERE nome_edi = ?");
            $stmtEdi->bind_param("s", $nome_editora);
            $stmtEdi->execute();
            $resultadoEdi = $stmtEdi->get_result();

            if($rowEdi = $resultadoEdi->fetch_assoc()){
                $id_edi = $rowEdi['id_edi'];
            }else{
                $stmtInsEdi = $conexao->prepare("INSERT INTO editora (nome_edi) VALUES (?)");
                $stmtInsEdi->bind_param("s", $nome_editora);
                $stmtInsEdi->execute();
                $id_edi = $stmtInsEdi->insert_id;
                $stmtInsEdi->close();
            }
            $stmtEdi->close();
        }

        $sqlLivro = "INSERT INTO livro (titulo_liv, isbn, preco, quanti_estoq, numero_pag, ano_public, descricao, imagem, id_edi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexao->prepare($sqlLivro);
        if($stmt){
            $stmt->bind_param("ssdiissii", $titulo, $isbn, $preco, $estoque, $paginas, $ano, $descricao, $imagem, $id_edi);
                $id_liv = $stmt->insert_id;
                $stmt->close();

                if($stmt->execute()){
                    $id_liv = $stmt->insert_id;
                    $stmt->close();

                    if(!empty($nome_autor)){
                        $stmtAut = $conexao->prepare("SELECT id_aut FROM autor WHERE nome_aut = ?");
                        $stmtAut->bind_param("s", $nome_autor);
                        $stmtAut->execute();
                        $resultadoAut = $stmtAut->get_result();

                        if($rowAut = $resultadoAut->fetch_assoc()){
                            $id_aut = $rowAut['id_aut'];
                        }else{
                            $stmtInsAut = $conexao->prepare("INSERT INTO autor (nome_aut) VALUES (?)");
                            $stmtInsAut->bind_param("s", $nome_autor);
                            $stmtInsAut->execute();
                            $id_aut = $stmtInsAut->insert_id;
                            $stmtInsAut->close();
                        }
                        $stmtAut->close();

                        $stmtRel = $conexao->prepare("INSERT INTO liv_aut (id_liv, id_aut) VALUES (?, ?)");
                        $stmtRel->bind_param("ii", $id_liv, $id_aut);
                        $stmtRel->execute();
                        $stmtRel->close();
                    }
                header("Location: indexLivros.php");
                exit;
            }else{
                $erro = "Erro ao cadastrar livro: ".$stmt->error;
            }
        }else{
            $erro = "Erro na consulta: ".$conexao->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=11">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page usuarios-page cadastro-livro-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../perfilAdmin.php" aria-label="Perfil" title="Perfil">
                <img src="../../img/perfil.png" alt="Perfil">
            </a>
        </nav>
    </header>

    <main class="cadastro-livro-conteudo">
        <section class="cadastro-livro-cartao" aria-labelledby="cadastro-livro-titulo">
            <h1 id="cadastro-livro-titulo">Adicionar livro</h1>

            <form class="cadastro-livro-form" method="POST">
                <input type="hidden" name="id_liv" value="<?= $id_livro ?>">
                <div class="cadastro-livro-campos">
                    <p class="cadastro-livro-campo">
                        <label for="titulo-liv">Título do livro</label>
                        <input id="titulo-liv" type="text" name="titulo_liv" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="isbn">ISBN</label>
                        <input id="isbn" type="text" name="isbn" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="nome-aut">Autor</label>
                        <input id="nome-aut" type="text" name="nome_aut" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="nome-edi">Editora</label>
                        <input id="nome-edi" type="text" name="nome_edi" required>
                    </p>
                    <p class="cadastro-livro-campo cadastro-livro-campo--wide">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="4" required></textarea>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="preco">Preço (R$)</label>
                        <input id="preco" type="number" step="0.01" name="preco" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="estoque">Quantidade em estoque</label>
                        <input id="estoque" type="number" name="quanti_estoq" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="numero-pag">Número de páginas</label>
                        <input id="numero-pag" type="number" name="numero_pag" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="ano-public">Ano de publicação</label>
                        <input id="ano-public" type="date" name="ano_public" required>
                    </p>
                    <p class="cadastro-livro-campo cadastro-livro-campo--wide">
                        <label for="imagem">Imagem (caminho/URL)</label>
                        <input id="imagem" type="text" name="imagem">
                    </p>
                </div>

                <?php if (!empty($erro)) { ?>
                <p
                    style="background-color: #780000;
                            color: #ffffff;
                            padding: 8px 12px;
                            border-radius: 6px;
                            text-align: center;
                            width: max-content;
                            max-width: 100%;
                            margin: 10px auto;">
                    <?php echo $erro; ?>
                </p>
                <?php } ?>

                <div class="cadastro-livro-acoes">
                    <button type="submit">Salvar livro</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>