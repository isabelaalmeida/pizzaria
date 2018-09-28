<?php
	include ("conexao.php");
	include "menu.inc";
			
	$ingrediente_pizza = $_POST["ingrediente_pizza"];
		
	$insert = "INSERT INTO ingrediente (nome_ingrediente) VALUES ('$ingrediente_pizza')";
			
	mysqli_query($link, $insert) or die(mysqli_error($link));
	$id = mysqli_insert_id($link);
	
	echo $id;
?>