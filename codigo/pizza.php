<?php
	session_start();
	include("conexao.php");
	include("menu.inc");
	$sql = "SELECT * FROM pizza ORDER BY Nome_pizza";
	$resultado = mysqli_query($link,$sql) or die("erro");
	
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<title>Formulário de Pizza</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="estilizando.css"/>
	<script src="jquery-3.3.1.min.js"></script>

	<script>
	///////////////////////////////// CADASTRA INGREDIENTE(BOTAO) ////////////////////////////////////////////
			$(document).ready(function(){
				$("#cadastra_ingrediente").click(function(){
					$.ajax({
				  /// URL é uma string contendo o URL para o qual a solicitação é enviada. //
						url: "cadastro_ingrediente_pizza.php",
						type: 'post',
						data: {
							 ingrediente_pizza : $("#novo_ingrediente").val()},
						beforeSend: function(){
							$("#resultado").html("Cadastrando ingrediente...");
						}
					})
						.done(function(msg){
							var antigo = $("#ingredientes").html();
							var novo = "<input type='checkbox' name='ingrediente_pizza' value='" + msg + "' >" + $("#novo_ingrediente").val() + " <br>";
							$("#ingredientes").html(antigo + novo);
						})
						.fail(function(jqXHR, textStatus, msg){
							  alert(msg);
						});
					});
			
			////////////////////////////////////////// FIM DE CADASTRA INGREDIENTE ////////////////////////////////////////	
				
		//////////////////////////////////////////// CADASTRA PIZZA ///////////////////////////////////////////////////////
			$("#cadastrar_pizza").click(function(){			    
						$.ajax({
						  url : "cadastro_pizza.php",
						  type : 'post',
						  data : {
							   Nome_pizza : $("#Nome_pizza").val(),
							   preco_pizza : $("#preco_pizza").val(),
						  },
						  beforeSend : function(){
							   $("#resultado").html("Cadastrando...");
						  }	
						 })

						 .done(function(msg){      
							  var nova_linha = 
							  "<tr>" +
								"<td>" + $("#Nome_pizza").val() + "</td>	" +
								"<td>" + $("#preco_pizza").val() + "</td>" +
								"<td>" +								 
									"<button value='" + msg + "' class='botao_excluir'>Remover</button>" +
								"</td>" +
							  "</tr>";
							  $("#table").append(nova_linha);
							  $("#resultado").html("<b>Cadastrado!!!</b>");
						 })

						 .fail(function(jqXHR, textStatus, msg){
							  alert(msg);
						}); 
					});					
		////////////////////////////////// FIM CADASTRO PIZZA //////////////////////////////////////////////////
		
		
		//////////////////////////////////    EXCLUIR  /////////////////////////////////////////////////////////////
		
					$(".excluir").click(function(){
						$(this).closest("tr").remove();
					}); 	
		///////////////////////////////////////////  FIM EXCLUIR ////////////////////////////////////////////////////
					
		////////////////////////////////// ALTERAR DADOS /////////////////////////////////////////////////////////////
		
					$(".alterar").click(function(){
						alert($(this).children("input").val());
						$(this).closest("tr").update();
					});		
		////////////////////////////// FIM DE ALTERAR DADOS /////////////////////////////////////////////////////////////
					/////////////////////////////////    EXCLUIR  /////////////////////////////////////////////////////////////
		
					$(document).on("click", ".btn_excluir",function(){
					
					var linha = $(this).closest("tr");
					var id = $(this).val();
					
				$.ajax({
			          url : "excluir_pizza.php",
			          type : 'post',
			          data : {
			               id_pizza : id
			          },
			          beforeSend : function(){
			               $("#resultado").html("Removendo...");
			          }
				    })
				    .done(function(msg){
						linha.remove();
						$("#resultado").html("Removido!");
						  
				    })

				    .fail(function(jqXHR, textStatus, msg){
				          alert(msg);
					}); 
				}); 
		///////////////////////////////////////////  FIM EXCLUIR ////////////////////////////////////////////////////
					
		////////////////////////////////// ALTERAR DADOS /////////////////////////////////////////////////////////////
		
					/////////////alterar////////
				$(document).on("click", ".btn_alterar",function(){
					var id = $(this).val();
					
    				colunapizza = $(this).closest('tr').children("td.alt_Nome_pizza");
			    	pizza = colunapizza.html();
			    	colunaPreco = $(this).closest('tr').children("td.alt_preco_pizza");
			    	preco = colunaPreco.html();
					colunaingrediente= $(this).closest('tr').children("td.alt_ingrediente_pizza");
			    	brinde = colunaingrediente.html();
			    	colunapizza.html("<input type='text' id='alterar_Nome_pizza value='"+ Pizza +"' />");
			    	colunaPreco.html("<input type='text' id='alterar_preco_pizza' value='"+ preco +"' />");
			    	colunaingrediente.html("<input type='text' id='alterar_ingrediente_pizza' value='"+ ingrediente +"' />");
					
					
					$.ajax({
			          url : "alterar.php",
			          type : 'post',
			          data : {
			               id_alterar: id
			          },
			          beforeSend : function(){
			               $("#resultado").html("...");
			          }
				    })
				    .done(function(msg){
						colunapizza.html(msg);
						$("#resultado").html("Removido!");
						  
				    })

				    .fail(function(jqXHR, textStatus, msg){
				          alert(msg);
					}); 
			    	
			    	$(this).html("Finalizar alteração");
			    	$(this).addClass('btn_alterando');
     				$(this).removeClass('btn_alterar');
				});
				
				
				///////// alterando //////
				$(document).on("click", ".btn_alterando",function(){
					var id = $(this).val();
					
					colunapizza = $(this).closest('tr').children("td.alt_Nome_pizza");
			    	colunaPreco = $(this).closest('tr').children("td.alt_preco_pizza");
					colunaingrediente = $(this).closest('tr').children("td.alt_ingrediente_pizza");
					var nome_pizza = colunapizza.children("input").val();
					var preco_pizza = colunaPreco.children("input").val();
					var ingrediente_pizza = colunaingrediente.children("input").val();
					
					
					$.ajax({
			          url : "alterando.php",
			          type : 'post',
			          data : {
			               id: id,
						   nome_pizza : Nome_pizza,
						   preco_pizza : preco_pizza,
						   ingrediente_pizza: ingrediente_pizza
			          },
			          beforeSend : function(){
			               $("#status").html("Alterando...");
			          }
				    })
				    .done(function(msg){
						colunapizza.html(Nome_pizza);
						colunaPreco.html(preco_pizza);
						colunaingrediente.html(ingrediente_pizza);
						$("#status").html("Alterado!");
						  
				    })

				    .fail(function(jqXHR, textStatus, msg){
				          alert(msg);
					}); 
					
					$(this).html("Alterar");
					$(this).addClass('btn_alterar');
					$(this).removeClass('btn_alterando');
				});
		
			});	
	</script>
</head>

<body>
		<div class="formulario ">
				<label>Nome da Pizza</label>
				<input type="text" id="Nome_pizza" name="Nome_pizza" />
				<br />
				
				<label>Preço</label>
				<input type="number" id="preco_pizza"  name="preco_pizza"/>
				
				
				<div id="ingredientes">
					<label>Ingredientes</label><br/>

				<?php
			//Seleciona a tabela para e chama a variavel resultado para armazenar os checkbox de ingrediente_pizza ///					
				
					$sql = "SELECT * FROM ingrediente";
					
					$resultado = mysqli_query($link,$sql) or die("erro");
					
					while($linha=mysqli_fetch_array($resultado)){
						echo "<input type='checkbox' name='ingrediente_pizza' value='".$linha["id_ingrediente"]."' >".$linha["nome_ingrediente"]." <br>";
					}
					
				
				?>
				</div>
				<input type="button"id="cadastrar_pizza" value="Cadastrar" />
				</div>
				<br />
				<label>.....Ou</label>
				<input type="text" placeholder="Adicionar novo Ingrediente" name="novo_ingrediente" id="novo_ingrediente" />
				<input type="button" value="Ok" id="cadastra_ingrediente"/> 
				
			</div>

			<div class="tabela">
				
			<div id="resultado">
				<ul>
					<li><p class ="status_operacao">STATUS OPERAÇÃO</p></li>				
				</ul>
		    </div>
			  <table border="1">
			<tr>
				<th>Pizza</th>	
				<th>Ingrediente</th>
				<th>Preço</th>
				<th>Ação</th>
			</tr>
	          </div>
			
				<?php
				$select= "SELECT * FROM pizza";
				 include ("conexao.php");
				 
				while($linha = mysqli_fetch_array($resultado)){
					echo "<tr>
							<td class='alt_nome_pizza'  value='$linha[id_pizza]'>$linha[Nome_pizza]</td>	
							<td class='alt_preco_pizza'  value='$linha[id_pizza]'>$linha[preco_pizza]</td>
												
								<td><div class='excluir'><input type='hidden' value='2'/><img src=\"remover.png\"></div></td></img>
								
							
						  </tr>";
				}
			?>
			
			
			
		</table>
		</div>
		
</body>
</html>