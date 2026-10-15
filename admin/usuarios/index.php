<?php
    session_start();
    require_once "../../config/database.php";

    if(isset($_POST['busca'])){
        $pesquisa=$_POST['busca'] ?? '';
    }

    $bancodedados = "SELECT * FROM usuario WHERE nome";
    $dados = mysqli_query($conexao, $bancodedados);
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - Arandu</title>
    <link rel="stylesheet" href="../../css/style.css?v=2">
</head>
<body class="usuarios-page">
    <header class="top-header login-header">
        <a class="brand" href="../../index.php" aria-label="Arandu - página inicial">
            <img src="../../img/logo.png" alt="Arandu">
        </a>

        <nav class="nav-menu" aria-label="Navegação administrativa">
            <a href="../produtos/index.php">Livros</a>
            <a href="../../compras/historico.php">Pedidos</a>
            <a class="ativo" href="index.php" aria-current="page">Clientes</a>
            <a href="../produtos/index.php">Estoque</a>
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
            <input type="search" name="busca" placeholder="Buscar pedido ou cliente..." aria-label="Buscar pedido ou cliente">
        </form>

        <div class="usuarios-table-scroll">
            <table class="usuarios-table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Cadastro</th>
                        <th scope="col">Ações</th>
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
                                    <td>$nome</td>
                                    <td>$email</td>
                                    <td>$telefone</td>
                                    <td>$dataCadastro</td>
                                    <td><a class=\"perfil-link\" href=\"editar.php?id=$id\">Ver perfil</a></td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>