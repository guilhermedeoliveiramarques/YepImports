<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Yep Imports - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="./public/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
</head>
<body>

	<form action="./app/verificarLogin.php" method="POST">
		<label for="email">Email:</label>
		<input type="email" name="email">
		<label for="senha">Senha:</label>
		<input type="password" name="senha">

		<input type="submit" value="Entrar">

		<p>Não possui login? <a href="./public/cadastro.php">Cadastre-se</a></p>
		
	</form>
	
</body>
</html>