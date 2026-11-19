<?php
    session_start();
    require_once "../../config/database.php";

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header("Location: listaUsuarios.php");
        exit;
    }

    $id_usuario = $_POST['id_usuario'] ?? null;

    $id_admin_logado =  $_SESSION['id_usuario'] ?? $_SESSION['id_usuario'] ?? null;

    if(empty($id_usuario) || !filter_var($id_usuario, FILTER_VALIDATE_INT) || $id_usuario <= 0){
        $_SESSION['erro'] = "ID do cliente inválido.";
        header("Location: listaUsuarios.php");
        exit;
    }

    if($id_usuario == $id_admin_logado){
        die("Erro: Você não pode excluir a sua própria conta de administrador por esta tela!");
        header("Location: listaUsuarios.php");
        exit;
    }

    try{
        $conexao->begin_transaction();
        $sqlEnd = "DELETE FROM endereco WHERE id_usuario = ?";
        $stmtEnd = $conexao->prepare($sqlEnd);
        $stmtEnd->bind_param("i", $id_usuario);
        $stmtEnd->execute();
        $stmtEnd->close();

        $sqlDel = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmtDel = $conexao->prepare($sqlDel);
        $stmtDel->bind_param("i", $id_usuario);
        $stmtDel->execute();

        if($stmtUser->affected_rows > 0){
            $stmtDel->close();
            $conexao->commit();
            header("Location: listaUsuarios.php");
            exit;
        }else{
            $stmtDel->close();
            throw new Exception("Cliente não encontrado.");
        }
    }catch(Exception $e){
        $conexao->rollback();
        $erro = "Erro ao excluir cliente.";
    }

    header("Location: admin/index.php");
    exit;
?>