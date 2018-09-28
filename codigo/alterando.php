<?php

	include("conexao.php");
	$Nome_pizza = $_POST["Nome_pizza"];
	$preco_pizza= $_POST["preco_pizza"];
	$id_pizza = $_POST["id_pizza"];

	$update = "UPDATE pizza SET nome_pizza='$Nome_pizza', preco_pizza='$ingrediente_pizza_att' 
		WHERE id_pizza='$id_pizza'";
	mysqli_query($link,$update) or die("$update");

	$select= "SELECT Nome_pizza FROM pizza WHERE id_pizza = $id_pizza";
	$resultado = mysqli_query($link,$select) or die("erro");
	$linha = mysqli_fetch_array($resultado);
	
	echo $linha["Nome_pizza"];
?>