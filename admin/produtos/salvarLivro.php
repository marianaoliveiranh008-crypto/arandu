<?php
    session_start();
    require_once "../../config/database.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = mysqli_real_escape_string($conexao, $_POST['titulo_liv'] ?? '');
        $isbn = mysqli_real_escape_string($conexao, $_POST['isbn'] ?? '');
        $autor = trim($_POST['nome_aut'] ?? '');
        $editora = trim($_POST['nome_edi'] ?? '');
        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao'] ?? '');
        $preco = $_POST['preco'] ?? 0;
        $estoque = $_POST['quanti_estoq'] ?? 0;
        $numeroPaginas = $_POST['numero_pag'] ?? 0;
        $anoPublicacao = $_POST['ano_public'] ?? null;
        $imagem = mysqli_real_escape_string($conexao, $_POST['imagem'] ?? '');

        $id_edi = null;
        if(!empty($editora)){
            $stmtEdi = $conexao->prepare("SELECT id_edi FROM editora WHERE nome_edi = ?");
            $stmtEdi->bind_param("s", $editora);
            $stmtEdi->execute();
            $resEdi = $stmtEdi->get_result();

            if($rowEdi = $resEdi->fetch_assoc()){
                $id_edi = $rowEdi['id_edi'];
            }else{
                $stmtInsEdi = $conexao->prepare("INSERT INTO editora (nome_edi) VALUES (?)");
                $stmtInsEdi->bind_param("s", $editora);
                $stmtInsEdi->execute();
                $id_edi = $stmtInsEdi->insert_id;
                $stmtInsEdi->close();
            }
            $stmtEdi->close();
        }

        $sqlLivro = "INSERT INTO livro (titulo_liv, isbn, preco, quanti_estoq, numero_pag, ano_public, descricao, imagem, id_edi) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexao->prepare($sqlLivro);
        if ($stmt) {
            $stmt->bind_param("ssdiiissi", $titulo, $isbn, $preco, $estoque, $paginas, $anoPublicacao, $descricao, $imagem, $id_edi);
            if($stmt->execute()){
                $id_liv = $stmt->insert_id;
                $stmt->close();

                if(!empty($autor)){
                    $stmtAut = $conexao->prepare("SELECT id_aut FROM autor WHERE nome_aut = ?");
                    $stmtAut->bind_param("s", $autor);
                    $stmtAut->execute();
                    $resAut = $stmtAut->get_result();

                    if($rowAut = $resAut->fetch_assoc()){
                        $id_aut = $rowAut['id_aut'];
                    } else {
                        $stmtInsAut = $conexao->prepare("INSERT INTO autor (nome_aut) VALUES (?)");
                        $stmtInsAut->bind_param("s", $autor);
                        $stmtInsAut->execute();
                        $id_aut = $stmtInsAut->insert_id;
                        $stmtInsAut->close();
                    }
                    $stmtAut->close();

                    $stmtRel = $conexao->prepare("INSERT INTO liv_aut (id_liv, id_aut) VALUES (?, ?)");
                    $stmtRel->bind_param("ii", $id_liv, $id_aut);
                    $stmtRel->execute();
                    $stmtRel->close();
                }

                header("Location: indexLivros.php");
                exit;
            }else{
                echo "Erro ao cadastrar livro: ".$stmt->error;
            }
        }else{
            echo "Erro na consulta: ".$conexao->error;
        }
    }else{
        header("Location: indexLivros.php");
        exit;
    }
?>