<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial_escale=1.0" />

<!--MENU RESPONSIVO MATERIALIZE  -->
<link type="text/css" rel="stylesheet" href="css/menu_materialize/materialize.css"/>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- CSS PADRÃO-->
<link rel="stylesheet" type="text/css" href="css/padrao.css">
<link rel="stylesheet" type="text/css" href="css/login_e_cadastro.css">
<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet"> 
<!--FAVICON--><link rel="shortcut icon" type="image/x-icon" href="imagens/roda_head.png"><!--FIM DO FAVICON-->

<!--LINKS VALIDAÇÃO DE DADOS JQUERY-->
<script type="text/javascript" src="js/validacao_campos/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/validacao_campos/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validacao_campos/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/validacao_campos/js/additional-methods.min.js"></script>
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
  <section id="topo">
     <!--Menu-->
	<script src="css/menu_materialize/materialize.js"></script>  
    <script>
	$(function(){
     $(".button-collapse").sideNav();
 	});
	</script>  
      
   <nav>
   
     <div class="nav-wrapper">
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
          	 
             <li id="dados_menu"><a href="paginas_carregamento/insert_session.php?id=<?php echo $row_menu['id_tipo'];?>&nome=<?php echo $row_menu['nome_tipo'];?>">
			 <?php echo $row_menu['nome_tipo'];?></a>
             </li>
             
          <?php 
		  $favicon++;
		  }
		  ?>
          
         </ul>
         <ul class="side-nav" id="menu-mobile">
             <?php	
			 
		  $favicon_mobile = 1;
		  $select_menu = $pdo->query("SELECT * FROM tipo_produto");
		  while($row_menu = $select_menu->fetch()){
		  ?>
          	 
             <li id="dados_menu_mobile"><a href="paginas_carregamento/insert_session.php?id=<?php echo $row_menu['id_tipo'];?>&nome=<?php echo $row_menu['nome_tipo'];?>"><?php echo $row_menu['nome_tipo'];?></a></li>
             
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
         	
          <td class="area_login_register">
             <a href="pagina_inicial.php">        
        	 <center><button type="button" class="botao_login_cadastro">PÁGINA INICIAL</button></center>        	
             </a>
          </td>   
          </form> 
        </tr>
      </table>
        </nav>

</header>
<!--FIM DO CABEÇALHO-->

<section class="main_area_user">
	<center><img src="imagens/centro_area_user.png" class="img_area_user"/></center>
    
	<!--INÍCIO DA ÁREA DE LOGIN-->
	<section id="area_login">
		<h1 class="titulo">ÁREA DE LOGIN</h1>
        
        <section class="form_login">
        	
            <form name="formLogin" id="formLogin" method="post" action="paginas_carregamento/login_usuario.php">
     	<div class="row">
        	<label class="campo_form">Email:</label>
            <input type="text" maxlength="50" name="email_login" id="email_login" class="form-control"
            placeholder="endereco_email@tipo.com" onfocus="this.placeholder=''" onblur="this.placeholder='Email'"/>
        </div>
        <div class="row">
        	<label class="campo_form">Senha:</label>
            <input type="password" maxlength="10" name="senha_login" id="senha_login" class="form-control" 
            placeholder="Senha" onfocus="this.placeholder=''" onblur="this.placeholder='Senha'"/>
        </div>
        <div class="row">
            <center><button type="submit" class="btn btn-primary form-control" id="button_submit">LOGAR</button></center>
        </div>
        
     </form>  
        </section>
	</section>
    <!--FIM DA ÁREA DE LOGIN-->
    
    <!--INÍCIO DA ÁREA DE CADASTRO-->
	<aside id="area_cadastro">

	<div class="container">
    
    <h1 class="titulo">ÁREA DE CADASTRO</h1>
    
     <form name="formCadastro" id="formCadastro" method="post" action="paginas_carregamento/cadastro_usuario.php">
     	<div class="row">
        	<label class="campo_form">Nome:</label>
            <input type="text" maxlength="100" name="nome_user" id="name" class="form-control" 
            placeholder="Nome Completo" onfocus="this.placeholder=''" onblur="this.placeholder='Nome Completo'"/>
        </div>
        <div class="row">
        	<label class="campo_form"></label>
            <input type="hidden" name="tipo_user" id="name" class="form-control" value="1"
            placeholder="Nome Completo" onfocus="this.placeholder=''" onblur="this.placeholder='Nome Completo'"/>
        </div>
        <div class="row">
        	<label class="campo_form">CPF:</label>
            <input type="text" name="cpf_user" id="cpf_cadastro" class="form-control" 
            placeholder="999.999.999-99" onfocus="this.placeholder=''" onblur="this.placeholder='999.999.999-99'"/>
        </div>
        <div class="row">
        	<label class="campo_form">Telefone:</label>
            <input type="text" name="tel_user" id="tel_cadastro" class="form-control" 
            placeholder="(99) 99999-9999" onfocus="this.placeholder=''" onblur="this.placeholder='(99) 99999-9999'"/>
        </div>
        <div class="row">
        	<label class="campo_form">Email:</label>
            <input type="text" maxlength="50" name="email_user" id="email" class="form-control" 
            placeholder="endereco_email@tipo.com" onfocus="this.placeholder=''" onblur="this.placeholder='endereco_email@tipo.com'"/>
        </div>
        <div class="row">
        	<label class="campo_form">Senha:</label>
            <input type="password" maxlength="10"  name="senha_user" id="senha" class="form-control"
            placeholder="Máximo 10 caracteres" onfocus="this.placeholder=''" onblur="this.placeholder='máximo 10 caracteres'" />
        </div>
        
        <div class="row">
        	<center><button type="submit" class="btn btn-primary form-control" id="button_submit">CADASTRAR</button></center>
        </div>
        
     </form>
    </div>
		      
 
	</aside>
    
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