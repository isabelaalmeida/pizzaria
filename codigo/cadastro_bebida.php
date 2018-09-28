<!DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>Cadastro de Bebidas</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="estilizando.css"/>
	</head>
	<body>
		<?php
			include ("conexao.php");
			include ("bebidas.php");
			
			$nome_bebida = $_POST["nome_bebida"];
			$ingrediente_bebida = $_POST["ingrediente_bebida"];
			$preco_bebida = $_POST["preco_bebida"];

			$insert ="INSERT INTO bebidas (nome_bebida,ingrediente_bebida,preco_bebida)
					VALUES ('$nome_bebida','$preco_bebida','$ingrediente_bebida')";
					
			for($i = 0; $i <= foreach($_POST["ingrediente_bebida"]); $i++){
				mysqli_query($link, $insert) or die(mysqli_error($link));
			  
			  $insert = "INSERT INTO bebida_ingrediente (nome_ingrediente_bebida) VALUES ('$id')";

			}
			
		?>
	</body>
</html>