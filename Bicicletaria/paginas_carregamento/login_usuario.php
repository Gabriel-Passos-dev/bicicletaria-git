<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logando com usuário...</title>

<!--SWEET ALERT JQUERY-->
<link rel="stylesheet" href="../css/sweetalert/sweetalert.css" />
<link href="https://fonts.googleapis.com/css?family=Arial" rel="stylesheet"> 
<script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>

</head>

<body>
<?php 
include("../conexao/conexao.php");
session_start();

$email = $_POST['email_login'];
$senha = $_POST['senha_login'];

$select_user = $pdo->prepare("SELECT * FROM usuario WHERE email_user = :email AND senha = :senha ");

$select_user ->bindValue(":email", $email);
$select_user ->bindValue(":senha", $senha);
$select_user ->execute();
$number_linhas = $select_user->rowCount();

	while($dados_user = $select_user->fetch()){
	$id_user = $dados_user['id_user'];
	$id_tipo_user = $dados_user['id_tipo_cliente'];
	$nome_user = $dados_user['nome_user'];
	$cpf_user = $dados_user['cpf'];
	$tel_user = $dados_user['telefone'];		
	$email_user = $dados_user['email_user'];	
	$senha_user = $dados_user['senha'];
	}
	
	if($number_linhas == 1){	
    if(($email_user == $email)and($senha_user == $senha)){
		
	$_SESSION['cliente'] = $nome_user;
	$_SESSION['id_cliente'] = $id_user;
		
	echo 
	'<script>
 	 swal({
 	 title: "BEM VINDO",	 
 	 text: "LOGIN EFETUADO COM SUCESSO",
 	 type: "success",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK",
	 },
  	 function(){
 	 setTimeout(function(){
     window.location = "../pagina_inicial.php";
  	 }, 1000);
  	 });

    </script>';
	}
}
else{	
	echo 
	'<script>
 	 swal({
 	 title: "Falha de Autenticação",	 
 	 text: "DADOS INCORRETOS. VERIFIQUE SEUS DADOS E TENTE NOVAMENTE.",
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

?>
</body>
</html>