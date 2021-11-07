<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Yep Imports - Cadastro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="./images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <!-- =================================================================================================================================================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- =================================================================================================================================================== -->
</head>
<body>

    <form action="../app/cadastrar.php" method="POST">

        <label for="nome">Nome:</label>
		<input type="text" name="nome" required><br>

		<label for="email">Email:</label>
		<input type="email" name="email" required><br>

		<label for="senha">Senha:</label>
		<input type="password" name="senha" required><br>

        <label for="telefone">Telefone:</label>
		<input type="text" name="telefone" onkeypress="$(this).mask('(00)00000-0000')" required><br>

		<input type="submit" value="Cadastrar">

		<p>Já possui cadastro ? <a href="../index.php">Login</a></p>
		
	</form>
    
</body>
</html>