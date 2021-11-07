<?php

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        session_unset(); // remove todas as variáveis de sessão
        session_destroy(); // destroi a sessão
        echo "<script>
                alert('Está página só pode ser acessa por usuário logado');
                window.location.href='../index.php';
            </script>";
            
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="../index.php">Fazer Logout</a>
</body>
</html>