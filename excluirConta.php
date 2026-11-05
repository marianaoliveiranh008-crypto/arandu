<?php
    session_start();
    require_once "config/database.php";

    $id_usuario = $_POST['id_usuario'] ?? $_SESSION['usuarioId'] ?? null;

    if($id_usuario){
        $conexao->begin_transaction();

        try{
            $stmtEnd = $conexao->prepare("DELETE FROM endereco WHERE id_usuario = ?");
            $stmtEnd->bind_param("i", $id_usuario);
            $stmtEnd->execute();
            $stmtEnd->close();

            $stmtUser = $conexao->prepare("DELETE FROM usuario WHERE id_usuario = ?");
            $stmtUser->bind_param("i", $id_usuario);
            $stmtUser->execute();
            $stmtUser->close();
            
            $conexao->commit();

            if(isset($_SESSION['usuarioId']) && $_SESSION['usuarioId'] == $id_usuario){
                session_destroy();
            }

        }catch(Exception $e){
            $conexao->rollback();
            $_SESSION['erro'] = "Erro ao excluir conta: ".$e->getMessage();
            header("Location: perfil.php");
            exit;
        
        }
    }
    header("Location: index.php");
    exit;
?>