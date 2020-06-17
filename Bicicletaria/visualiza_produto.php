<?php
session_start();
if(isset($_GET['id_prod'])){
   $_SESSION['id_produto'] = $_GET['id_prod'];
   header('location:visualiza_produto.php');
   exit;
  }	
	
if(isset($_SESSION['cliente'])){
   $cliente = $_SESSION['cliente'];
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
<link rel="stylesheet" type="text/css" href="css/visualizar_produto.css">
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
<title>Visualização do Produto</title>
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
               <a href="paginas_carregamento/insert_session.php?id=<?php echo $row_menu['id_tipo'];?>				            	               &nome=<?php echo $row_menu['nome_tipo'];?>"><?php echo $row_menu['nome_tipo'];?>
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
             <input type="text" placeholder="O que você procura?" name="pesquisa" class="texto" onfocus="this.placeholder=''" 		             onblur="this.placeholder='O que você procura?'"/>          
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
<section id="area_visu_produto">

    <div class="botao_back">
    <a href="pagina_inicial.php"><img src="imagens/botao_voltar.png" class="botao_voltar"/></a>
    </div>
	<?php 
	$produto = $_SESSION['id_produto'];
	
			/*FUNÇÃO DE FORMATAÇÃO DA DATA DA OFERTA DO PRODUTO*/
			function formata($data){
		
			$dia = substr($data,8,2);  
			$mes = substr($data,5,2); 
			$ano = substr($data,0,4);

			return $dia."/".$mes."/".$ano;			
			}	
			/*FIM DA FUNÇÃO*/
			
			$query_busca = $pdo-> query("SELECT * FROM produtos 
			INNER JOIN espec_produtos ON produtos.id_produto = espec_produtos.id_prod_espec 
			INNER JOIN ofertas ON ofertas.id_produto_oferta = produtos.id_produto
			WHERE produtos.id_produto = '$produto' LIMIT 1");
			 
			while($row_dados = $query_busca->fetch()){
			
			$desconto_porcentagem = $row_dados['desconto'];
			$valor_unit = $row_dados['valor_unitario'];	
			$parcelas = $row_dados['parcelas_max'];
			$oferta = $row_dados['data_fim_oferta'];
			$descricao = $row_dados['descricao'];
			$estoque = $row_dados['estoque'];
			
		?>
		<div class="area_visu_imagem">
    	  <center>        	
        	<p class="sub_titulo"><?php echo $row_dados['nome_produto'];?></p>
            <p class="marca"><?php echo "Produto Vendido e Enviado por: ".$row_dados['marca'];?></p>
            
            <div class="imagens_produtos">
            <?php
            $query_busca_img = $pdo-> query("SELECT DISTINCT img_produto FROM espec_produtos 
												 WHERE espec_produtos.id_prod_espec = '$produto'");					
			while($row_img = $query_busca_img->fetch()){
			?> 
        		<img src="imagens_produtos/<?php echo $row_img['img_produto'];?>" class="img_visu_produto"/>
            <?php
			}
			?>
            </div>
          </center>
   	    </div>
    
    <div class="area_visu_detalhes">
		 <ul id="lista_espec_produtos">            
          		 <p class="sub_titulo">INFORMAÇÕES TÉCNICAS</p>
          	    <li>
                	<span class="lado_esq">Estoque:</span>
                    <span class="lado_dir"> <?php echo $row_dados['estoque'];?></span>
                </li>
                <li>
                	<span class="lado_esq">Garantia:</span>
                    <span class="lado_dir"> <?php echo $row_dados['garantia']." mês(es)";?></span>
                </li>
                <li>
                	<span class="lado_esq">Cor(es):</span>
                	<span class="lado_dir">&nbsp; 
                	<?php
                	$query_busca_cor = $pdo-> query("SELECT DISTINCT cor, cod_cor FROM espec_produtos 
					WHERE espec_produtos.id_prod_espec = '$produto'");
					
					while($row_cor = $query_busca_cor->fetch()){
					?>                    
					<button class="cor_prod" style="background-color:<?php echo $row_cor['cod_cor'];?>; border:none;" 
                    title="<?php echo $row_cor['cor'];?>">
                    </button>
                    <?php
					}
					?>
              	    </span>
                </li>
            	<li>
                	<span class="lado_esq">Largura:</span>
                    <span class="lado_dir"> <?php echo $row_dados['largura']."m";?></span>
                </li> 
             	<li>
               		<span class="lado_esq">Comprimento:</span>
                	<span class="lado_dir"><?php echo $row_dados['comprimento']."m";?></span>
                </li>    
                <li>
               	    <span class="lado_esq">Altura:</span>
                    <span class="lado_dir"> <?php echo $row_dados['altura']."m";?></span>
                </li>
                <li>
                	<span class="lado_esq">Peso:</span>
                	<span class="lado_dir"> <?php echo $row_dados['peso']."kg";?></span>
                </li>
                <li>
                	<span class="lado_esq">Tamanho:</span>
                	<span class="lado_dir">&nbsp;
                	<?php
                	$query_busca_tamanho = $pdo-> query("SELECT DISTINCT tamanho FROM espec_produtos 
					WHERE espec_produtos.id_prod_espec = '$produto'");
					
					$contador = 0;
					$cont_tam = $query_busca_tamanho->rowCount();
					while($row_tamanho = $query_busca_tamanho->fetch()){
						echo $row_tamanho['tamanho'];
						$contador++;
						
						if($contador < $cont_tam){
						echo " / ";
						}						
					}
					?>
                   </span>
              </li>            	
            	<?php
				}
				?>    
         </ul>      
    </div>
    
    <div class="area_preco_prod">
        <center>
        <p class="sub_titulo">Valores do Produto</p>
    	<table id="valor_produto" border="0" cellspacing="0">        	
        	<tr>
            	<td colspan="2"></td>
            </tr>
        	<tr>
    			<td class="texto_valor_padrao">De:</td> 
               	<td class="valor_produto_padrao"><?php echo "R$ ".number_format($valor_unit,2,",","."); ?></td>
            </tr>    
            <tr>    
    			<td class="texto_valor_desconto">Por:</td>
				<?php $desconto_valor = ($valor_unit/100) * $desconto_porcentagem;?>
                <?php $valor_final = $valor_unit - $desconto_valor;?>
                <td class="valor_produto_final"><?php echo "R$ ".number_format($valor_final,2,",",".");?></td>
            </tr>
            <tr>
            	<td colspan="2" class="sem_juros_desconto">(Desconto de <?php echo $desconto_porcentagem."%)";?></td>
            </tr>
            <tr>
            	<td colspan="2" class="sem_juros_desconto">Oferta válida até: <?php echo formata($oferta);?></td>
            </tr>
            <tr>
            	<td class="vazio" colspan="2"></td>
            </tr>            
            <tr>    
                <td colspan="2" class="valor_prazo">
                <center>				
					<?php 
					$valor_prazo = $valor_unit/$parcelas;
					echo "Até ".$parcelas."x de ".number_format($valor_prazo,2,",","."); ?>
                </center>
                </td>                
            </tr>            
        </table> 
        </center>
        
        <ul>          
    	 	<li>        
        	<center>
					<?php 
					if($estoque > 0){?>
						<a href="carrinho_compras.php?add"/>					
						<button class="button_comprar_prod" style="cursor:pointer;">ADICIONAR AO CARRINHO</button>
					<?php 
						}
					else{?>
						<button class="button_comprar_prod" style="cursor:not-allowed;">ADICIONAR AO CARRINHO</button>
					<?php
					}
					?>					
            	 </a>	
          	</center>			         							         
            </li>
        </ul>  
    </div> 
	
	<center>
		<div class="desc_produto">
			<p class="sub_titulo">Descrição do Produto</p>
			<p class="texto_desc">
				<?php echo $descricao; ?>
			</p>
		</div>	
	</center>
</section>
   
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