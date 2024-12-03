<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">  
    <title>Menu Funcionário</title>

    <style>
        html, body {
            height: 100%;
            background-color:#c58b82;
            font-family: "Playfair Display", serif;
            font-size: larger;
        }
    </style>

    <?php
    session_start();
    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
        header('location:../index.php');
    }

    $perfil = $_SESSION['login'];
    ?>

</head>
<body>

    
    <nav class="navbar" style="background-color: #ffd3c8; width:100%">
            <div>
                <a class="navbar-brand" href="../index.php">
                <img src="../imagens/GV.png" alt="Logo" width="35%">
                </a>
            </div>
    </nav>

    <div class="container-fluid d-flex justify-content-center align-items-center full-height">
        <div class="card " style="width: 55%; padding: 2%; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    
            <div class="card-body ">
                <h4 class="card-title"><?php echo "Boas Vindas ".$perfil;?></h4>
                <p class="card-text">Você está logado como Funcionário</p>
            </div>
            <ul class="list-group list-group-flush text-center" >
                <li class="list-group-item "><a href="cadastroprod.php" class="card-link text-secondary">Cadastrar Produtos</a></li>
                <li class="list-group-item "><a href="../model/listaprod.php" class="card-link text-secondary">Listar Produtos</a></li>
                <li class="list-group-item"><a href="../index.php" class="card-link text-secondary">Exibir Catálogo Virtual</a></li>
                <li class="list-group-item"><a href="../model/sair.php" class="card-link text-danger">Sair do Perfil</a></li>
            </ul>
        
        </div>
    </div>

        
    
    
</body>
</html>