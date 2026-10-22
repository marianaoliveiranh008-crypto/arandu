<?php
    session_start();
    require_once "../../config/database.php";

    $pesquisa=$_POST['busca'] ?? '';

    if(!empty($pesquisa)){
        $palavra = mysqli_real_escape_string($conexao, $pesquisa);
        $bancodedados = "SELECT DISTINCT l.*, a.nome_aut 
                         FROM livro l
                         LEFT JOIN editora ed ON l.id_edi = ed.id_edi
                         LEFT JOIN liv_aut la ON l.id_liv = la.id_liv
                         LEFT JOIN autor a ON la.id_aut = a.id_aut
                         WHERE l.titulo_liv LIKE '%$palavra%' OR a.nome_aut LIKE '%$palavra%'";
    }else{
        $bancodedados = "SELECT l.*, GROUP_CONCAT(a.nome_aut SEPARATOR ', ') AS nome_aut, ed.nome_edi
                         FROM livro l
                         LEFT JOIN editora ed ON l.id_edi = ed.id_edi
                         LEFT JOIN liv_aut la ON l.id_liv = la.id_liv
                         LEFT JOIN autor a ON la.id_aut = a.id_aut
                         GROUP BY l.id_liv";
    }
    
    $dados = mysqli_query($conexao, $bancodedados);
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=2">
</head>
<body class="usuarios-page">
    <header class="top-header login-header">
        <a class="brand" href="../../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../../compras/historico.php">Pedidos</a>
            <a class="ativo" href="../usuarios/listaUsuarios.php" aria-current="page">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="usuarios-atalhos" aria-label="Atalhos">
            <a href="../../index.php" aria-label="Página inicial" title="Página inicial">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z" /></svg>
            </a>
            <a href="#notificacoes" aria-label="Notificações" title="Notificações">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" /></svg>
            </a>
            <a href="../../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4" /><path d="M5 21v-2a7 7 0 0 1 14 0v2" /></svg>
            </a>
        </nav>
    </header>

    <main class="usuarios-content">
        <form class="usuarios-search" method="POST" role="search">
            <button type="submit" aria-label="Pesquisar">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7" /><path d="m16 16 5 5" /></svg>
            </button>
            <input type="search" name="busca" placeholder="Buscar nome ou autor..." aria-label="Buscar nome ou autor">
        </form>

        <form action="cadastrarLivro.php" method="POST">
            <button type="submit">+ Adicionar livro</button>
        </form>

        <br>
        
        <div class="usuarios-table-scroll">
            <table class="usuarios-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Descrição</th>
                        <th>Ano de publicação</th>
                        <th>Nº de páginas</th>
                        <th>Estoque</th>
                        <th>Imagem</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($linha = mysqli_fetch_assoc($dados)){
                            $id = $linha['id_liv'];
                            $isbn = $linha['isbn'];
                            $titulo = $linha['titulo_liv'];
                            $autor = $linha['nome_aut'];
                            $editora = $linha['nome_edi'] ?? 'Não cadastrada';
                            $descricao = "<div class='descricao-scroll'>".htmlspecialchars($linha['descricao'])."</div>";
                            $anoPublicacao = $linha['ano_public'];
                            $numeroPaginas = $linha['numero_pag'];
                            $estoque = $linha['quanti_estoq'];
                            $imagem = $linha['imagem'];
                            $preco = $linha['preco'];

                            $exibirImagem = !empty($imagem) ? "<img src='$imagem' alt='Capa' width='50'>" : "Sem imagem";

                            echo "<tr>
                                    <td>$id</td>
                                    <td>$isbn</td>
                                    <td>$titulo</td>
                                    <td>$autor</td>
                                    <td>$editora</td>
                                    <td>$descricao</td>
                                    <td>$anoPublicacao</td>
                                    <td>$numeroPaginas</td>
                                    <td>$estoque</td>
                                    <td>$exibirImagem</td>
                                    <td>$preco</td>
                                    <td><a class=\"perfil-link\" href=\"editarLivro.php?id=$id\">Editar informações</a></td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>