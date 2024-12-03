<?php
if (isset($_POST['imagem'])) {
    try {
        include_once "../factory/conexao.php";
        include_once "../control/passingproduto.php";
        
        $conn = new Caminho(); 
        $dadosprod = new PassingProduto;
   
        $dadosprod->setPreco($_POST['preco']);
        $dadosprod->setCategoria($_POST['categoria']);
        $dadosprod->setAutor($_POST['autor']);
     
        $preco = $dadosprod->getPreco();
        $imagem_armazenada = $_POST['imagem'];
        $categoria = $dadosprod->getCategoria();
        $autor = $dadosprod->getAutor();
    
        $foto = $_FILES["imagem"];
        $nome_imagem = null;

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
            
            $dimensoes = getimagesize($foto["tmp_name"]); // Obtém as dimensões da imagem enviada
            
            if ($dimensoes[0] > $largura) {
                $error[] = "A largura da imagem não deve ultrapassar {$largura} pixels.";
            } // Verifica se a largura da imagem excede a largura máxima permitida
    
            if ($dimensoes[1] > $altura) {
                $error[] = "A altura da imagem não deve ultrapassar {$altura} pixels.";
            } // Verifica se a altura da imagem excede a altura máxima permitida
    
            if ($foto["size"] > $tamanho) {
                $error[] = "A imagem deve ter no máximo {$tamanho} bytes.";
            } // Verifica se o tamanho do arquivo excede o tamanho máximo permitido
    
            
            if (empty($error)) { // Se não houver erros na validação da imagem, procede com o cadastro
                
                $nome_imagem = md5(uniqid(time())) . "." . pathinfo($foto["name"], PATHINFO_EXTENSION); // Gera um nome único para a imagem
                
                $caminho_imagem = "../imagens/" . $nome_imagem; // Define o caminho onde a imagem será salva
                   
                move_uploaded_file($foto["tmp_name"], $caminho_imagem); // Move o arquivo enviado para o caminho especificado

                    try{
                        $sql = 'SELECT imagem FROM produtos WHERE imagem = :imagem';
                        $stmt = $conn->getConn()->prepare($sql);
                        $stmt->bindParam(':imagem',$imagem_armazenada, PDO::PARAM_STR);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Obtém o resultado da consulta
                
                        $imagem = $result['imagem'] ?? null;
                        if ($imagem && file_exists("../imagens/".$imagem)) {
                             unlink("../imagens/".$imagem);
                        }
                    }catch (PDOException $e){
                        echo "Erro na Imagem: " . $e->getMessage();
                    }
                
            }
        }

        if($nome_imagem != ""){
            $query = "UPDATE produtos SET preco = :preco, categoria = :categoria, autor = :autor, imagem = :imagemnova WHERE imagem = :imagem";
            $atualizar = $conn->getConn()->prepare($query);
            $atualizar->bindParam(':preco', $preco, PDO::PARAM_STR);
            $atualizar->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $atualizar->bindParam(':autor', $autor, PDO::PARAM_STR);
            $atualizar->bindParam(':imagemnova', $nome_imagem, PDO::PARAM_STR);
            $atualizar->bindParam(':imagem', $imagem_armazenada, PDO::PARAM_STR);
        } else {
            $query = "UPDATE produtos SET preco = :preco, categoria = :categoria, autor = :autor WHERE imagem = :imagem";   
            $atualizar = $conn->getConn()->prepare($query);
            $atualizar->bindParam(':preco', $preco, PDO::PARAM_STR);
            $atualizar->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $atualizar->bindParam(':autor', $autor, PDO::PARAM_STR);
            $atualizar->bindParam(':imagem', $imagem_armazenada, PDO::PARAM_STR);
        }
        $atualizar->execute();

        echo"<script>alert('Registro Alterado com sucesso!'); window.location.href = 'listaprod.php';</script>";
    } catch (PDOException $e) {
        echo "Erro na atualização: " . $e->getMessage();
    }
}else{
    echo"<script>alert('Falha no envio do Formulário!'); window.location.href = 'listaprod.php';</script>";
}
?>