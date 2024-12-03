<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../estilo/css.css">
    <title>Lista Produtos</title>

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
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../imagens/GV.png" alt="Logo" width="35%">
            </a>
            <ul class="nav justify-content-end">
            <?php
            
            $tipo_de_usuario = $_SESSION['tipo'];
             

            if ($tipo_de_usuario == 0) {
             // Tipo de usuário igual a 0 (ou seja, admin)
            ?>
              <li class="nav-item">
                    <a class="nav-link active text-secondary" aria-current="page" href="../view/menuadm.php">Home</a>
              </li>
            <?php } else { // Tipo de usuário diferente de 0 ?>
              <li class="nav-item">
                    <a class="nav-link active text-secondary" aria-current="page" href="../view/menufunc.php">Home</a>
              </li>
            <?php } ?>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="../view/cadastroprod.php">Novo Cadastro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="../index.php">Catálogo Virtual</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php
        include_once "../factory/conexao.php";
        include_once "../control/passingproduto.php";
        
        $conn = new Caminho;
        $consulta = "SELECT * FROM produtos";
        $stm = $conn->getConn()->query($consulta);
        $produtos = $stm->fetchAll();
    ?>
    
    <div class="container-fluid bg-custom">
        <div class="row row-cols-1 row-cols-md-6 g-4">
            <?php foreach ($produtos as $linha): ?>
                <div class=" col coluna">
                    <div class="card custom-card text-md-start h-100 ">
                        <img src="../imagens/<?php echo $linha['imagem']; ?>" alt="produto"  class="card-img-top img-fluid" style=" max-height: 345px;">
                        <small class=" right-top p-1 text-dark" style="background-color: #ffd3c8; border-radius: 10px; font-size: 0.9rem;" ><b><?php echo ($linha['categoria'] == 0) ? 'Literatura' : (($linha['categoria'] == 1) ? 'Religioso' : 'Romance'); ?></b></small>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item h6 exibenome">
                                    <small ><?php echo htmlspecialchars($linha['nomeprod']); ?></small>
                                </li>
                                <li class="list-group-item h6">
                                    <small><?php echo htmlspecialchars($linha['autor']); ?></small>
                                </li>
                                <li class="list-group-item h6">
                                    <small>R$<?php echo htmlspecialchars($linha['preco']); ?></small>
                                </li>
                                <li class="list-group-item h6">
                                    <small><?php echo htmlspecialchars($linha['data_criacao']); ?></small>
                                </li>
                                
                            </ul>
                            <div class="card-body text-center">

                            <?php
                            $tipo_de_usuario = $_SESSION['tipo'];
                            $nomeprod = htmlspecialchars($linha['nomeprod']);

                            if ($tipo_de_usuario == 0) {
                                // Tipo de usuário igual a 0 (ou seja, admin): Mostrar opções de atualizar e excluir
                                ?>
                                <a href="atualizaprod.php?nomeprod=<?php echo $nomeprod; ?>" class="btn btn-warning no-link">Atualizar</a>
                                <a href="excluiprod.php?nomeprod=<?php echo $nomeprod; ?>" class="btn btn-danger no-link excluir">Excluir</a>
                            <?php } else {
                                // Tipo de usuário diferente de 0: Mostrar apenas opção de atualizar
                                ?>
                                <a href="atualizaprod.php?nomeprod=<?php echo $nomeprod; ?>" class="btn btn-warning no-link">Atualizar</a>
                            <?php } ?>

                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="../js/script.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvFs+FyE+yTw" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+7/mz/WL2nwp3YS7bWKx6f+5C08jPLhp/e2" crossorigin="anonymous"></script>

</body>
</html>
