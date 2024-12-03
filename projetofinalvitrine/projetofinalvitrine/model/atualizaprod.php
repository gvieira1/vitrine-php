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
    <title>Atualiza Produtos</title>
</head>
<body>

    <nav class="navbar" style="background-color: #ffd3c8;">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../imagens/GV.png" alt="Logo" width="35%">
            </a>
            <ul class="nav justify-content-end">

            <?php
            session_start();
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
        
        $consulta = "SELECT * FROM produtos WHERE nomeprod = :nomeprod";
        $stm = $conn->getConn()->prepare($consulta);
        $stm->bindParam(':nomeprod', $_GET['nomeprod'], PDO::PARAM_STR);
        $stm->execute();
        $linha = $stm->fetch(PDO::FETCH_ASSOC);

        if($linha){
    ?>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="bg-custom">
            <h3 class="text-center mb-4">Atualize o Produto</h3>
            <br>
            <form class="row g-3" action="atualizar_produto.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="imagem" value="<?php echo htmlspecialchars($linha['imagem']); ?>">

                <div class="col-md-3">
                    <label for="inputDesc" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="inputDesc" name="desc" value="<?php echo htmlspecialchars($linha['nomeprod']); ?>" disabled readonly >
                </div>

                <div class="col-md-2">
                    <label for="inputAutor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="inputAutor" name="autor" value="<?php echo htmlspecialchars($linha['autor']); ?>"  >
                </div>

                <div class="col-md-2">
                    <label for="valor" class="form-label">Preço do Item</label>
                    <input type="number" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($linha['preco']); ?>" >
                </div>
                

                <div class="col-md-2">
                <div class="form-group">
                    <label for="tipo">Categoria</label>
                    <select class="form-control" id="cat" name="categoria">
                    <option value="0" <?php echo ($linha['categoria'] == 0) ? 'selected' : ''; ?>>Literatura</option>
                    <option value="1" <?php echo ($linha['categoria'] == 1) ? 'selected' : ''; ?>>Religioso</option>
                    <option value="2" <?php echo ($linha['categoria'] == 2) ? 'selected' : ''; ?>>Romance</option>
                    </select>
                    </div>
                </div>
               
               
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <img src="../imagens/<?php echo $linha['imagem']; ?>" alt="produto" class="img-fluid" style="max-width: 100%; max-height: 220px;">
                        <label class="input-group-text" for="inputGroupFile01">Troque</label>
                        <input type="file" name="imagem" class="form-control custom-file-input" id="inputGroupFile01">
                    </div>
                </div>
                <br>
                <div class="col-12 text-center">
                    <br><button type="submit" name="Atualizar"class="btn btn-success">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
            <?php }else {
                            echo "Produto não encontrado.";
                        }
                    
                 
                 ?>
      


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvFs+FyE+yTw" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+7/mz/WL2nwp3YS7bWKx6f+5C08jPLhp/e2" crossorigin="anonymous"></script>

</body>
</html>
