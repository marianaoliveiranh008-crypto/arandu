<?php
    session_start();
    require_once "../../config/database.php";

    $id_usuario = $_POST['id_usuario'] ?? null;

    $id_admin_logado =  $_SESSION['id_usuario'] ?? null;

    if($id_usuario){
        if($id_usuario == $id_admin_logado){
            die("Erro: Você não pode excluir a sua própria conta de administrador por esta tela!");
        }

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
            $_SESSION['mensagem'] = "Cliente excluído com sucesso!";

        }catch(Exception $e){
            $conexao->rollback();
            $_SESSION['erro'] = "Erro ao excluir cliente: ".$e->getMessage();
        
    }
    }

    header("Location: listaUsuarios.php");
    exit;
?>