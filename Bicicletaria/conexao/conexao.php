<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conexão Banco de Dados</title>
</head>

<body>
<?php
$username = 'root';
$password = '';

try{
  $pdo = new PDO('mysql:host=localhost; dbname=bicicletaria; "charset=utf-8"', $username, $password);
  $pdo -> exec("SET CHARACTER SET utf8");
}catch(PDOException $e){
    echo 'ERROR: '.$e->getMessage();
}
?>

</body>
</html>