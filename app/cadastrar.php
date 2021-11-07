<?php

    //Auto-Load
    require __DIR__ .'/../vendor/autoload.php';

    use \App\Db\Database;
    use \App\Entity\Usuario;

    // Instanciando Objetos
    $database = new Database("tab_usuario");

    // Receber Dados do Formulário e Armazenar                                 
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $telefone = addslashes($_POST['telefone']);

    // Criptografia da senha                                         
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $values = array(
        'nome' => $nome,
        'email' => $email,
        'senha' => $senhaHash,
        'telefone' => $telefone
    );

    if($database->insertUsuario($values)){
        header("Location: ../index.php");

    }else{
        header("Location: ../public/cadastro.php");
    }



    

