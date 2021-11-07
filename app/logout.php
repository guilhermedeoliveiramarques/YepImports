<?php 

    // Iniciando sessão ou resumindo sessão existe   
    session_start(); 

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

    header("Location: ../index.php");