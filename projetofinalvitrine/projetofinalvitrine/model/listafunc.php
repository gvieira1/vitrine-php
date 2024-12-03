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
<title>Lista Funcionário</title>

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
        $consulta = "SELECT * FROM funcionarios";
        $stm = $conn->getConn()->query($consulta);
        $funcionarios = $stm->fetchAll();      
    ?>


    <div>
    <div class="container-fluid d-flex justify-content-center align-items-center full-height">
        <div class="bg-custom">
            <h3>Listar Funcionários</h3>
            <br>
            <?php foreach ($funcionarios as $linha): ?>
                <form class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" value="<?php echo htmlspecialchars($linha['email']); ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="inputNome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="inputNome" value="<?php echo htmlspecialchars($linha['nome']); ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="id" class="form-label">ID do Usuário</label>
                        <input type="text" class="form-control" id="idfuncionario" name="id" value="<?php echo htmlspecialchars($linha['id']); ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="data" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data" name="data" value="<?php echo htmlspecialchars($linha['data_nascimento']); ?>" disabled readonly>
                        <br>
                    </div>
                    <div class="col-md-3">
                        <label for="tipo" class="form-label">Tipo de Usuário</label>
                        <input type="text" class="form-control" id="tipo" value="<?php echo ($linha['tipo'] == 0) ? 'Administrador' : 'Funcionário'; ?>" disabled readonly>
                    </div>
                    <br>
                    <div class="col-md-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($linha['telefone']); ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="inputUsuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="inputUsuario" value="<?php echo htmlspecialchars($linha['usuario']); ?>" disabled readonly>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-outline-warning" type="button"><a href="atualizafunc.php?id=<?php echo htmlspecialchars($linha['id']); ?>" >Atualizar Registro</a></button>
                        <button class="btn btn-outline-danger" type="button"><a href="excluifunc.php?id=<?php echo htmlspecialchars($linha['id']); ?>" class="excluir">Excluir</a></button>
                    </div>
                </form>
                <?php echo '------------------------------------------------------------------------------------------------------------------------------<br>'; ?>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
    
    <script src="../js/script.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    

</body>
</html>