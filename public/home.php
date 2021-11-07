<?php
    
    // Iniciando sessão ou resumindo sessão existe 
    session_start(); 

    if(!isset($_SESSION["email"]) || !isset($_SESSION["nome"])){

        $_SESSION = array();

        // Apagando os cookies de sessão
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destruindo a sessão
        session_destroy();

        echo "<script>
                alert('Está página só pode ser acessa por usuário logado');
                window.location.href='../index.php';
            </script>";
            
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yep Imports - Home</title>
</head>
<body>
    <h1>Olá, <?= $_SESSION['nome'] ?></h1>
    <a href="../app/logout.php">Fazer Logout</a>
</body>
</html>