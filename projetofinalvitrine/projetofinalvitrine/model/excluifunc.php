<?php
        try {
            
            include_once "../factory/conexao.php";
            include_once "../control/passing.php";
            $conn = new Caminho;            
            
            if(isset($_GET['id']) && !empty($_GET['id'])) {              
            $stmt = $conn->getConn()->prepare('DELETE FROM funcionarios WHERE id = :id');                
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);                         
            $stmt->execute();
                
                // Verificando se a exclusão foi bem-sucedida
                if($stmt->rowCount() > 0) {
                    echo"<script>alert('Registro Excluido com sucesso!'); window.location.href = 'listafunc.php';</script>";
                } else {
                    echo"<script>alert('Dado não encontrado'); window.location.href = 'listafunc.php';</script>";
                }
            } else {
                echo"<script>alert('O ID do funcionário não foi fornecido'); window.location.href = 'listafunc.php';</script>";
            }
        } catch(PDOException $e) {
            // Tratamento de erros
            echo "Erro ao tentar excluir o funcionário: " . $e->getMessage();
        }
       
    ?>
