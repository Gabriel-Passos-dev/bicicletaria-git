<?php
session_start();

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
<link rel="stylesheet" type="text/css" href="css/pagina_inicial.css">  
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

<!--INÍCIO DA PRINCIPAL SESSÃO DA PÁGINA INICIAL-->
<section id="principal">
      <center>
      <div class="wrapper" >
      	<div class="jcarousel-wrapper"> 
            <div class="jcarousel">    
              <ul>
                 <li><img src="imagens/slide_1.jpg" alt="Image 1"></li>
                 <li><img src="imagens/slide_2.jpg" alt="Image 2"></li>
                 <li><img src="imagens/slide_3.png" alt="Image 3"></li>
              </ul>
			</div>                
                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                <a href="#" class="jcarousel-control-next">&rsaquo;</a>
                <p class="jcarousel-pagination"></p>
        </div>
      </div>
      </center>          
</section> 
<!--FIM DA PRINCIPAL SESSÃO DA PÁGINA INICIAL-->   

	<section id="area_ofertas">
      <h1 class="texto_anuncio">Ofertas</h1>    
    
	  <div id="ofertas">
        <ul class="prod_ofertas">
        <?php	
		$select_menu = $pdo->query("SELECT * FROM produtos
									INNER JOIN ofertas ON ofertas.id_produto_oferta = produtos.id_produto");
									
		while($row_menu = $select_menu->fetch()){
			$desconto_porcentagem = $row_menu['desconto'];
			$valor_unit= $row_menu['valor_unitario'];
		?>
    	  <li class="item_produto">
        	<ul class="att_item">
       <!--Nome--><li class="nome_prod"><?php echo $row_menu['nome_produto'];?></li>   
     <!--Imagem--><li class="img_prod"><img src="imagens_produtos/<?php echo $row_menu['img_produto'];?>"/></li>
     <!--Desconto--><li class="desconto">(<?php echo $desconto_porcentagem ?>% de desconto) </li>
<!--R$ Original--><li class="preco_original">De: 
               			<span class="valor_original" id="preco">
						  <?php echo "R$ ".number_format($valor_unit,2,",","."); ?>
                        </span>
                  </li>
<!--R$ Desconto--><li class="preco_desconto">Por:
						  <?php $desconto_valor = ($valor_unit/100) * $desconto_porcentagem;?>
                          <?php $valor_final = $valor_unit - $desconto_valor;?>
                	    <span class="valor_final">
						<?php echo "R$ ".number_format($valor_final,2,",",".");?>
                        </span>
                   </li>       	
            	   <li class="botao">
                   	  <a href="visualiza_produto.php?id_prod=<?php echo $row_menu['id_produto'];?>">                      
                 	 	 <button class="ver_produto">EU QUERO!</button>
                      </a>
                   </li>
            </ul>
        </li>
    	<?php
		}
		?>   
        </ul>
      </div>
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