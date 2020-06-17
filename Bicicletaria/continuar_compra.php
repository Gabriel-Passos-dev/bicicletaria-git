<?php
session_start();

$cliente = $_SESSION['cliente'];
$cep = $_SESSION['cep_destino'];
$endereco = get_endereco($cep);

function get_endereco($cep_user){
	$cep_modificado = preg_replace("/[^0-9]/", "", $cep_user);
    $url = "http://viacep.com.br/ws/$cep_modificado/xml/";
    
    $xml = simplexml_load_file($url);
    return $xml;
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
<link rel="stylesheet" type="text/css" href="css/continuar_compra.css"> 
<!--FAVICON--><link rel="shortcut icon" type="image/x-icon" href="imagens/roda_head.png"><!--FIM DO FAVICON-->

<!--LINKS VALIDAÇÃO DE DADOS JQUERY-->
<script type="text/javascript" src="js/validacao_campos/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/validacao_campos/validacao_campos_cartao.js"></script>

<!--LINKS MASCARA DE CAMPOS JQUERY-->
<script type="text/javascript" src="js/mascara/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/mascara/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/mascara/mascara_manual.js"></script>

<!--FUNCOES DIVS-->

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
               <a href="paginas_carregamento/insert_session.php?id=<?php echo $row_menu['id_tipo'];?>&nome=<?php echo $row_menu[                'nome_tipo'];?>">
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
               <a href="paginas_carregamento/insert_session.php?id=<?php echo $row_menu['id_tipo'];?>&nome=<?php echo $row_menu['nome_tipo'];?>"><?php echo $row_menu['nome_tipo'];?>
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
             <input type="text" placeholder="O que você procura?" name="pesquisa" class="texto" onfocus="this.placeholder=''" onblur="this.placeholder='O que você procura?'"/>          
           	<td>            
           	    <button type="submit" class="button_pesquisa">
                <center><img src="imagens/botão-pesquisar.png" class="button_pesquisa"/></center>
                </button>
            </td>
          </td>
                 
        <?php if(isset($_SESSION['cliente'])){ ?>      
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
					<a href="carrinho_compras.php"><img src="imagens/carrinho_compras.png" /></a>
                <p class="preco_carrinho">
                <?php
				if(isset($_SESSION['itens'])){
					$itens = array_sum($_SESSION['itens']);
					if($itens == 1){	
						echo $itens." Item";
					}
					else if($itens > 1){
						echo $itens." Itens";
					}
					else{
						echo "CARRINHO VAZIO";	
					}
				}
                ?>
                </p>
                </center>
                </td>                
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

<!--ÁREA DE INFORMAÇÕES DA COMPRA-->
<section id="area_info">
	<center>
	<div id="area_button">
		<button id="cesta">Carrinho</button> 
		<button id="entrega">Entrega</button> 
		<button id="pagamento">Pagamento</button> 
	</div>
	</center>
	<div id="area_acao">
		<center>
		<div id="area_cesta"><!--INÍCIO DA ÁREA CESTA-->
			<center>
			<table id="carrinho_cesta" cellpadding="0" cellspacing="0">
				<tr class="cabecalho">
					<td>Produto</td>
					<td>Quantidade</td>
					<td>Subtotal</td>
				</tr>
				
			<?php			
			foreach($_SESSION['vendas'] as $venda){				
				foreach($_SESSION['dados'] as $dados){				
		    ?>
				<tr>
					<td class="dados"><?php echo $dados['nome_produto'];?></td>
					<td class="dados"><?php echo $dados['quantidade'];?></td>
					<td class="dados"><?php echo "R$ ".number_format($dados['valor_total'],2,",",".");?></td>
				</tr>
				<?php
				}
				?>
				<tr></tr>
				<tr>
					<td colspan="1" class="totais">Total de Produtos:</td><td class="dados"><?php echo $venda['total_produtos']?></td><td class="dados">-</td>
				</tr>
				<tr>
					<td colspan="2" class="totais">Valor do Frete:</td><td class="dados"><?php echo "R$ ".$_SESSION['frete']?></td>
				</tr>
				<tr>	
					<?php $valor_final = intval($_SESSION['frete']) + $venda['valor_final'];?>	
					<td colspan="2" class="totais">Total:</td><td class="dados"><?php echo "R$ ".number_format($valor_final,2,",","."); ?></td>
				</tr>
				<tr>				
					<td></td>
				</tr>
			<?php
			}
			?>
			</table> 
			<h3>OBS: A compra será entregue no endereço acima então, por favor, verifique se as informações estão corretas. Se alguma informação estiver errada, volte ao carrinho
			 e verifique o cep informado. Obrigado!			
			</h3>
			
			<button type="button" onclick="area('area_cesta', 'area_entrega', 'cesta', 'entrega');" class="button_prox">PRÓXIMO</button>
			
			</center>			
		</div>				   <!--FIM DA ÁREA CESTA-->
		<div id="area_entrega"><!--INÍCIO DA ÁREA ENTREGA-->
			<center>
			<table id="dados_entrega" cellspacing="0" cellpadding="0">
				<tr>
					<td class="label">Cliente:</td>
					<td class="dado_td"><input type="text" value="<?php echo $cliente;?>"></td>
				</tr>
				
			<form action="paginas_carregamento/finalizar_compra.php" method="post" id="formCompra">
				<tr>
					<td class="label"><label class="campo_form_entrega">CEP:</label></td>					
					<td class="dado_td"><input type="text" placeholder="99999-999" value="<?php echo $endereco->cep?>" readonly="true" name="cdt_cep"></td>
				</tr>	
				<tr>
					<td class="label"><label class="campo_form_entrega">Rua:</label></td>
					<td class="dado_td"><input type="text" placeholder="" value="<?php echo $endereco->logradouro;?>" readonly="true" name="cdt_rua"></td>
		</tr>
				<tr>
					<td class="label"><label class="campo_form_entrega">Nº:</label></td>
					<td class="dado_td"><input type="number" max="9999" size="6" placeholder="" name="cdt_num" id="num_casa">
						<span class="msg_input_vazio" id="span_msg_campo_vazio"></span>
					</td>
				</tr>	
				<tr>
					<td class="label"><label class="campo_form_entrega">Bairro:</label></td>
					<td class="dado_td"><input type="text" placeholder="" value="<?php echo $endereco->bairro;?>" readonly="true" name="cdt_bairro"></td>
				</tr>
				<tr>
					<td class="label"><label class="campo_form_entrega">Complemento:</label></td>
					<td class="dado_td"><input type="text" placeholder="Ex: Casa, Apartamento" name="cdt_complemento"></td>		
				</tr>
				<tr>
					<td class="label"><label class="campo_form_entrega">Cidade:</label></td>
					<td class="dado_td"><input type="text" placeholder="" value="<?php echo $endereco->localidade;?>" readonly="true" name="cdt_cidade"></td>	
				</tr>	
				<tr>
					<td class="label"><label class="campo_form_entrega">Estado:</label></td>
					<td class="dado_td"><select id="estado" style="pointer-events:none;" name="cdt_estado">
							<option value="<?php echo $endereco->uf;?>" selected><?php echo $endereco->uf;?></option>
						</select>
					</td>
				</tr>
					
			
			</table>
			</center>
			
			<h3>OBS: A compra será entregue no endereço acima então, por favor, verifique se as informações estão corretas. Se alguma informação estiver errada, volte ao carrinho
			 e verifique o cep informado. Obrigado!			
			</h3>			
			<BR>
			
			<input type="button" value="VOLTAR" onclick="area('area_entrega', 'area_cesta','entrega', 'cesta');" class="button_ant">
			<input type="button" value="CONFIRMAR ENDEREÇO" onclick="area('area_entrega', 'area_pagamento','entrega', 'pagamento');" class="button_prox">		
			
		</div>				     <!--FIM DA ÁREA ENTREGA-->
		<div id="area_pagamento"><!--INÍCIO DA ÁREA	PAGAMENTO-->
			
			<div id="op_pagamento">			
			<table id="form_pagamento" >
				<tr>
					<td>
						<label for="cartao">CARTÃO</label><br>
							<img src="imagens/cartao.jpg" class="img_pag" id="cartao"><br>
						<input type="radio" id="cartao" name="cdt_forma_pag" onclick="op_cartao()" value="1" checked><br>
					</td>
					<td>
						<label for="boleto">BOLETO</label><br>
							<img src="imagens/boleto.jpg" class="img_pag" id="boleto"><br>
						<input type="radio" id="boleto" name="cdt_forma_pag" onclick="op_boleto()" value="3"><br>
					</td>
				</tr>	
			</table>		
			</div>
			
			<center>			
			<div id="opcao_cartao">
				<table id="dados_cartao">
					<tr>
						<td class="cartao_esq">Número do Cartão: </td>
						<td class="cartao_dir"><input type="text" name="cdt_num_cartao" id="num_cartao" onchange="validacao_num_cartao()" required>
							<span class="msg_input_vazio" id="span_msg_campo_vazio_num_cartao"></span>
						</td>						
					</tr>
					<tr>
						<td class="cartao_esq">Nome impresso no cartão: </td>
						<td class="cartao_dir"><input type="text" name="cdt_nome_cartao" id="nome_cartao" onchange="validacao_nome_cartao()"required>
							<span class="msg_input_vazio" id="span_msg_campo_vazio_nome_cartao"></span>
						</td>						
					</tr>
					<tr>
						<td class="cartao_esq">Validade: </td>
						<td class="cartao_dir">
						<select name="cdt_val_mes">
							<option value="01">Janeiro</option>
							<option value="02">Fevereiro</option>
							<option value="03">Março</option>
							<option value="04">Abril</option>
							<option value="05">Maio</option>
							<option value="06">Junho</option>
							<option value="07">Julho</option>
							<option value="08">Agosto</option>
							<option value="09">Setembro</option>
							<option value="10">Outubro</option>
							<option value="11">Novembro</option>
							<option value="12">Dezembro</option>
							
						</select>
						<select name="cdt_val_ano">
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							<option value="2025">2025</option>
							<option value="2026">2026</option>
							<option value="2027">2027</option>
							<option value="2028">2028</option>
							<option value="2029">2029</option>
							<option value="2030">2030</option>
							<option value="2031">2031</option>
						</select>
						</td>
					</tr>
					<tr>
						<td class="cartao_esq">cvc:</td>
						<td class="cartao_dir"><input type="text" name="cdt_cvc" maxlength="3" id="cvc_cartao" onchange="validacao_cvc_cartao()"required>
							<span class="msg_input_vazio" id="span_msg_campo_vazio_cvc_cartao"></span>
						</td>						
					</tr>
					<tr>
						<td class="cartao_esq">Parcelar em:</td>
						<td class="cartao_dir"><input type="number" min="01" max="12" name="cdt_parcelas" id="parcelas_cartao" onchange="validacao_parcelas_cartao()"required>
							<span class="msg_input_vazio" id="span_msg_campo_vazio_parcelas_cartao"></span>
						</td>	
					</tr>
					<tr>					
						<td colspan="2">
							<center>
								<input type="button" value="VOLTAR" onclick="area('area_pagamento', 'area_entrega','pagamento', 'entrega');" class="button_ant">
								<input type="submit" value="FINALIZAR COMPRA" class="button_prox" 
								onclick="validacao_num_cartao(), validacao_nome_cartao(), validacao_cvc_cartao(), validacao_parcelas_cartao()">
						</td>
					</tr>
				</form>		
			</table>
			<h3>OBS: A compra será entregue no endereço acima então, por favor, verifique se as informações estão corretas. Se alguma informação estiver errada, volte ao carrinho
			 e verifique o cep informado. Obrigado!			
			</h3>
			</div>
			
			<div id="opcao_boleto">
			<h3>OBS: A compra será entregue no endereço acima então, por favor, verifique se as informações estão corretas. Se alguma informação estiver errada, volte ao carrinho
			 e verifique o cep informado. Obrigado!			
			</h3>
			</div>
			</center>			
			<h3>OBS: A compra será entregue no endereço acima então, por favor, verifique se as informações estão corretas. Se alguma informação estiver errada, volte ao carrinho
			 e verifique o cep informado. Obrigado!			
			</h3>
			
		</div>					<!--FIM DA ÁREA PAGAMENTO-->
		
		</center>
	</div>
	
</section>

<script type="text/javascript" src="js/info_compra_2.js"></script>
<!--<script type="text/javascript" src="js/info_compra.js"></script>--><!--Script da funções das áreas-->
<!--FIM DA ÁREA DE INFORMAÇÕES DA COMPRA-->

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