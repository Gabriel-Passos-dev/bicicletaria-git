<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tipo de Pessoa</title>

<!--SWEET ALERT JQUERY-->
<link rel="stylesheet" href="css/sweetalert/sweetalert.css" />
<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">  
<script type="text/javascript" src="js/sweetalert/sweetalert.min.js"></script>
<!--FAVICON--><link rel="shortcut icon" type="image/x-icon" href="imagens/roda_head.png"><!--FIM DO FAVICON-->

</head>

<body>

<?php 
$a = 5;

if($a = 5){
?>
<script>
 	 swal({
  title: "Escolha o tipo de cliente",
  text: "",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor:"#900",
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Pessoa Jurídica",
  cancelButtonText: "Pessoa Física",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm) {
  if (isConfirm) {  
  	 window.location = "login_e_cadastro_pessoa_juridica.php"; 
       	
  } else {
     window.location = "login_e_cadastro_pessoa_fisica.php"; 
  }
});

    </script>
    
    <?php
}
?>
</body>
</html>