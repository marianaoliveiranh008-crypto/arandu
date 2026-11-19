<?php
    session_start();
    require_once "../../config/database.php";

    $id_livro = $_GET['id'] ?? null;
    if(!$id_livro){
        die("Erro: Livro não identificado.");
    }

    $livro = ['titulo_liv'=>'', 'isbn'=>'', 'nome_aut'=>'', 'nome_edi'=>'',
              'descricao'=>'', 'preco'=>'', 'quanti_estoq'=>'', 'numero_pag'=>'',
              'ano_public'=>'', 'imagem'=>''];

    $sql = "SELECT l.id_liv, l.isbn, l.titulo_liv, l.descricao, l.ano_public, l.numero_pag, l.quanti_estoq, l.imagem, l.preco, l.id_edi, e.nome_edi, a.id_aut, a.nome_aut
            FROM livro l
            LEFT JOIN editora e ON l.id_edi = e.id_edi
            LEFT JOIN liv_aut la ON l.id_liv = la.id_liv
            LEFT JOIN autor a ON la.id_aut = a.id_aut
            WHERE l.id_liv = ? LIMIT 1";
            
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_livro);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows === 1){
        $livro = $resultado->fetch_assoc();
    }
    $stmt->close();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['acao']) && $_POST['acao'] === 'excluir'){
            $sqlDel = "DELETE FROM livro WHERE id_liv = ?";
            $stmtDel = $conexao->prepare($sqlDel);
            if($stmtDel){
                $stmtDel->bind_param("i", $id_livro);
                $stmtDel->execute();
                $stmtDel->close();
            }
            header("Location: indexLivros.php");
            exit;
        }
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
            $sqlEdi = "SELECT id_edi FROM editora WHERE nome_edi = ?";
            $stmtEdi = $conexao->prepare($sqlEdi);
            $stmtEdi->bind_param("s", $nome_editora);
            $stmtEdi->execute();
            $resultadoEdi = $stmtEdi->get_result();

            if($resultadoEdi->num_rows > 0){
                $rowEdi = $resultadoEdi->fetch_assoc();
                $id_edi = $rowEdi['id_edi'];
            }else{
                $sqlEdiIns = "INSERT INTO editora (nome_edi) VALUES (?)";
                $stmtEdiIns = $conexao->prepare($sqlEdiIns);
                $stmtEdiIns->bind_param("s", $nome_editora);
                $stmtEdiIns->execute();
                $id_edi = $conexao->insert_id;
                $stmtEdiIns->close();
            }
            $stmtEdi->close();
        }
        $sqlUp = "UPDATE livro SET titulo_liv = ?, isbn = ?, descricao = ?, preco = ?, quanti_estoq = ?, numero_pag = ?, ano_public = ?, imagem = ?, id_edi = ? WHERE id_liv = ?";
        $stmtUp = $conexao->prepare($sqlUp);
        
        if(!$stmtUp){
            die("Erro ao preparar consulta: " . $conexao->error);
        }

        $stmtUp->bind_param("sssdiiisii", $titulo, $isbn, $descricao, $preco, $estoque, $paginas, $ano, $imagem, $id_edi, $id_livro);
        $stmtUp->execute();
        $stmtUp->close();
        
        if(!empty($nome_autor)){
            $sqlAut = "SELECT id_aut FROM autor WHERE nome_aut = ?";
            $stmtAut = $conexao->prepare($sqlAut);
            $stmtAut->bind_param("s", $nome_autor);
            $stmtAut->execute();
            $resultadoAut = $stmtAut->get_result();

            if($resultadoAut->num_rows > 0){
                $rowAut = $resultadoAut->fetch_assoc();
                $id_aut = $rowAut['id_aut'];
            }else{
                $sqlAutIns = "INSERT INTO autor (nome_aut) VALUES (?)";
                $stmtAutIns = $conexao->prepare($sqlAutIns);
                $stmtAutIns->bind_param("s", $nome_autor);
                $stmtAutIns->execute();
                $id_aut = $conexao->insert_id;
                $stmtAutIns->close();
            }
            $stmtAut->close();

            $sqlRelac = "SELECT * FROM liv_aut WHERE id_liv = ?";
            $stmtRelac = $conexao->prepare($sqlRelac);
            $stmtRelac->bind_param("i", $id_livro);
            $stmtRelac->execute();
            $resultadoRelac = $stmtRelac->get_result();

            if($resultadoRelac->num_rows > 0){
                $sqlRelacUp = "UPDATE liv_aut SET id_aut = ? WHERE id_liv = ?";
                $stmtRelacUp = $conexao->prepare($sqlRelacUp);
                $stmtRelacUp->bind_param("ii", $id_aut, $id_livro);
                $stmtRelacUp->execute();
                $stmtRelacUp->close();
            }else{
                $sqlRelacIns = "INSERT INTO liv_aut (id_liv, id_aut) VALUES (?, ?)";
                $stmtRelacIns = $conexao->prepare($sqlRelacIns);
                $stmtRelacIns->bind_param("ii", $id_livro, $id_aut);
                $stmtRelacIns->execute();
                $stmtRelacIns->close();
            }
            $stmtRelac->close();
        }
        header("Location: indexLivros.php");
            exit;
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=11">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page usuarios-page editar-livro-page">
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
        <section class="cadastro-livro-cartao" aria-labelledby="editar-livro-titulo">
            <h1 id="editar-livro-titulo">Editar informações do livro</h1>

            <form class="cadastro-livro-form" method="POST">
                <input type="hidden" name="id_livro" value="<?= $id_livro ?>">

                <div class="cadastro-livro-campos">
                    <p class="cadastro-livro-campo">
                        <label for="titulo-liv">Título do livro</label>
                        <input id="titulo-liv" type="text" name="titulo_liv" value="<?= htmlspecialchars($livro['titulo_liv'] ?? '') ?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="isbn">ISBN</label>
                        <input id="isbn" type="text" name="isbn" value="<?= htmlspecialchars($livro['isbn'] ?? '') ?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="nome-aut">Autor</label>
                        <input id="nome-aut" type="text" name="nome_aut" value="<?= htmlspecialchars($livro['nome_aut'] ?? '') ?>">
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="nome-edi">Editora</label>
                        <input id="nome-edi" type="text" name="nome_edi" value="<?= htmlspecialchars($livro['nome_edi'] ?? '') ?>">
                    </p>
                    <p class="cadastro-livro-campo cadastro-livro-campo--wide">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($livro['descricao'] ?? '') ?></textarea>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="preco">Preço (R$)</label>
                        <input id="preco" type="number" step="0.01" name="preco" value="<?= htmlspecialchars($livro['preco'] ?? '0.00') ?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="estoque">Quantidade em estoque</label>
                        <input id="estoque" type="number" name="quanti_estoq" value="<?= htmlspecialchars($livro['quanti_estoq'] ?? '0') ?>" required>
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="numero-pag">Número de páginas</label>
                        <input id="numero-pag" type="number" name="numero_pag" value="<?= htmlspecialchars($livro['numero_pag'] ?? '') ?>">
                    </p>
                    <p class="cadastro-livro-campo">
                        <label for="ano-public">Ano de publicação</label>
                        <input id="ano-public" type="date" name="ano_public" value="<?= !empty($livro['ano_public']) ? date('Y-m-d', strtotime($livro['ano_public'])) : '' ?>">
                    </p>
                    <p class="cadastro-livro-campo cadastro-livro-campo--wide">
                        <label for="imagem">Imagem (caminho/URL)</label>
                        <input id="imagem" type="text" name="imagem" value="<?= htmlspecialchars($livro['imagem'] ?? '') ?>">
                    </p>
                </div>

                <div class="cadastro-livro-acoes">
                    <button type="submit" name="acao" value="excluir">Excluir livro</button>
                    <button type="submit" name="acao" value="salvar">Salvar alterações</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>