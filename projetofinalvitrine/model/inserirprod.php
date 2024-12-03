<?php

if ($_POST['categoria']!= "") {
    // Verifica se o formulário foi enviado e o botão "Cadastrar" foi pressionado.

    include_once "../control/passingproduto.php";
    include_once "../factory/conexao.php";

    $dadosprod = new PassingProduto;
        
    $dadosprod->setNomeProd($_POST['desc']);
    $dadosprod->setPreco($_POST['preco']);
    $dadosprod->setCategoria($_POST['categoria']);
    $dadosprod->setAutor($_POST['autor']);
        
    $descricao = $dadosprod->getNomeProd();
    $preco = $dadosprod->getPreco();
    $categoria = $dadosprod->getCategoria();
    $autor = $dadosprod->getAutor();
   
    session_start();
    $perfil = $_SESSION['login'];

    $conn = new Caminho();
    $query = "INSERT INTO produtos (nomeprod, preco, categoria, autor, imagem) VALUES (:nomeprod, :preco, :categoria, :autor, :imagem)";
    $foto = $_FILES["foto"];

    if (!empty($foto["name"])) {
        // Verifica se um arquivo foi enviado.

        // Configurações para validação da imagem
        $largura = 1500; // Largura máxima permitida
        $altura = 1800; // Altura máxima permitida
        $tamanho = 2048000; // Tamanho máximo permitido em bytes

        $error = []; // Array para armazenar mensagens de erro

        // Verifica se o tipo de arquivo enviado é uma imagem válida
        if (!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $foto["type"])) {
            $error[] = "Isso não é uma imagem válida.";
        }

        // Obtém as dimensões da imagem enviada
        $dimensoes = getimagesize($foto["tmp_name"]);

        // Verifica se a largura da imagem excede a largura máxima permitida
        if ($dimensoes[0] > $largura) {
            $error[] = "A largura da imagem não deve ultrapassar {$largura} pixels.";
        }

        // Verifica se a altura da imagem excede a altura máxima permitida
        if ($dimensoes[1] > $altura) {
            $error[] = "A altura da imagem não deve ultrapassar {$altura} pixels.";
        }

        // Verifica se o tamanho do arquivo excede o tamanho máximo permitido
        if ($foto["size"] > $tamanho) {
            $error[] = "A imagem deve ter no máximo {$tamanho} bytes.";
        }

        // Se não houver erros na validação da imagem, procede com o cadastro
        if (empty($error)) {
            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . pathinfo($foto["name"], PATHINFO_EXTENSION);

            // Define o caminho onde a imagem será salva
            $caminho_imagem = "../imagens/" . $nome_imagem;

            // Move o arquivo enviado para o caminho especificado
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);

            try {
                // Prepara a consulta SQL
                $cadastrar = $conn->getConn()->prepare($query);

                // Vincula os parâmetros da consulta
                $cadastrar->bindParam(':nomeprod', $descricao, PDO::PARAM_STR);
                $cadastrar->bindParam(':preco', $preco, PDO::PARAM_STR);
                $cadastrar->bindParam(':categoria', $categoria, PDO::PARAM_STR);
                $cadastrar->bindParam(':autor', $autor, PDO::PARAM_STR);
                $cadastrar->bindParam(':imagem', $nome_imagem, PDO::PARAM_STR);

                // Executa a consulta SQL
                $cadastrar->execute();

                $sql = "INSERT INTO cadastro (usuario_cad, nomeprod_cad) VALUES (:usuario, :nomeprod)";
                $stmt = $conn->getConn()->prepare($sql);
                $stmt->bindParam(':usuario', $perfil, PDO::PARAM_STR);
                $stmt->bindParam(':nomeprod', $descricao, PDO::PARAM_STR);
                $stmt->execute();

                // Verifica se o registro foi inserido com sucesso
                if ($cadastrar->rowCount() && $stmt->rowCount()) {
                    echo "<script>alert('Cadastro realizado com sucesso.'); window.location='../view/cadastroprod.php';</script>";
                    exit; // Encerra o script após redirecionar o usuário
                } else {
                    echo "<script>alert('Erro ao cadastrar usuário.');</script>";
                }
            } catch (PDOException $e) {
                echo "Erro ao cadastrar produto: " . $e->getMessage();
            }
        } else {
            // Exibe mensagens de erro para o usuário
            echo "<script>alert('" . implode("\\n", $error) . "'); window.location='../view/cadastroprod.php';</script>";
        }
    } else {
        echo "<script>alert('Você não selecionou nenhum arquivo.'); window.location='../view/cadastroprod.php';</script>";
    }
} else {
    echo "Botão de cadastro não foi pressionado.";
}
?>
