<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logando com usuário...</title>

<!--SWEET ALERT JQUERY-->
<link rel="stylesheet" href="../css/sweetalert/sweetalert.css" />
<link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet"> 
<script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>

</head>

<body>
<?php 
include("../conexao/conexao.php");



$email = $_POST['email_login'];
$senha = $_POST['senha_login'];

$select_user = $pdo->prepare("SELECT * FROM usuario_juridico WHERE email_jur = :email AND senha = :senha ");

$select_user ->bindValue(":email", $email);
$select_user ->bindValue(":senha", $senha);
$select_user ->execute();
$number_linhas = $select_user->rowCount
();


if($number_linhas == 1){	
    
	while($dados_user = $select_user->fetch()){
	$id_user = $dados_user['id_user_jur'];
	$id_tipo_user = $dados_user['id_tipo_cliente'];
	$razao_social = $dados_user['razao_social'];
	$cnpj_user = $dados_user['cnpj'];
	$tel_user = $dados_user['telefone_jur'];
	$rua_user = $dados_user['rua'];
	$numero_user = $dados_user['numero'];
	$cep_user = $dados_user['cep'];
	$bairro_user = $dados_user['bairro'];
	$cidade_user = $dados_user['cidade'];
	$estado_user = $dados_user['estado'];
		
	$email_user = $dados_user['email_jur'];	
	$senha_user = $dados_user['senha'];
	}
	
	if(($email_user == $email)and($senha_user == $senha)){	
	session_start();
	$_SESSION['id_user'] = $id_user;
	$_SESSION['id_tipo_user'] = $id_tipo_user;
	$_SESSION['cliente'] = $razao_social;
	$_SESSION['tel_user'] = $tel_user;
	$_SESSION['cnpj_user'] = $cnpj_user;
	$_SESSION['email_user'] = $email_user;
	$_SESSION['rua_user'] = $rua_user;
	$_SESSION['numero_user'] = $numero_user;
	$_SESSION['cep_user'] = $cep_user;
	$_SESSION['bairro_user'] = $bairro_user;
	$_SESSION['cidade_user'] = $cidade_user;
	$_SESSION['estado_user'] = $estado_user;
		
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
     window.history.back("../login_e_cadastro.php");
  	 }, 1000);
  	 });

    </script>';

	}

?>
</body>
</html>