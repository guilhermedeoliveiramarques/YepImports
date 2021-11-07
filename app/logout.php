<?php 

    session_start(); //  Iniciando sessão ou resumindo sessão existe   

    session_unset(); // remove todas as variáveis de sessão
    session_destroy(); // destroi a sessão
    header("Location: ../index.php");