<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Finalizar Compra</title>

<!--SWEET ALERT JQUERY-->
<link rel="stylesheet" href="../css/sweetalert/sweetalert.css" />
<link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet"> 
<script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>

</head>

<body>
<?php 
include("../conexao/conexao.php");//CONEXAO COM BANCO DE DADOS
session_start();//INICIA AS SESSÕES

$login = false;
$frete = false;

/*-------------------VERIFICA SE O CEP FOI INFORMADO PARA EFETUAR A COMPRA--------------------------*/
if(isset($_SESSION['cep_destino'])){
	if(isset($_SESSION['frete'])){
		intval($_SESSION['frete']);
			if($_SESSION['frete'] > 0){		
				$frete = true;
			}	
	}
}

/*-------------------VERIFICA SE O CLIENTE ESTÁ LOGADO--------------------------*/
if(isset($_SESSION['cliente'])){
	$login = true;	
}//FIM DO IF DE VERIFICAÇÃO DO LOGIN DO CLIENTE
	
if($login == true and $frete == true){
	header('location:../continuar_compra.php');	
}

/*---------------RESPOSTA CASO O CLIENTE NAO ESTEJA LOGADO OU A VENDA NAO TENHA SIDO REALIZADA-------------------------------*/
if($login == false){
	echo 
	'<script>
 	 swal({
 	 title: "LOGIN NECESSÁRIO",	 
 	 text: "Por favor, realize Login em sua conta AirRoads para finalizar a compra",
 	 type: "success",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK",
	 },
  	 function(){
 	 setTimeout(function(){
     window.location = "../seleciona_tipo_pessoa.php";
  	 }, 1000);
  	 });

    </script>';
}
/*---------------------------------FIM DA RESPOSTA --------------------------------------------*/

/*---------------RESPOSTA CASO O CEP NAO TENHA SIDO INFORMADO OU O FRETE NAO TENHA SIDO CALCULADO-----------------------*/
if($frete == false){
	echo 
	'<script>
 	 swal({
 	 title: "FRETE NÃO CALCULADO",	 
 	 text: "Por favor, verifique o CEP e Forma de Entrega informados para calcularmos o frete ",
 	 type: "success",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK",
	 },
  	 function(){
 	 setTimeout(function(){
     window.location = "../carrinho_compras.php";
  	 }, 1000);
  	 });

    </script>';
}
/*---------------------------------FIM DA RESPOSTA --------------------------------------------*/
?>

</body>
</html>