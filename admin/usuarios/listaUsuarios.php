<?php
    session_start();
    require_once "../../config/database.php";

    $pesquisa=$_POST['busca'] ?? '';

    if(!empty($pesquisa)){
        $palavra = mysqli_real_escape_string($conexao, $pesquisa);
        $bancodedados = "SELECT * FROM usuario WHERE nome LIKE '%$palavra%'";
    }else{
        $bancodedados = "SELECT * FROM usuario";
    }
    
    $dados = mysqli_query($conexao, $bancodedados);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=10">
    <link rel="icon" href="../../img/Logotipo-Livraria.ico" type="image/x-icon">
</head>
<body class="admin-page usuarios-page">
    <header class="cabecalho">
        <a class="marca" href="../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="menu" aria-label="Navegação administrativa">
            <a href="../produtos/indexLivros.php">Livros</a>
            <a href="../pedidos/indexPedidos.php">Pedidos</a>
            <a href="../usuarios/listaUsuarios.php">Clientes</a>
            <a href="../produtos/estoqueLivros.php">Estoque</a>
        </nav>

        <nav class="atalhos" aria-label="Atalhos">
            <a href="../../usuario/perfil.php" aria-label="Perfil" title="Perfil">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M5 21v-2a7 7 0 0 1 14 0v2" />
                </svg>
            </a>
        </nav>
    </header>

    <main class="usuarios-content">
        <form class="usuarios-search" method="POST" role="search">
            <button type="submit" aria-label="Pesquisar">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7" /><path d="m16 16 5 5" /></svg>
            </button>
            <input type="search" name="busca" placeholder="Buscar nome do cliente..." aria-label="Buscar pedido ou cliente">
        </form>

        <div class="usuarios-table-scroll">
            <table class="usuarios-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Tipo de Usuário</th>
                        <th>Data do Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($linha = mysqli_fetch_assoc($dados)){
                            $id = $linha['id_usuario'];
                            $nome = $linha['nome'];
                            $email = $linha['email'];
                            $telefone = $linha['telefone'];
                            $cpf = $linha['cpf_usuario'];
                            $tipoUsuario = $linha['tipo_usuario'];
                            $dataCadastro = $linha['data_cadastro'];

                            echo "<tr>
                                    <td>$id</td>
                                    <td>$nome</td>
                                    <td>$email</td>
                                    <td>$telefone</td>
                                    <td>$cpf</td>
                                    <td>$tipoUsuario</td>
                                    <td>$dataCadastro</td>
                                    <td><a class=\"perfil-link\" href=\"perfilUsuario.php?id=$id\">Ver perfil</a></td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>