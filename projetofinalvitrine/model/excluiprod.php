<?php
  try {
      include_once "../factory/conexao.php";
      $conn = new Caminho;
      
      if(isset($_GET['nomeprod']) && !empty($_GET['nomeprod'])) {   
        
        $sql = 'SELECT imagem FROM produtos WHERE nomeprod = :nomeprod';
        $stmt = $conn->getConn()->prepare($sql);
        $stmt->bindParam(':nomeprod',$_GET['nomeprod'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Obtém o resultado da consulta
        
        $imagem = $result['imagem'] ?? null;

      if ($imagem && file_exists("../imagens/".$imagem)) {
        unlink("../imagens/".$imagem);
    }
    
        $cad = $conn->getConn()->prepare('DELETE FROM cadastro WHERE nomeprod_cad = :nomeprod'); 
        $cad->bindParam(':nomeprod', $_GET['nomeprod'], PDO::PARAM_STR);                         
        $cad->execute();

        $stmt = $conn->getConn()->prepare('DELETE FROM produtos WHERE nomeprod = :nomeprod');                
        $stmt->bindParam(':nomeprod', $_GET['nomeprod'], PDO::PARAM_STR);                         
        $stmt->execute();      
          
          // Verificando se a exclusão foi bem-sucedida
          if($stmt->rowCount() > 0 && $cad->rowCount() > 0) {
              echo"<script>alert('Registro Excluido com sucesso!'); window.location.href = 'listaprod.php';</script>";
          } else {
              echo"<script>alert('Dado não encontrado'); window.location.href = 'listaprod.php';</script>";
          }
      } else {
          echo"<script>alert('O Item não foi fornecido'); window.location.href = 'listaprod.php';</script>";
      }
  } catch(PDOException $e) {
      // Tratamento de erros
      echo "Erro ao tentar excluir item: " . $e->getMessage();
  }
 
?>
