<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--SWEET ALERT JQUERY-->
<link rel="stylesheet" href="../css/sweetalert/sweetalert.css" />
<link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet"> 
<script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>

<title>Cadastrando Usuário...</title>
</head>

<body>
<?php 
include("../conexao/conexao.php");

	
	$tipo_user = $_POST['tipo_user'];
	$cpf_user = $_POST['cpf_user'];
	$tel_user = $_POST['tel_user'];
	$email_user = $_POST['email_user'];
	$senha_user = $_POST['senha_user'];


/*FUNÇÃO DE VALIDAÇÃO DO CPF*/
function cpf($cpf_user){
	$cpf_user = preg_replace("/[^0-9]/", "", $cpf_user);
	$digitoUm = 0;
	$digitoDois = 0;
	$cont = 10;
	$contDois = 11;	
	
	/*Verifica o primeiro dígito após o traço*/
	for($i = 0; $i <= 8; $i++){
		if(str_repeat($i, 11) == $cpf_user){
			return false;
			}
		$digitoUm += $cpf_user[$i] * $cont;
		$cont--;
		}
	/*Verifica o segundo dígito após o traço*/	
	for($i = 0; $i <= 9; $i++){
		if(str_repeat($i, 11) == $cpf_user){
			return false;
			}
		$digitoDois += $cpf_user[$i] * $contDois;
		$contDois--;
		}
	/*CALCULA O PRIMEIRO DIGITO APÓS O TRAÇO*/	
	$calculoUm = (($digitoUm % 11) < 2) ? 0 : 11-($digitoUm%11);
	$calculoDois = (($digitoDois % 11) < 2) ? 0 : 11-($digitoDois%11);	
		
		if($calculoUm <> $cpf_user[9] or $calculoDois <> $cpf_user[10]){
			return false;
			}
			return true;
	}
	
	if(cpf($cpf_user)){
		$validacao = 1;
		}
		else{
			echo 
	'<script>
 	 swal({
 	 title: "Cadastro não Realizado",
 	 text: "O CPF informado é inválido. Por favor, informe um número de CPF válido",
 	 type: "warning",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK",
	 },
  	 function(){
 	 setTimeout(function(){
     window.history.back("../login_e_cadastro_pessoa_fisica.php");
  	 }, 1000);
  	 });

    </script>';
	
	$validacao = 0;
			}
	
if($validacao == 1){
	
/*VERIFICA SE JÁ EXISTE UM EMAIL IGUAL O INFORMADO CADASTRADO NO BANCO*/
$select_user = $pdo->query("SELECT * FROM usuario WHERE email_user = '$email_user'");
	while($dado_banco = $select_user->fetch()){
		$email_banco = $dado_banco['email_user'];
		}
		
	error_reporting(0);
	if($email_user == $email_banco){
	
echo 
	'<script>
 	 swal({
 	 title: "Cadastro não Realizado",
 	 text: "O endereço de email informado ja está sendo usado em outra conta. Por favor, informe um outro endereço de email.",
 	 type: "warning",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK",
	 },
  	 function(){
 	 setTimeout(function(){
     window.history.back("../login_e_cadastro_pessoa_fisica.php");
  	 }, 1000);
  	 });

    </script>';
	}

/*VERIFICA SE JÁ EXISTE UM EMAIL IGUAL O INFORMADO CADASTRADO NO BANCO*/
$select_user = $pdo->query("SELECT * FROM usuario WHERE cpf = '$cpf_user'");
	while($dado_banco = $select_user->fetch()){
		$cpf_banco = $dado_banco['cpf'];
		}	
		
error_reporting(0);
	if($cpf_user == $cpf_banco){
	
echo 
	'<script>
 	 swal({
 	 title: "Cadastro não Realizado",
 	 text: "Este CPF já possui uma conta cadastrada",
 	 type: "warning",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK",
	 },
  	 function(){
 	 setTimeout(function(){
     window.history.back("../login_e_cadastro_pessoa_fisica.php");
  	 }, 1000);
  	 });

    </script>';
	}
/*CADASTRO USANDO PDO DE FORMA SEGURA ATRAVÉS DA CLASSE prepare()*/
else{
$inserir_usuario = $pdo->prepare("INSERT INTO usuario(id_tipo_cliente, nome_user, cpf, telefone, email_user,senha)
								VALUES(:id_tipo_cliente, :nome, :cpf, :tel_user, :email_user, :senha_user)");
								
			$inserir_usuario->bindValue(":id_tipo_cliente", $tipo_user);
			$inserir_usuario->bindValue(":nome", $nome_user);
			$inserir_usuario->bindValue(":cpf", $cpf_user);
			$inserir_usuario->bindValue(":tel_user", $tel_user);
			$inserir_usuario->bindValue(":email_user", $email_user);
			$inserir_usuario->bindValue(":senha_user", $senha_user);
			$inserir_usuario->execute();
			
			$linhas = $inserir_usuario->rowCount();
			
	}
/*MENSAGEM DE CADASTRO REALIZADO COM SUCESSO FEITO COM SWEETALERT*/		
if($linhas > 0){
	
echo 
	'<script>
 	 swal({
 	 title: "Cadastro Realizado",
 	 text: "AIR ROADS",
 	 type: "success",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK",
	 },
  	 function(){
 	 setTimeout(function(){
     window.location = "../login_e_cadastro_pessoa_fisica.php";
  	 }, 1000);
  	 });

    </script>';}
	
}
?>

</body>
</html>