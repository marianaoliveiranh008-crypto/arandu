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
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div>
        <form method="POST">
            <input type="search">
            <button type="submit">Pesquisar</button>
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Tipo de Usuário</th>
            <th>Data de Cadastro</th>
        </tr>
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
                    </tr>";
            }
            ?>
    </table>
</body>
</html>