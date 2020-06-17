<?php
session_start();

if(isset($_SESSION['cliente'])){
$cliente = $_SESSION['cliente'];
}
if(!isset($_SESSION['itens'])){
	$_SESSION['itens'] = array();
	}


/*ADICIONA AO CARRINHO*/	
	if(isset($_GET['add'])){		
		if(isset($_SESSION['id_produto'])){
			$id_produto = $_SESSION['id_produto'];
		
			if(!isset($_SESSION['itens'][$id_produto])){
				$_SESSION['itens'][$id_produto] = 1;			
			}
			else{
				$_SESSION['itens'][$id_produto] += 1;
			}
						
		header('Location:carrinho_compras.php');
		exit;		
		}
	}

/*REMOVE CARRINHO*/		
		if(isset($_GET['exc'])){
			$id_exclui = $_GET['exc'];
			unset($_SESSION['itens'][$id_exclui]);
			header('Location: carrinho_compras.php');
			exit;
		}
	
/*ATUALIZAR QUANTIDADE*/		
		if(isset($_POST['prod'])){
			if(is_array($_POST['prod'])){
				foreach($_POST['prod'] as $produto => $quantidade){
					$produto = intval($produto);
					$quantidade = intval($quantidade);
					if(!empty($quantidade) or $quantidade <> 0){
						$_SESSION['itens'][$produto] = $quantidade;
					}
					else{
						unset($_SESSION['itens'][$produto]);
					}		
				}		
			}
		}
//CALCULO FRETE

if(isset($_GET['frete']) and isset($_GET['prazo'])){
	$_SESSION['frete'] = $_GET['frete'];
	$_SESSION['prazo'] = $_GET['prazo'];
	header('Location:carrinho_compras.php');
	}	
clearstatcache();

if(isset($_POST['calc_frete'])){
if(isset($_POST['cep_frete']) and $_POST['cep_frete'] != NULL){
	
		$cep_destino = $_POST['cep_frete'];
		$cod_servico = $_POST['forma_entrega'];
		$larg_final = $_POST['largura'];
		$comp_final = $_POST['comprimento'];
		$alt_final = $_POST['altura'];
		$peso_final = $_POST['peso'];
		
		$_SESSION['forma_entrega'] = $_POST['forma_entrega'];
		$_SESSION['cep_destino'] = $_POST['cep_frete'];
		
header('Location:paginas_carregamento/funcao_frete_carrinho.php?cep='.$cep_destino.'&serv='.$cod_servico.'&larg='.$larg_final.'&comp='.$comp_final.'&alt='.$alt_final.'&peso='.$peso_final.'');
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--MENU RESPONSIVO MATERIALIZE  -->
<link type="text/css" rel="stylesheet" href="css/menu_materialize/materialize.css"/>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">   
<!-- CSS PADRÃO-->
<link rel="stylesheet" type="text/css" href="css/padrao.css">
<link rel="stylesheet" type="text/css" href="css/pagina_inicial.css">  
<link rel="stylesheet" type="text/css" href="css/carrinho_compras.css"> 
<!--FAVICON--><link rel="shortcut icon" type="image/x-icon" href="imagens/roda_head.png"><!--FIM DO FAVICON-->

<!--LINKS JCAROUSEL-->
<script type="text/javascript" src="js/carousel/jquery.js"></script>
<script type="text/javascript" src="js/carousel/jcarousel.responsive.js"></script>
<script type="text/javascript" src="js/carousel/jquery.jcarousel.js"></script>
<link rel="stylesheet" type="text/css" href="css/carousel/jcarousel.responsive.css">

<!--LINKS VALIDAÇÃO DE DADOS JQUERY-->
<script type="text/javascript" src="js/validacao_campos/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/validacao_campos/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validacao_campos/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/validacao_campos/js/messages_pt_BR.js"></script>
<script type="text/javascript" src="js/validacao_campos/js/validacao_manual.js"></script>

<!--LINKS MASCARA DE CAMPOS JQUERY-->
<script type="text/javascript" src="js/mascara/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/mascara/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/mascara/mascara_manual.js"></script>

<!--LINK: FUNÇÃO ATUALIZA CARRINHO AUTOMATICAMENTE-->
<script type="text/javascript" src="js/funcao_atualiza_carrinho.js"></script>
<title>Air Roads</title>

</head>

<body>
<!--INÍCIO DO CABEÇALHO-->
<header>
  <section id="topo" >
    
    <!--Menu-->
	<script src="css/menu_materialize/materialize.js"></script>  
    <script>
	$(function(){
     $(".button-collapse").sideNav();
 	});
	</script>  
      
<nav>   
    <div class="nav-wrapper" >
         <a href="#" class="brand-logo">        
         
         <!--Logo-->
		<figure id="logo">
    		<img src="imagens/logo.png" id="logo" title="Air Roads"/>
    	</figure>
    	<!--Fim da logo-->
         </a>
                  
         <a href="#" data-activates="menu-mobile" class="button-collapse">
             <i class="material-icons">menu</i>
         </a>
         
         <ul class="right hide-on-med-and-down">
         
          <?php	
		  include("conexao/conexao.php");
		  
		  $favicon = 1;
		  $select_menu = $pdo->query("SELECT * FROM tipo_produto");
		  while($row_menu = $select_menu->fetch()){
		  ?>          	 
              <li id="dados_menu">
            	<a href="paginas_carregamento/insert_session.php?id=
					<?php echo $row_menu['id_tipo'];?>&nome=<?php echo $row_menu['nome_tipo'];?>">
					<?php echo $row_menu['nome_tipo'];?>
            	</a>				
              </li>             
          <?php 
		  $favicon++;
		  }
		  ?>
          
         </ul>
         
         <ul class="side-nav" id="menu-mobile" >
          <?php			 
		  $favicon_mobile = 1;
		  $select_menu = $pdo->query("SELECT * FROM tipo_produto");
		  while($row_menu = $select_menu->fetch()){
		  ?>          	 
             <li id="dados_menu_mobile">
               <a href="paginas_carregamento/insert_session.php?id=
			 		<?php echo $row_menu['id_tipo'];?>&nome=<?php echo $row_menu['nome_tipo'];?>">
					<?php echo $row_menu['nome_tipo'];?>
               </a>
             </li>             
          <?php 
		  $favicon_mobile++;
		  }
		  ?>
       </ul>
     </div>
</nav>
    <!--Fim do Menu--> 
</section>

<nav id="barra_pesquisa">
<table id="area_user" border="0">
   <tr class="area_usuario">
          <td class="area_pesquisa">
      		<form action="pagina_pesquisa.php" method="post" class="form_pesquisa" id="formPesquisa">
            <input type="text" placeholder="O que você procura?" name="pesquisa" class="texto"
            onfocus="this.placeholder=''" onblur="this.placeholder='O que você procura?'"/>          
          	<td>            
           		<button type="submit" class="button_pesquisa">
            	<center><img src="imagens/botão-pesquisar.png" class="button_pesquisa"/></center>
            	</button>
          	</td>
          </td>                 
          <?php
		    if(isset($_SESSION['cliente'])){
		  ?>
      
          <td> 
          <center>    
          <div class="botao_dados_user">          
          <table id="dados_user" border="0">
          	 <tr>
         	    <td class="bem_vindo">                	
                  <center>
                	<a href="paginas_carregamento/meus_dados.php">
                	<button class="meus_dados" type="button">CONTA</button>
                	</a><br />
                	<a href="paginas_carregamento/deslogar.php">
                	<button class="deslogar" type="button">SAIR</button>
                	</a>                
                  </center>
                </td>       
                <td class="carrinho_compras">
                	<center>
                    	<img src="imagens/carrinho_compras.png" />
                		<p class="preco_carrinho">
                		<?php
						if(isset($_SESSION['itens'])){
							$itens = array_sum($_SESSION['itens']);
							if($itens == 1){	
               	   	    		echo $itens." Item<br>";
							}
							else if($itens > 1){
								echo $itens." Itens<br>";
							}									
							else{
								echo "CARRINHO VAZIO";	
							}
					   }
                	   ?>
                	   </p>
                   </center>
                </td>
            </tr>               
       </table>       
       </div>
       </center>
       <?php 
	   }
	   else{				 
		?>	
       <td class="area_login_register">
       <center>
          <a href="seleciona_tipo_pessoa.php">        
        	  <button type="button" class="botao_login_cadastro">LOGIN / CADASTRO</button>
          </a>
       </center>    
       </td>     
	   <?php
	   }
	   ?> 
       </form> 
   </tr>
</table>
</nav>
</header>
<!--FIM DO CABEÇALHO-->

<!--SEÇÃO CARRINHO DE COMPRAS-->
<center>
<section id="carrinho_compras">
<table id="carrinho_compras" border="0" cellpadding="0" cellspacing="0">
	<?php
	include("conexao/conexao.php");

	/*EXIBE O CARRINHO*/
	$valor = count($_SESSION['itens']);
	if($valor == 0){
	?>
   		 <tr class="indice">
			<td>Produto</td>            
    		<td>Valor Unitário</td>
    		<td>Quantidade</td>
    		<td>Desconto</td>
            <td>Subtotal</td>
            <td>Exclusão</td>
    	</tr>
        <tr>
        	<td colspan="6" class="carrinho_vazio"><center><?php echo "CARRINHO VAZIO"; ?></center></td>
		</tr>
    <?php		
	}	
	else{
		$_SESSION['dados'] = array();
		$_SESSION['vendas'] = array();		
	?>

	<tr class="indice">
		<td colspan="3">Produto</td>
    	<td>Valor Unitário</td>
    	<td>Quantidade</td>
    	<td>Desconto</td>
        <td>Subtotal</td>
        <td>Exclusão</td>
	</tr>
	
	
	<form action="" method="post" name="formCarrinho" id="formCarrinho">	
   
	<?php	
		$quant_carrinho = count($_SESSION['itens']);
		$valor_final = 0;
		$largura_final = 0;
		$comprimento_final = 0;
		$altura_final = 0;
		$peso_final = 0;		

		foreach($_SESSION['itens'] as $produto => $quantidade){
			$query_busca = $pdo-> query("SELECT * FROM produtos 
			INNER JOIN espec_produtos ON produtos.id_produto = espec_produtos.id_prod_espec
			INNER JOIN ofertas ON produtos.id_produto = ofertas.id_produto_oferta 
			WHERE produtos.id_produto = '$produto' LIMIT 1");
					
		while($row_dados = $query_busca->fetch()){
			$nome_produto = $row_dados['nome_produto'];
			$id_prod = $row_dados['id_produto'];
			$valor_unitario = $row_dados['valor_unitario']; 
			$desconto = $row_dados['desconto'];
			$marca = $row_dados['marca'];
			$estoque = $row_dados['estoque'];
						
			$largura = $row_dados['largura'];
			$comprimento = $row_dados['comprimento'];
			$altura = $row_dados['altura'];
			$peso = $row_dados['peso'];
		?>	

			<tr class="produtos">
                <td colspan="3"><?php echo $nome_produto; ?></td>				
				<td><?php echo number_format($valor_unitario,2,",",".");?></td>
				
				<td class="funcao_att_quant"><input type="number" name="prod[<?php echo $produto;?>]" value="<?php echo $quantidade;?>" 
					max="<?php echo $estoque;?>" class="quantidade" id="quant" onchange="calc_total();"/>					
					<h5 style="color:#900;">Estoque: <?php echo $estoque;?></h5>
                </td>
                <td><?php echo $desconto."%";?></td>
                <td id="total">			
								
					<?php
					
					$valor_total = ($valor_unitario * $quantidade) - (($valor_unitario/100) * $desconto);
					echo "R$ ".number_format($valor_total,2,",","."); 
					$valor_final += $valor_total;
												
					?>
				
                </td>
                <td>
                    <a href="carrinho_compras.php?exc=<?php echo $id_prod;?>" class="excluir_produto"/>Remover</a>               
                </td> 	
            </tr>
                
		<?php
		//COLOCA AS INFORMAÇÕES DE CADA PRODUTO NO ARRAY ABAIXO PRA ENVIAR PRA PÁGINA DE FINALIZAR COMPRA
		array_push($_SESSION['dados'],
		array(
		'nome_produto' => $nome_produto,
		'id_produto' => $id_prod,
		'marca'		 => $marca,	
		'valor_unit' => $valor_unitario,
		'desconto'   => $desconto,	
		'quantidade' => $quantidade,	
		'valor_total'=> $valor_total
			 )
		);		
			?>
			
			<?php
			
		}//Fim do While
		
		$largura_final += ($largura*$quantidade);
		$comprimento_final += $comprimento;
		$altura_final += $altura;
		$peso_final += $peso;
					
	    }//Fim do Foreach
		?>
		<input type="hidden" value="<?php echo $largura_final; ?>" name="largura">
		<input type="hidden" value="<?php echo $comprimento_final; ?>" name="comprimento">
		<input type="hidden" value="<?php echo $altura_final; ?>" name="altura">
		<input type="hidden" value="<?php echo $peso_final; ?>" name="peso">
		<?php
	}//Fim do Else
	?>
   <tr>
		
		
		<td colspan="6" class="td_espaco"></td>
   </tr>
   
	<?php
	if(isset($quant_carrinho) > 0){
	?>    
   	    <tr>
    		
    	</tr>
    	<tr>
        	<td colspan="3" class="form_pag_esq" style="border-top-left-radius:5px;">CEP:</td>
        	<td colspan="1" class="form_pag_esq_dir" style="border-top-right-radius:5px;">
            <input type="text" id="cep_frete" name="cep_frete" placeholder="CEP sem espaços e traços"  class="campo_frete"
            <?php 
			if(isset($_SESSION['cep_destino'])){
				if($_SESSION['cep_destino'] != NULL){
            		echo "value=".$_SESSION['cep_destino']."";
				}
				else if($_SESSION['cep_destino'] == "/"){
					echo "value="." ";
					}
			 }
            ?>
            />
			</td>
            <td rowspan="2">
				<input type="submit" name="calc_frete" class="calc_frete" value="Calcular Frete">
			</td> 
      </tr>
      <tr>		
      		<td colspan="3" class="form_pag_esq">Forma de Entrega:</td>
        	<td colspan="1" class="form_pag_esq_dir">
        		<select value="Forma de Pagamento" name="forma_entrega">
                <?php 
					if(isset($_SESSION['forma_entrega'])){
				?>
                    <option value="<?php echo $_SESSION['forma_entrega'];?>" class="escolha">
					<?php
						switch($_SESSION['forma_entrega']){
						case 'SEDEX': echo "SEDEX";
								break;									  
						case'SEDEXACOBRAR': echo "SEDEXACOBRAR";
								break;									 	 
						case 'SEDEX10': echo "SEDEX10";
								break;
						case 'PAC': echo "PAC";
								break;												  	
						} 
			    	}
					?>
                    </option>
                    <option value="SEDEX10">SEDEX10</option>
                    <option value="SEDEXACOBRAR">SEDEXACOBRAR</option>
                    <option value="SEDEX">SEDEX</option>
                    <option value="PAC">PAC</option>
   			    </select>  				
				
           </td> 
           <td></td> 
			
    	<?php
			$quant_final = array_sum($_SESSION['itens']);
								
			//IGUAL O ARRAY DADOS EM CIMA, 	ESSE ENVIA AS INFORMAÇÕES DE PAGAMENTO
			array_push($_SESSION['vendas'],
			array(
			'total_produtos'  => $quant_final,
			'valor_final'     => $valor_final,	
			 )		
			);		
    		
   	    ?>
     	   <tr>    
        	  <td colspan="3" class="form_pag_esq">Valor Frete:</td>
        	  <td colspan="1" class="form_pag_esq_dir">
			  <?php 
				if(isset($_SESSION['frete'])){
					if($_SESSION['frete'] > 0){ 
						echo "R$ ".$_SESSION['frete'];
						$valor_final = $valor_final + intval($_SESSION['frete']);
					}
					else{
						echo $_SESSION['frete'];
						}
				}
				else{
				    echo " - ";
				}
			 ?>
             </td>
             <td></td>       		
     		 
	    </tr>
        <tr>
        	<td colspan="3" class="form_pag_esq" style="border-bottom-left-radius:5px;">Prazo de Entrega:</td>
            <td colspan="1"  class="form_pag_esq_dir" style="border-bottom-right-radius:5px;">			
			<?php 
				if(isset($_SESSION['prazo'])){ 
					echo $_SESSION['prazo'];
				}
				else{
					echo " - ";
					}			
			?>            
            </td>
    		<?php 
			if(isset($parcelas)){
				$valor_parcelado = $valor_final/$parcelas;
			?>
            <td></td>
       	 	<?php
			}
			?>
			
			<td></td>
			<td class="form_pag_dir">Total:</td>
        	   <td colspan="1" class="form_pag_dir_dir">       
        		<?php echo "R$ ".number_format($valor_final,2,",","."); ?>       
			</td>
        </tr> 
	<?php	
	}//fim do if do $quant_carrinho
	?>
   
    <tr>
		<td colspan="6" class="td_espaco"></td>
   	</tr>
    <tr class="fim_table">
    	<td colspan="5" id="funcao_att"> 
        	<center>
        	<input type="submit" value="Atualizar Carrinho" class="input_att" name="update_cart"/>
						
        	<a href="pagina_inicial.php">
        		<button type="button" class="button_comprar">Continuar Comprando</button>
        	</a>        
       	    </center>        
        </td>
        <td></td>
        <td></td>
   	 	<td colspan="2">
        	<center>
				<?php
				if(count($_SESSION['itens']) > 0){
					?>
				<a href="paginas_carregamento/verifica_login_frete.php">        		
            		<input type="button" value="Continuar Compra" class="input_finish" style="cursor:pointer;"/>           		
				</a>
				<?php 
				}
				else{
					?>
					<input type="button" value="Finalizar Compra" class="input_finish" style="cursor:not-allowed;"/>
				<?php
					}
				?>
            </center>
        </td>
    </tr>
</form>
</table><!--Fim da table carrinho de compras-->
</center>
</section>
<!--FIM DA SEÇÃO CARRINHO DE COMPRAS-->

<!--INÍCIO DO RODAPÉ-->
<footer id="rodape"> 		
 		<div class="localidade">
		<center>
        <table border="0" class="endereco">
        	<tr>
            	<td><img src="imagens/rua.png" class="icone_rodape"/></td>
            	<td>Rua Monsenhor Prado Nogueira, 1530<br /></td>
                <td><img src="imagens/twitter.png" class="img_rede_social" title="Twitter Air Roads"/></td>
            </tr>
            <tr>
        		<td><img src="imagens/bairro.png" class="icone_rodape"/></td>
                <td>Vila Albuquerque - SP | CEP: 16402-520<br /></td>
                <td><img src="imagens/facebook.png" class="img_rede_social" title="Facebook Air Roads"/></td>
            </tr>
            <tr> 
            	<td><img src="imagens/telefone.png" class="icone_rodape"/></td>
                <td>Telefones de Contato: (14) 99186-3512 | 3532-8923<br /></td>
                <td><img src="imagens/whatsapp.png" class="img_rede_social" title="Whatsapp Air Roads"/></td>
            </tr>
            <tr>    
        		<td><img src="imagens/email.png" class="icone_rodape"/></td>
                <td>Email: bikes-air.roads@gmail.com.br<br /></td>
                <td><img src="imagens/youtube.png" class="img_rede_social" title="Youtube Air Roads"/></td>
            </tr>  
       </table>        
       </center>
       </div>      
        
 		<center><h1 class="copyright">Air Roads &copy; 2019 -  Todos os Direitos Reservados</h1></center>
 		<center><h2 class="desenvolvimento">Desenvolvido por Gabriel Passos</h2></center>
</footer>
<!--FIM DO RODAPÉ-->	 
</body>
</html>

			