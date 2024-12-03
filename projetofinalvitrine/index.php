<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <title>Início</title>

    <style>
        html, body {
            height: 100%;
            background-color: #d8b2ab;
            font-family: "Playfair Display", serif;
            font-size: larger;
        }
        .full-height {
            min-height: 100vh;
        }
        .bg-custom {
            background-color: #f5ecea;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);           
        }
        .no-link {
            text-decoration: none;
            color: inherit;
        }       
        .custom-card .card-body {
            padding: 2px;           
        }
        .nomeprods{
            height: 4rem;           
        }       
        .col{
            padding: 0px 10px 8px 0px;
        }        
    </style>


</head>
<body>

    <nav class="navbar" style="background-color: #ffd3c8;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="imagens/GV.png" alt="Logo" width="35%">
            </a>
            <ul class="nav justify-content-end">

    <?php
        session_start();
        // Verifica se o usuário está logado
        if (isset($_SESSION['login'])) {
            $tipo_de_usuario = $_SESSION['tipo'];

            if ($tipo_de_usuario == 0) {
                // Tipo de usuário igual a 0 (ou seja, admin)
                ?>
                <li class="nav-item">
                    <a class="nav-link active text-secondary" aria-current="page" href="view/menuadm.php">Home</a>
                </li>
                <?php 
            } elseif ($tipo_de_usuario == 1) {
                // Tipo de usuário igual a 1
                ?>
                <li class="nav-item">
                    <a class="nav-link active text-secondary" aria-current="page" href="view/menufunc.php">Home</a>
                </li>
                <?php 
            }
        } else {
            // Usuário não está logado
            ?>
            <li class="nav-item">
                <a class="nav-link active text-secondary" aria-current="page" href="view/login.php">Login</a>
            </li>
    <?php 
        }
    ?>
            </ul>
        </div>
    </nav>

    <?php
        include_once "factory/conexao.php";
        include_once "control/passingproduto.php";
        
        $conn = new Caminho;
        $consulta = "SELECT * FROM produtos";
        $stm = $conn->getConn()->query($consulta);
        $produtos = $stm->fetchAll();
    ?>
    
    <div class="container-fluid bg-custom">
        <div class="row row-cols-1 row-cols-md-6 g-4">
            <?php foreach ($produtos as $linha): ?>
                <div class="col">
                    <div class="card custom-card text-md-start h-100">
                        <small class="position-absolute  p-1 text-dark" style="background-color: #ffd3c8; border-radius: 10px; font-size: 0.9rem;" ><b><?php echo ($linha['categoria'] == 0) ? 'Literatura' : (($linha['categoria'] == 1) ? 'Religioso' : 'Romance'); ?></b></small>
                        <img src="imagens/<?php echo $linha['imagem']; ?>" alt="produto"  class="card-img-top img-fluid" style=" max-height: 345px;">
                        <div class="card-body ">
                            <ul class="list-group list-group-flush">                               
                                <li class="list-group-item h5 nomeprods"><small class="card-text"><b><?php echo htmlspecialchars($linha['nomeprod']); ?></b></small></li>
                                <li class="list-group-item h5"><label class="form-label">R$ <?php echo htmlspecialchars($linha['preco']); ?></label></li>
                            </ul>                        
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvFs+FyE+yTw" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+7/mz/WL2nwp3YS7bWKx6f+5C08jPLhp/e2" crossorigin="anonymous"></script>

</body>
</html>
