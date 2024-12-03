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
    <title>Projeto PHP</title>

</head>
<body>

<div class="center-container">
    <div class="card login">
        <img src="../imagens/GV.png" class="card-img-top" alt="logo gvbooks">
        <form method="POST" action="../model/open.php">               
            <div class="form-group">
                <label for="InputLogin">Usuário</label>
                <br>
                <input type="text" class="form-control" placeholder="Seu usuário" name="txtlogin">
            </div>
            <div class="form-group">
                <label for="InputSenha">Senha</label>
                <br>
                <input type="password" class="form-control" placeholder="Sua Senha" name="txtsenha">
            </div>
            <br><br>
            <div class='centraliza'>
                <button type="submit" class="btn btn-secondary" name="confirmabtn">Entrar</button>
            </div>
        </form>
    </div>  
</div>

</body>
</html>