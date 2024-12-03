<?php
    if($_POST['usuario']!=""){

        include_once "../control/passing.php";
        include_once "../factory/conexao.php";

        $dados = new Passing;
        
        $dados->setNome($_POST['nome']);
        $dados->setEmail($_POST['email']);
        $dados->setTelefone($_POST['telefone']);
        $dados->setUsuario($_POST['usuario']);
        $dados->setNascimento($_POST['data']);
        $dados->setId($_POST['id']);
        $dados->setTipo($_POST['tipo']);
        $dados->setSenha( $_POST['senha']);   

        $hash_senha = $dados->getSenha();
        $nome = $dados->getNome();
        $email =$dados->getEmail();
        $telefone = $dados->getTelefone() ;
        $tipo = $dados->getTipo();
        $usuario = $dados->getUsuario();
        $datas =  $dados->getNascimento();
        $id = $dados->getId();      

        $conn = new Caminho;
        $query = "INSERT into funcionarios(nome,email,usuario,id,data_nascimento,telefone,tipo,hash_senha) values(:nome, :email, :usuario, :id, :datas, :telefone, :tipo, :hash_senha)";
        $cadastrar = $conn->getConn()->prepare($query);
        $cadastrar->bindParam(':nome',$nome,PDO::PARAM_STR);
        $cadastrar->bindParam(':email',$email,PDO::PARAM_STR);
        $cadastrar->bindParam(':usuario',$usuario,PDO::PARAM_STR);
        $cadastrar->bindParam(':id',$id ,PDO::PARAM_STR);
        $cadastrar->bindParam(':datas',$datas,PDO::PARAM_STR);
        $cadastrar->bindParam(':telefone',$telefone,PDO::PARAM_STR);
        $cadastrar->bindParam(':tipo',$tipo,PDO::PARAM_STR);
        $cadastrar->bindParam(':hash_senha',$hash_senha,PDO::PARAM_STR);
        $cadastrar->execute();
        if($cadastrar->rowCount()){
            echo"<script>alert('Registro Incluído com sucesso!'); window.location.href = '../view/cadastrofunc.php';</script>";
        }
        else{
            echo"<script>alert('Erro na inclusão!'); window.location.href = '../view/cadastrofunc.php';</script>";
        }
     }else{
        echo "Erro!";
     }
    
    ?>