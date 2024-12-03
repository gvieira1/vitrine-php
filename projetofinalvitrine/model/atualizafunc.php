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
<title>Atualizar Funcionário</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" >
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <img src="../imagens/GV.png" alt="Logo" width="35%">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto ">
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
    </div>
</nav>


<div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="col-md-12 mx-auto">
        <div class="bg-custom">
            <h3 class="mb-4">Atualizar Funcionário</h3>
            <?php
            // Inclusão das classes necessárias e consulta ao banco de dados
            include_once "../factory/conexao.php";
            include_once "../control/passing.php";

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                try {
                    $conn = new Caminho;

                    $consulta = "SELECT * FROM funcionarios WHERE id = :id";
                    $stm = $conn->getConn()->prepare($consulta);
                    $stm->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stm->execute();
                    $funcionario = $stm->fetch(PDO::FETCH_ASSOC);

                    if ($funcionario) {
            ?>
                    <form action="atualizar_funcionario.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($funcionario['id']); ?>">
                                
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nome">Nome Completo:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($funcionario['nome']); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($funcionario['email']); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario">Usuário:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo htmlspecialchars($funcionario['usuario']); ?>"  disabled readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="data">Data de Nascimento:</label>
                                    <input type="date" class="form-control" id="data" name="data" value="<?php echo htmlspecialchars($funcionario['data_nascimento']); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefone">Telefone:</label>
                                    <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($funcionario['telefone']); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipo">Tipo de Usuário:</label>
                                    <select class="form-control" id="tipo" name="tipo">
                                        <option value="0" <?php echo ($funcionario['tipo'] == 0) ? 'selected' : ''; ?>>Administrador</option>
                                        <option value="1" <?php echo ($funcionario['tipo'] == 1) ? 'selected' : ''; ?>>Funcionário</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                <?php
                    } else {
                        echo "Funcionário não encontrado.";
                    }
                    } catch (PDOException $e) {
                        echo "Erro: " . $e->getMessage();
                    }
                } else {
                    echo "ID de funcionário não especificado.";
                }
                ?>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
