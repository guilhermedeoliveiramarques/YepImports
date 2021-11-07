<?php

    // Iniciando Sessão
    session_start();
    
    //Auto-Load
    require __DIR__ .'/../vendor/autoload.php';

    use \App\Db\Database;
    use \App\Entity\Usuario;

    // Verificar se os dados não estão vazios, se estiverem , irá redirecionar para o index.php
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
        
        // Instanciando Objetos
        $database = new Database("tab_usuario");
        $usuario = new Usuario();
  
        // Receber Dados do Formulário e Armazenando
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        
        // Selecionando o usuario
        $retornoBanco = $database->selectUsuario($email);

        if(isset($retornoBanco) && !empty($retornoBanco)){
            // Verificar login
            if($usuario->verficarLogin($retornoBanco, $senha)){
                header("Location: ../public/home.php");

            }else{
                session_unset(); // remove todas as variáveis de sessão
                session_destroy(); // destroi a sessão
                header("Location: ../index.php");
            }

        }else{
            session_unset(); // remove todas as variáveis de sessão
            session_destroy(); // destroi a sessão
            header("Location: ../index.php");
        }

    }else{
        session_unset(); // remove todas as variáveis de sessão
        session_destroy(); // destroi a sessão
        header("Location: ../index.php");
    }
