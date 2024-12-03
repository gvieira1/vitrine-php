<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        include_once "../factory/conexao.php";
        include_once "../control/passing.php";
        $conn = new Caminho;

        $dados = new Passing;
        
        $dados->setNome($_POST['nome']);
        $dados->setEmail($_POST['email']);
        $dados->setTelefone($_POST['telefone']);
        $dados->setNascimento($_POST['data']);
        $dados->setId($_POST['id']);
        $dados->setTipo($_POST['tipo']);

        $nome = $dados->getNome();
        $email =$dados->getEmail();
        $telefone = $dados->getTelefone() ;
        $tipo = $dados->getTipo();
        $datas =  $dados->getNascimento();
        $id = $dados->getId();  

        $query = "UPDATE funcionarios 
                  SET nome = :nome, 
                      email = :email,                     
                      data_nascimento = :data, 
                      telefone = :telefone, 
                      tipo = :tipo 
                  WHERE id = :id";

        $atualizar = $conn->getConn()->prepare($query);
        $atualizar->bindParam(':nome', $nome, PDO::PARAM_STR);
        $atualizar->bindParam(':email', $email, PDO::PARAM_STR);       
        $atualizar->bindParam(':data', $datas, PDO::PARAM_STR);
        $atualizar->bindParam(':telefone',  $telefone, PDO::PARAM_STR);
        $atualizar->bindParam(':tipo', $tipo, PDO::PARAM_INT);
        $atualizar->bindParam(':id', $id , PDO::PARAM_INT);
        $atualizar->execute();

        echo"<script>alert('Registro Alterado com sucesso!'); window.location.href = 'listafunc.php';</script>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>