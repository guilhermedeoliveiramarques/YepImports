<? 

    // Iniciar sessão ou resumindo sessão existe 
    session_start();

    // Remover itens do carrinho
    if(isset($_GET['remover']) && $_GET['remover'] == "carrinho"){

        // Armazenar o ID
        $idProduto = $_GET['id'];

        // Excluir sessão apenas do produto indicado pelo ID
        unset($_SESSION['itens'][$idProduto]);

        echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=../public/carrinho.php"/>';
    }