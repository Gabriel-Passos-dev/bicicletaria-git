<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Finalizar Compra</title>

<!--SWEET ALERT JQUERY-->
<link rel="stylesheet" href="../css/sweetalert/sweetalert.css" />
<script type="text/javascript" src="../js/sweetalert/sweetalert.min.js"></script>

</head>

<body>
<?php
include("../conexao/conexao.php");//CONEXAO COM BANCO DE DADOS
session_start();//INICIA AS SESSÕES
$id_cliente = $_SESSION['id_cliente'];

$cartao_valido = false;
$venda = false;
$entrega = false;
$pagamento = false;

/*DADOS PARA CADASTRO DA COMPRA*/
echo $cep_banco = $_POST['cdt_cep'];
echo $rua_banco = $_POST['cdt_rua'];
echo $num_banco = $_POST['cdt_num'];
echo $bairro_banco = $_POST['cdt_bairro'];
echo $complemento_banco = $_POST['cdt_complemento'];
echo $cidade_banco = $_POST['cdt_cidade'];
echo $estado_banco = $_POST['cdt_estado'];
echo $forma_pag_banco = $_POST['cdt_forma_pag'];
echo $num_cartao_banco = $_POST['cdt_num_cartao'];
echo $nome_cartao_banco = $_POST['cdt_nome_cartao'];
echo $val_mes_banco = $_POST['cdt_val_mes'];
echo $val_ano_banco = $_POST['cdt_val_ano'];
echo $cvc_banco = $_POST['cdt_cvc'];
echo $parcelas_banco = $_POST['cdt_parcelas'];


function valida_cartao($cartao, $cvc=false){
	$cartao = preg_replace("/[^0-9]/", "", $cartao);
	if($cvc) $cvc = preg_replace("/[^0-9]/", "", $cvc);

	$cartoes = array(
			'visa'		 => array('len' => array(13,16),    'cvc' => 3),
			'mastercard' => array('len' => array(16),       'cvc' => 3),
			'diners'	 => array('len' => array(14,16),    'cvc' => 3),
			'elo'		 => array('len' => array(16),       'cvc' => 3),
			'amex'	 	 => array('len' => array(15),       'cvc' => 4),
			'discover'	 => array('len' => array(16),       'cvc' => 4),
			'aura'		 => array('len' => array(16),       'cvc' => 3),
			'jcb'		 => array('len' => array(16),       'cvc' => 3),
			'hipercard'  => array('len' => array(13,16,19), 'cvc' => 3),
	);
	
	switch($cartao){
		case (bool) preg_match('/^(636368|438935|504175|451416|636297)/', $cartao) :
			$bandeira = 'elo';			
		break;
		case (bool) preg_match('/^(606282)/', $cartao) :
			$bandeira = 'hipercard';			
		break;
		case (bool) preg_match('/^(5067|4576|4011)/', $cartao) :
			$bandeira = 'elo';			
		break;
		case (bool) preg_match('/^(3841)/', $cartao) :
			$bandeira = 'hipercard';			
		break;
		case (bool) preg_match('/^(6011)/', $cartao) :
			$bandeira = 'discover';			
		break;
		case (bool) preg_match('/^(622)/', $cartao) :
			$bandeira = 'discover';			
		break;
		case (bool) preg_match('/^(301|305)/', $cartao) :
			$bandeira = 'diners';			
		break;
		case (bool) preg_match('/^(34|37)/', $cartao) :
			$bandeira = 'amex';			
		break;
		case (bool) preg_match('/^(36,38)/', $cartao) :
			$bandeira = 'diners';			
		break;
		case (bool) preg_match('/^(64,65)/', $cartao) :
			$bandeira = 'discover';			
		break;
		case (bool) preg_match('/^(50)/', $cartao) :
			$bandeira = 'aura';			
		break;
		case (bool) preg_match('/^(35)/', $cartao) :
			$bandeira = 'jcb';			
		break;
		case (bool) preg_match('/^(60)/', $cartao) :
			$bandeira = 'hipercard';			
		break;
		case (bool) preg_match('/^(4)/', $cartao) :
			$bandeira = 'visa';			
		break;
		case (bool) preg_match('/^(5)/', $cartao) :
			$bandeira = 'mastercard';			
		break;
		default:
			$bandeira = 'papai';
	}
	
	ini_set('display_errors', 0 );
	error_reporting(0);
	
	$dados_cartao = $cartoes[$bandeira];		
	
	if(!is_array($dados_cartao)) return array(false, false, false);

	$valid     = true;
	$valid_cvc = false;

	if(!in_array(strlen($cartao), $dados_cartao['len'])) $valid = false;
	if($cvc AND strlen($cvc) <= $dados_cartao['cvc'] AND strlen($cvc) !=0) $valid_cvc = true;
	return array($bandeira, $valid, $valid_cvc);	
	
}

$funcao = valida_cartao($num_cartao_banco, $cvc_banco);

if($funcao[0] <> false and $funcao[1] == true and $funcao[2] == true){
	$cartao_valido = true;	
}

if($cartao_valido == true){//SE O CARTÃO FOR VÁLIDO, A COMPRA É FINALIZADA

$itens = array_sum($_SESSION['itens']);//Soma dos produtos do carrinho
//FIM DO IF DE VERIFICAÇÃO DO LOGIN DO CLIENTE

/*----------------------------------------INICIO DO FOREACH DA VENDA---------------------------------------------*/	
	foreach($_SESSION['vendas'] as $venda){
		
	//OBTEM A DATA E HORA DO SISTEMA	
	date_default_timezone_set('America/Sao_Paulo');	
	$data_venda = date('Y-m-d');
	$hora_venda = date('H:i:s');
		
	//FORMATA O VALOR FINAL DA VENDA
	$valor_final_banco = number_format($venda['valor_final'],1,".","");	
	
	$insert_venda = $pdo->prepare("
	INSERT INTO vendas(total_produtos, valor_total, forma_pagamento, numero_parcelas, data_venda, hora_venda) 
	VALUES(:total_produtos, :valor_total, :forma_pagamento, :numero_parcelas, :data_venda, :hora_venda)");
	
	$insert_venda->bindValue(":total_produtos", $venda['total_produtos']);
	$insert_venda->bindValue(":valor_total", $valor_final_banco);
	$insert_venda->bindValue(":forma_pagamento", $forma_pag_banco);
	$insert_venda->bindValue(":numero_parcelas", $parcelas_banco);
	$insert_venda->bindValue(":data_venda", $data_venda);
	$insert_venda->bindValue(":hora_venda", $hora_venda);
	$insert_venda->execute();		
	}
/*----------------------------------------FIM DO FOREACH DA VENDA---------------------------------------------	*/	
								 
	//OBTEM O ULTIMO ID INSERIDO NO BAN
	$id_venda = $pdo->lastInsertId();									 
	if(isset($id_venda)){//IF QUE VERIFICA SE HÁ ID_VENDA
		$venda = true;
	if($id_venda > 0){//IF QUE VERIFICA SE O ID É MAIOR QUE 0


/*----------------------------------------INICIO DO FOREACH DOS PRODUTOS DA VENDA---------------------------------------------	*/
	foreach($_SESSION['dados'] as $produtos){
		
	//FORMATA OS VALORES UNITÁRIO E TOTAL DE CADA PRODUTO
	$valor_unit_banco = number_format($produtos['valor_unit'],1,".","");
	$valor_total_banco = number_format($produtos['valor_total'],1,".","");
		
	$insert_produtos = $pdo->prepare(
	"INSERT INTO itens_venda(id_venda, id_produto, marca, valor_unitario, desconto, quantidade, valor_total) 
	VALUES(:id_venda, :id_produto, :marca, :valor_unitario, :desconto, :quantidade, :valor_total)");
		
	$insert_produtos->bindValue(":id_venda", $id_venda);
	$insert_produtos->bindValue(":id_produto", $produtos['id_produto']);
	$insert_produtos->bindValue(":marca", $produtos['marca']);
	$insert_produtos->bindValue(":valor_unitario", $valor_unit_banco);
	$insert_produtos->bindValue(":desconto", $produtos['desconto']);
	$insert_produtos->bindValue(":quantidade", $produtos['quantidade']);
	$insert_produtos->bindValue(":valor_total", $valor_total_banco);
	$insert_produtos->execute();
	
	$venda = true;
			}
/*----------------------------------------FIM DO FOREACH DOS PRODUTOS DA VENDA---------------------------------------------*/			
		}//FIM DO IF DO ID_VENDA
	}//FIM DO IF VERIFICA ID > 0		
	
	
/*----------------------------------------CADASTRO DO ENDEREÇO DA VENDA---------------------------------------------*/	
	echo $id_venda;
	if($id_venda > 0){
	$insert_produtos = $pdo->prepare(
	"INSERT INTO entrega_venda(id_venda, cliente, cep, rua, numero, bairro, complemento, cidade, estado) 
	VALUES(:id_venda, :cliente, :cep, :rua, :numero, :bairro, :complemento, :cidade, :estado)");
		
	$insert_produtos->bindValue(":id_venda", $id_venda);
	$insert_produtos->bindValue(":cliente", $id_cliente);
	$insert_produtos->bindValue(":cep", $cep_banco);
	$insert_produtos->bindValue(":rua", $rua_banco);
	$insert_produtos->bindValue(":numero", $num_banco);
	$insert_produtos->bindValue(":bairro", $bairro_banco);
	$insert_produtos->bindValue(":complemento", $complemento_banco);
	$insert_produtos->bindValue(":cidade", $cidade_banco);
	$insert_produtos->bindValue(":estado", $estado_banco);
	$insert_produtos->execute();
	
	$entrega = true;
	}
/*----------------------------------------FIM DO CADASTRO DO ENDEREÇO DA VENDA---------------------------------------------*/	
/*----------------------------------------CADASTRO DOS DADOS DO PAGAMENTO---------------------------------------------*/	
	echo $id_venda;
	if($id_venda > 0){
	$insert_produtos = $pdo->prepare(
	"INSERT INTO pagamentos(id_venda, cliente, forma_pag, cod_barras, num_cartao, val_mes, val_ano, cvc, parcelas) 
	VALUES(:id_venda, :cliente, :forma_pag, :cod_barras, :num_cartao, :val_mes, :val_ano, :cvc, :parcelas)");
		
	$insert_produtos->bindValue(":id_venda", $id_venda);
	$insert_produtos->bindValue(":cliente", $id_cliente);
	$insert_produtos->bindValue(":forma_pag", $forma_pag_banco);
	$insert_produtos->bindValue(":cod_barras", "-");
	$insert_produtos->bindValue(":num_cartao", $num_cartao_banco);
	$insert_produtos->bindValue(":val_mes", $val_mes_banco);
	$insert_produtos->bindValue(":val_ano", $val_ano_banco);
	$insert_produtos->bindValue(":cvc", $cvc_banco);
	$insert_produtos->bindValue(":parcelas", $parcelas_banco);
	$insert_produtos->execute();
	
	$pagamento = true;
	
	unset($_SESSION['cep_destino']);
	unset($_SESSION['itens']);
	unset($_SESSION['id_produto']);
	unset($_SESSION['vendas']);
	unset($_SESSION['dados']);
	unset($_SESSION['frete']);
	unset($_SESSION['prazo']);
	
	}
/*----------------------------------------FIM DO CADASTRO DOS DADOS DO PAGAMENTO---------------------------------------------*/	

}//FIM DO IF DO CARTÃO VÁLIDO
if($venda == true and $entrega == true and $pagamento == true and $cartao_valido == true){
	?>
<script>
 	 swal({
 	 title: "COMPRA REALIZADA",
 	 text: "VOCÊ PODE ACOMPANHAR A SITUAÇÃO DE SUAS COMPRAS NO BOTAO AO LADO DO SEU NOME",
 	 type: "success",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK!",
	 },
  	 function(){
 	 setTimeout(function(){
     window.location = "../pagina_inicial.php";
  	 }, 1000);
  	 });

    </script>
	<?php
}
else{	
	?>
	<script>
 	 swal({
 	 title: "CARTÃO INVÁLIDO",
 	 text: "O dados do cartão informado são inválidos. Por favor, verifique as informações e tente novamente",
 	 type: "success",
 	 confirmButtonColor:"#030",
 	 closeOnConfirm: false,
	 showLoaderOnConfirm:true,
	 confirmButtonText:"OK!",
	 },
  	 function(){
 	 setTimeout(function(){
     window.history.back("../continuar_compra.php");
  	 }, 1000);
  	 });

    </script>
	<?php
	}
	?>








</body>
</html>	