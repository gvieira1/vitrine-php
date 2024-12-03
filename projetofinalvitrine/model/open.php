<?php
  
include_once "../factory/conexao.php";
include_once "../control/passing.php";

session_start(); // Abre a sessão

$dados = new Passing();
$dados->setUsuario($_POST['txtlogin']);
$dados->setSenha($_POST['txtsenha']);

$login = $dados->getUsuario();
$senha = $_POST['txtsenha'];

$conn = new Caminho();
try {
    // Primeira consulta para obter o hash da senha
    $query = "SELECT hash_senha FROM funcionarios WHERE usuario = :usuario";
    $consulta = $conn->getConn()->prepare($query);
    $consulta->bindParam(':usuario', $login, PDO::PARAM_STR);
    $consulta->execute();
    $row = $consulta->fetch(PDO::FETCH_ASSOC);

    // Segunda consulta para obter o tipo de usuário
    $query2 = "SELECT tipo FROM funcionarios WHERE usuario = :usuario";
    $consulta2 = $conn->getConn()->prepare($query2);
    $consulta2->bindParam(':usuario', $login, PDO::PARAM_STR);
    $consulta2->execute();
    $row1 = $consulta2->fetch(PDO::FETCH_ASSOC);

    if ($row && $row1) {
        $hash_senha_armazenada = $row['hash_senha'];
        $tipo = $row1['tipo'];
        $_SESSION['tipo'] = $tipo;

        // Verifica a senha usando password_verify para maior segurança
        if (password_verify($senha, $hash_senha_armazenada)) {
            $_SESSION['login'] = $login; // Declara a sessão
            if ($tipo == 0) {
                echo "
                    <script>
                        alert('Seja Bem Vindo!');
                        window.location.href = '../view/menuadm.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Seja Bem Vindo!');
                        window.location.href = '../view/menufunc.php';
                    </script>
                ";
            }
        } else {
            echo "
                <script>
                    alert('Senha incorreta!');
                    window.location.href = '../view/login.php';
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Usuário não encontrado!');
                window.location.href = '../view/login.php';
            </script>
        ";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}


?>
