<?php
    session_start();
    require_once "../../config/database.php";

    $id_livro = $_GET['id'] ?? null;
    if(!$id_livro){
        die("Erro: Livro não identificado.");
    }

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
    header("Location: indexLivros.php");
    exit;
?>