<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redirecionamento...</title>
</head>

<body>
<?php
   include("../conexao/conexao.php");

   $id_tipo = $_GET["id"];
   $nome_tipo = $_GET["nome"];

   
   session_start();
   $_SESSION['id_tipo'] = $id_tipo; 
   $_SESSION['nome_tipo'] = $nome_tipo;   
	
?>

<script>
	window.location.replace("../pagina_produtos.php/<?php echo $nome_tipo?>");
</script>
</body>
</html>