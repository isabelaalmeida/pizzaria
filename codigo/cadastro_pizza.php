<!DOCTYPE html>
<html lang="PT-BR">
<?php
	include("conexao.php");
?>
	<head>
		<title>Cadastro de Pizza</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="estilizando.css"/>
		<script src="jquery-3.3.1.min.js"></script>

	</head>	
	<body>
		<?php
			include ("conexao.php");
				
				$Nome_pizza = $_POST["Nome_pizza"];
				$preco_pizza =$_POST["preco_pizza"];
			
		
			$insert ="INSERT INTO pizza (Nome_pizza,preco_pizza) VALUES ('$Nome_pizza','$preco_pizza')";
			mysqli_query($link, $insert) or die(mysqli_error($link));
			$id = mysqli_insert_id($link);
			
			for($i = 0; $i <= foreach($_POST["ingrediente_pizza"]); $i++){
				mysqli_query($link, $insert) or die(mysqli_error($link));
				
				$insert = "INSERT INTO pizza_ingrediente (nome_ingrediente) VALUES ('$id_ingrediente')";

			}
			mysqli_query($link,$insert) or die("erro");
			
					
				

		?>
	</body>
</html>