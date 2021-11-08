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

<?php

    //Auto-Load
    require __DIR__ .'/../vendor/autoload.php';

    use \App\Db\Database;

    // Instanciar Objeto
    $database = new Database("tab_produto");

    use \PDO;

    // Verificar se já existe essa sessão, caso contrário, é criada
    if(!isset($_SESSION['itens'])){
        $_SESSION['itens'] = array();
    }

    // Verificar se o produto existe no carrinho, caso já exista, incrementa 
    if(isset($_GET['add']) && $_GET['add'] == "carrinho"){

        // Armazenar o ID
        $idProduto = $_GET['id'];

        if(isset($_SESSION['itens'][$idProduto])){
            $_SESSION['itens'][$idProduto] += 1;
        }else{
            $_SESSION['itens'][$idProduto] = 1;
        }

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yep Imports - Carrinho</title>
</head>
<body>
    <h1>Olá, <?= $_SESSION['nome'] ?></h1>

    <?php 
    
        // Exibir carrinho
        if(count($_SESSION['itens']) == 0){
            echo "Carrinho Vazio";

        }else{
            foreach($_SESSION['itens'] as $idProduto => $quantidade){
    
                $produtos = $database->selectProdutoById($idProduto);
                

                $totalPreco = $quantidade * $produtos[0]["preco"]; 

                echo '<h3>Nome: ' .$produtos[0]["nome"]. '</h3>';
                echo '<p>Preço: R$ ' .$produtos[0]["preco"]. '</p>';
                echo '<p>Quantidade: ' .$quantidade. '</p>';
                echo '<p>Valor Total: R$ ' .$totalPreco. '</p>';
                echo '<img src="' .$produtos[0]["imagem"]. '" alt="Camisa de Time">';
                echo '<a href="../app/removerProduto.php?remover=carrinho&id=' .$idProduto. '">Remover do carrinho</a>';
                echo '<hr>';

            }
        }

    ?>
 
    <a href="./home.php">Home</a>
    <a href="../app/logout.php">Fazer Logout</a>
</body>
</html>