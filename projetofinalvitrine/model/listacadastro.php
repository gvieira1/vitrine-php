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
<title>Lista de Cadastros</title>


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
                    <a class="nav-link text-secondary" href="../view/cadastrofunc.php">Novo Funcionário</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary" href="../view/cadastroprod.php">Novo Produto</a>
                </li>
               
                </ul>
            </div>
    </nav>

    <?php
        include_once "../factory/conexao.php";
        include_once "../control/passing.php";

        $conn = new Caminho;
        $consulta = "SELECT * FROM cadastro";
        $stm = $conn->getConn()->query($consulta);
        $cadastro = $stm->fetchAll();

        
    ?>


    <div>
    <div class="container-fluid d-flex justify-content-center align-items-center full-height">
        <div class="bg-custom">
            <h3>Histórico de Registros</h3>
            <br>
            <?php foreach ($cadastro as $linha): ?>
                <form class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="inputUsuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="inputUsuario" value="<?php echo htmlspecialchars($linha['usuario_cad']); ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="inputDesc" class="form-label">Descrição do Item</label>
                        <input type="text" class="form-control" id="inputDesc" value="<?php echo htmlspecialchars($linha['nomeprod_cad']); ?>" disabled readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="datacad" class="form-label">Data do Cadastro</label>
                        <input type="text" class="form-control" id="datacad" name="datacad" value="<?php echo htmlspecialchars($linha['data_cad']); ?>" disabled readonly>
                    </div>
                </form>
                <?php echo '------------------------------------------------------------------------------------------------------------------------------<br>'; ?>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
    
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    

</body>
</html>