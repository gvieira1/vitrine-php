<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../estilo/css.css">    
    <title>Cadastro de Funcionários</title>


    <?php
    session_start();
    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
        header('location:../index.php');
    }
    $perfil = $_SESSION['login'];
    ?>

</head>
<body>

<nav class="navbar">
            <div>
                <a class="navbar-brand" href="../index.php">
                <img src="../imagens/GV.png" alt="Logo" width="35%">
                </a>
            </div>
            <div>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active text-secondary" aria-current="page" href="../view/menuadm.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="../view/cadastroprod.php">Novo Produto</a>
                </li>
               
                </ul>
            </div>
    </nav>

    <br>

    <div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="bg-custom">
        <h3>Ficha de Cadastro de Funcionário</h3>
        <br>
            <form class="row g-3" action="../model/inserirfunc.php" method="POST">

        <div class="col-md-3">
            <label for="inputNome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="inputNome" name="nome">  
        </div>    
        <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail4" name="email"> 
        </div>
        <div class="col-md-3">
            <label for="inputUsuario" class="form-label">Usuário</label>
            <input type="text" class="form-control" id="inputUsuario" name="usuario">
        </div>
        <div class="col-md-3">
            <label for="inputPassword4" class="form-label">Senha</label>
            <input type="password" class="form-control" id="inputPassword4" name="senha">
        </div>
        
        
        <div class="col-md-3">
        <label for="telefone" class="form-label">Número de Telefone</label>
          <input type="tel" class="form-control" id="telefone" name="telefone" pattern="[0-9]{2} [9]{1}[0-9]{8}" placeholder="XX XXXXXXXXX"  required>
        </div>
        
        <div class="col-md-3">
          <label for="data" class="form-label">Data de Nascimento</label>
          <input type="date" class="form-control" id="data" name="data" required >
          <br>
        </div>

        <div class="col-md-3">
        <label for="id" class="form-label">ID do Funcionário</label>
          <input type="tel" class="form-control" id="idfuncionario" name="id" pattern="[0-9]{4}" placeholder="XXXX" required>
        </div>

        <div class="col-md-3">
            <label for="inputTipo" class="form-label">Tipo de Usuário</label>
            <select id="inputTipo" class="form-select form-select-lg " name="tipo">
            <option selected>Selecione...</option>
                <option value="0">Administrador</option>
                <option value="1">Funcionário</option>  
            </select>
            
        </div>
        <br>

        

       
        <div class="col-12">
        <br>
            <button type="submit" class="btn  btn-secondary">Cadastrar</button>
        </div>
        </form>
    </div>



</body>
</html>