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

	$razao_social = $_POST['razao_social'];
	$tipo_user = $_POST['tipo_user'];
	$cnpj_user = $_POST['cnpj_user'];
	$tel_user = $_POST['tel_user'];
	$email_user = $_POST['email_user'];
	$senha_user = $_POST['senha_user'];
	
	$select_user = $pdo->query("SELECT * FROM usuario_juridico WHERE email_jur = '$email_user'");
	while($dado_banco = $select_user->fetch()){
		$email_banco = $dado_banco['email_jur'];
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
     window.history.back("../login_e_cadastro_pessoa_juridica.php");
  	 }, 1000);
  	 });

    </script>';
	}	
	else{
/*CADASTRO USANDO PDO DE FORMA SEGURA ATRAVÉS DA CLASSE prepare()*/
$inserir_usuario = $pdo->prepare
("INSERT INTO usuario_juridico(id_tipo_cliente, razao_social, cnpj, telefone_jur, email_jur, senha)
								VALUES(:id_tipo_cliente, :razao_social, :cnpj, :tel_user, :email_user, :senha_user)");
								
			$inserir_usuario->bindValue(":razao_social", $razao_social);
			$inserir_usuario->bindValue(":id_tipo_cliente", $tipo_user);
			$inserir_usuario->bindValue(":cnpj", $cnpj_user);
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
     window.location = "../login_e_cadastro_pessoa_juridica.php";
  	 }, 1000);
  	 });

    </script>';}
	
?>

</body>
</html>