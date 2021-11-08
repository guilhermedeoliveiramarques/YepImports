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

    if(!isset($_GET['nomeCamiseta'])){
        header("Location: ./home.php");
        exit;
    }

    //Armazenar o nome da camiseta
    $nomeCamiseta = "%" .trim($_GET['nomeCamiseta']). "%";

    //Auto-Load
    require __DIR__ .'/../vendor/autoload.php';

    use \App\Db\Database;

    // Instanciar Objeto
    $database = new Database("tab_produto");

    $retornoBanco = $database->selectProdutoByNome($nomeCamiseta);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="./images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <title>Yep Imports - Resultado da Busca</title>
</head>
<body>

    <h1>Olá, <?= $_SESSION['nome'] ?></h1>

    <?php

        // Exibir os resultados
        if(count($retornoBanco)){
            foreach($retornoBanco as $resultado){
                echo '<h3>Nome: ' .$resultado['nome']. '</h3>';
                echo '<p>Preço: R$ ' .$resultado['preco']. '</p>';
                echo '<img src="' .$resultado['imagem']. '" alt="Camisa de Time">';
                echo '<hr>';
            }
        }else{
            echo '<h2>Não foram encontrados resultados pelo termo buscado</h2>';
        }
    ?>

    <a href="./home.php">Home</a>
    <a href="../app/logout.php">Fazer Logout</a>

</body>
</html>

    



   