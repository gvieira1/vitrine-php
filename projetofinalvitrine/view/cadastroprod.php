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
    <title>Cadastro de Produtos</title>

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
            <?php          
            $tipo_de_usuario = $_SESSION['tipo'];             

            if ($tipo_de_usuario == 0) {
             // Tipo de usuário igual a 0 (ou seja, admin)
            ?>
              <li class="nav-item">
                    <a class="nav-link active text-secondary" aria-current="page" href="../view/menuadm.php">Home</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-secondary" href="../view/cadastrofunc.php">Novo Funcionário</a>
             </li>
            <?php } else { // Tipo de usuário diferente de 0 ?>
              <li class="nav-item">
                    <a class="nav-link active text-secondary" aria-current="page" href="../view/menufunc.php">Home</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link text-secondary" href="../index.php">Catálogo Virtual</a>
                </li>
            <?php } ?>
                
               
                </ul>
            </div>
    </nav>

    <br>

    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="bg-custom">
            <h3 class="text-center mb-4">Ficha de Cadastro de Produtos</h3>
            <br>
            <form class="row g-3" action="../model/inserirprod.php" method="POST" enctype="multipart/form-data">
                
                <div class="col-md-3">
                    <label for="inputDesc" class="form-label">Descrição do Produto</label>
                    <input type="text" class="form-control" id="inputDesc" name="desc" required>
                </div>

                <div class="col-md-2">
                    <label for="inputAutor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="inputAutor" name="autor" required>
                </div>

                <div class="col-md-2">
                    <label for="valor" class="form-label">Preço do Item</label>
                    <input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" placeholder="0.00" required>
                </div>
                

                <div class="col-md-2">
                    <label for="inputCat" class="form-label">Categoria</label>
                    <br>
                    <select id="inputCat" class="form-select" name="categoria" required>
                        <option selected disabled>Selecione...</option>
                        <option value="0">Literatura</option>
                        <option value="1">Religioso</option>
                        <option value="2">Romance</option>
                    </select>
                </div>
               
               
                <div class="col-md-3"><br>
                    <div class="input-group mb-3">
                        <label class="input-group-text " for="inputGroupFile01">Upload de Imagem</label>
                        <input type="file" name="foto" class="form-control custom-file-input" id="inputGroupFile01" required>
                    </div>
                </div>
                <br>
                <div class="col-12 text-center">
                    <br><button type="submit" name="Cadastrar"class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>



</body>
</html>