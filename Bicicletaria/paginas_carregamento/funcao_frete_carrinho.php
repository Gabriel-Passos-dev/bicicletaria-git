<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>

<?php
$cep_origem = '16402160';
$cep_destino = $_GET['cep'];
$cod_servico = $_GET['serv'];

$larg = $_GET['larg'];
$comp = $_GET['comp'];
$alt = $_GET['alt'];
$peso = $_GET['peso'];

$_SESSION['forma_entrega'] = $cod_servico;

$cod_servico = strtoupper($cod_servico);
      	
if($cod_servico == 'SEDEX10') $cod_servico = 40215 ; 
if($cod_servico == 'SEDEXACOBRAR') $cod_servico = 40045 ; 
if($cod_servico == 'SEDEX') $cod_servico = 40010 ; 
if($cod_servico == 'PAC') $cod_servico = 41106 ;
   	
      # ###########################################
      # Código dos Principais Serviços dos Correios
      # 41106 PAC sem contrato
      # 40010 SEDEX sem contrato
      # 40045 SEDEX a Cobrar, sem contrato
      # 40215 SEDEX 10, sem contrato
      # ###########################################
 
$correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem.
		  "&sCepDestino=".$cep_destino."&nVlPeso=3&nCdFormato=3&nVlComprimento=".$comp."&nVlAltura=".$alt."&nVlLargura=".$larg."&sCdMaoPropria=
		  0&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";

$xml = simplexml_load_file($correios);	  
var_dump($xml);
	  
if($xml->cServico->Valor <> 0 and ($xml->cServico->Codigo <> 0) and ($xml->cServico->PrazoEntrega <> 0)){
    echo $codigo = $xml->cServico->Codigo ;
    $valor_frete = $xml->cServico->Valor ;
    $prazo_entrega = $xml->cServico->PrazoEntrega.' Dias' ;   		 
}

else{
	$valor_frete = "Formato de Entrega indisponível para o CEP informado";
	$prazo_entrega = " - ";
	}

header('Location:../carrinho_compras.php?frete='.$valor_frete.'&prazo='.$prazo_entrega.'');


?>
</body>
</html>