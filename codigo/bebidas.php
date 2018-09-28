<?php
	session_start();
	include("conexao.php");
	$sql = "SELECT * FROM bebidas ORDER BY nome_bebida";
	$resultado = mysqli_query($link,$sql) or die("erro");
	
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<title>Formulário de Bebidas</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="estilizando.css"/>
	<script src="jquery-3.3.1.min.js"></script>
	
	<script>
	/////////////////////////////////// OPÇÃO NÃO VÍSIVEL(PAROU DE PEGAR !!!) ////////////////////////////////////////////
		/* function div(valor) {
		  if (valor) {
			document.getElementById("visivel").style.display = "block";
		  } else {
			document.getElementById("visivel").style.display = "none";
		  }
		 
		}
		*/
	//////////////////////////////// FIM DE OPÇÃO VÍSIVEL /////////////////////////////////////////////
	
	////////////////////////////// CADASTRAR BEBIDA //////////////////////////////////////////////////
		$(document).ready(function(){
			    $("#cadastrar_bebida").click(function(){			    
			    	$.ajax({
			          url : "cadastro_bebida.php",
			          type : 'post',
			          data : {
			               nome_bebida: $("#nome_bebida").val(),
			               ingrediente_bebida : $("#ingrediente_bebida").val(),
			               preco_bebida: $("#preco_bebida").val()
			          },
			          beforeSend : function(){
			               $("#resultado").html("Cadastrando...");
			        }		
				     })

				     .done(function(msg){
				     	  var nova_linha = 
				     	  "<tr>" +
							"<td>" + $("#nome_bebida").val() + "</td>	" +
							"<td>" + $("#ingrediente_bebida").val() + "</td>	" +
							"<td>" + $("#preco_bebida").val() + "</td>" +
							"<td>" +								 
								"<button value='" + msg + "' class='botao_excluir'>Remover</button>" +
							"</td>" +
						  "</tr>";
				          $("table").append(nova_linha);
				          $("#resultado").html("<b>Cadastrado!!!</b>");
				     })

				     .fail(function(jqXHR, textStatus, msg){
				          alert(msg);
					 }); 
			        });
			/////////////////////  Fim do Cadastro Pizza //////////////////////////////////////////////////////
			
			////////////////////////////  BOTÃO EXCLUIR ////////////////////////////////////////////////////////
					$(document).on('click', '.botao_excluir', function() {
    				
				    var id = $(this).val();				   
			    	var linha = $(this).closest("tr");

			    	$.ajax({
			          url : "excluir_bebida.php",
			          type : 'post',
			          data : {
			               id_bebida : id
			          },
			          beforeSend : function(){
			               $("#resultado").html("Removendo...");
			          }
				     })

				     .done(function(msg){
				     	if(msg=="1"){					     	 
				     	  linha.remove();			 
				          $("#resultado").html("<b>REMOVIDO!!!</b>");
				      	}else{
				      		$("#resultado").html("<b>Não é possível remover esta pizza.</b>");
				      	}
				     })

				     .fail(function(jqXHR, textStatus, msg){
				          alert(msg);
					 }); 
			    });
			///////////////////////////////// FIM BOTÃO EXCLUIR ////////////////////////////////////////////////////
				
			
					 }); 
			    });				
			});
	</script>
</head>

<body>	
		<?php
			include "menu.inc";
			include "conexao.php";
		?>
		
    <div class="formulario_bebida">
	<form action="cadastro_bebida.php" name="cadastro_bebida" method="POST">
		
		<label>Nome da Bebida</label>
		<input type="text" name="nome_bebida"/>
		<br />
		
		<label>Preço</label>
		<input type="number" name="preco_bebida"/>
		<br />
		
	<label>Industrializado</label>
		<input type="radio" name="bebida" value="0" onclick="div(false)"/> Sim
		<input type="radio" name="bebida" value="1" onclick="div(true)"/> Não
	  
	 <input type="button" value="Cadastrar Nova Bebida" id="cadastrar_bebida"></input>	
	
	<div id="visivel" style="display:none;">
	<div class="industrializado">
  
		<input type="checkbox" name="ingrediente_bebida" id="opcaonao" value="Laranja">Laranja<br/>
		<input type="checkbox" name="ingrediente_bebida" id="opcaonao" value="Limão">Limão<br/>
		<input type="checkbox" name="ingrediente_bebida" id="opcaonao" value="Açucar">Açucar<br/>
		<input type="checkbox" name="ingrediente_bebida" id="opcaonao" value="Gelo">Gelo<br/>	
		<input type="checkbox" name="ingrediente_bebida" id="opcaonao" value="Abacaxi">Abacaxi<br/>	
		
	</div>
	</div>
		
	<label>.....Ou</label>
		<input type="text" placeholder="Adicionar novo Ingrediente" name="novo_ingrediente_bebida"/>
		<input type="button" value="ok" id="bebida_nova"/> 
		
		
	 </form>
	</div>
	
	<div class="tabela_bebida">
	<div id="resultado">
			Aguardando ação....
		</div>	
	
	
	<table border="1">
			<tr>
				<th>Bebida</th>	
				<th>Ingrediente</th>
				<th>Preço</th>
				<th>Ação</th>
			</tr>
	</div>
			<?php
			   include ("conexao.php");
			   $select = "SELECT * FROM bebidas";
			   
			   $resultado = mysqli_query($link,$select) or die(mysqli_error($link));
			   
				while($linha=mysqli_fetch_array($resultado)){
									
				echo "<tr>
					<td> " . $linha["nome_bebida"] . "</td>
					<td> " . $linha["ingrediente_bebida"] . "</td>
					<td> " . $linha["preco_bebida"] . "</td>
           				</tr>";
				}
			?>
		</table>
 </body>
</html>