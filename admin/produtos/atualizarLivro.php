<?php
    session_start();
    require_once "../../config/database.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_liv = $_POST['id_liv'] ?? null;
        $titulo = $_POST['titulo_liv'] ?? '';
        $isbn = $_POST['isbn'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $estoque = $_POST['quanti_estoq'] ?? 0;
        $numero_pag = $_POST['numero_pag'] ?? null;
        $ano_public = $_POST['ano_public'] ?? null;
        $descricao = $_POST['descricao'] ?? '';
        $imagem = $_POST['imagem'] ?? '';

        $nome_edi   = trim($_POST['nome_edi'] ?? '');
        $nome_aut   = trim($_POST['nome_aut'] ?? '');

        if(!$id_liv){
            die("ID do livro não informado.");
        }

        if(!empty($nome_edi)){
        $stmtEdi = $conexao->prepare("SELECT id_edi FROM editora WHERE nome_edi = ?");
        $stmtEdi->bind_param("s", $nome_edi);
        $stmtEdi->execute();
        $resEdi = $stmtEdi->get_result();

        if($rowEdi = $resEdi->fetch_assoc()){
            $id_edi = $rowEdi['id_edi'];
        }else{
            $stmtInsEdi = $conexao->prepare("INSERT INTO editora (nome_edi) VALUES (?)");
            $stmtInsEdi->bind_param("s", $nome_edi);
            $stmtInsEdi->execute();
            $id_edi = $stmtInsEdi->insert_id;
            $stmtInsEdi->close();
        }
        $stmtEdi->close();
        }

        $sql = "UPDATE livro SET 
                titulo_liv = ?, 
                isbn = ?, 
                preco = ?, 
                quanti_estoq = ?, 
                numero_pag = ?, 
                ano_public = ?, 
                descricao = ?, 
                imagem = ?,
                id_edi = ?
                WHERE id_liv = ?";

        $stmt = $conexao->prepare($sql);
        if($stmt){
            $stmt->bind_param("ssdiiissii", $titulo, $isbn, $preco, $estoque, $numero_pag, $ano_public, $descricao, $imagem, $id_edi, $id_liv);
            $stmt->execute();
            $stmt->close();
        }else{
            die("Erro ao atualizar o livro: " . $conexao->error);
        }

        if(!empty($nome_aut)){
            $stmtAut = $conexao->prepare("SELECT id_aut FROM autor WHERE nome_aut = ?");
            $stmtAut->bind_param("s", $nome_aut);
            $stmtAut->execute();
            $resAut = $stmtAut->get_result();

            if($rowAut = $resAut->fetch_assoc()){
                $id_aut = $rowAut['id_aut'];
            }else{
                $stmtInsAut = $conexao->prepare("INSERT INTO autor (nome_aut) VALUES (?)");
                $stmtInsAut->bind_param("s", $nome_aut);
                $stmtInsAut->execute();
                $id_aut = $stmtInsAut->insert_id;
                $stmtInsAut->close();
            }
            $stmtAut->close();

            $stmtDelRel = $conexao->prepare("DELETE FROM liv_aut WHERE id_liv = ?");
            $stmtDelRel->bind_param("i", $id_liv);
            $stmtDelRel->execute();
            $stmtDelRel->close();

            $stmtInsRel = $conexao->prepare("INSERT INTO liv_aut (id_liv, id_aut) VALUES (?, ?)");
            $stmtInsRel->bind_param("ii", $id_liv, $id_aut);
            $stmtInsRel->execute();
            $stmtInsRel->close();
        }

        header("Location: estoqueLivros.php");
        exit;
    }else{
        header("Location: estoqueLivros.php");
        exit;
    }
?>