// JavaScript Document

	/*CADASTRO PESSOA FÍSICA*/
	$(document).ready(function(){
		$("#tel_cadastro").mask("(99) 99999-9999");
	});
	$(document).ready(function(){
		$("#cpf_cadastro").mask("999.999.999-99");
	});
	
	
	/*CADASTRO PESSOA JURÍDICA*/
	$(document).ready(function(){
		$("#cnpj_cadastro").mask("99.999.999/9999-99");
	});
	
	$(document).ready(function(){
		$("#preco").mask("9.999,99");
	});

	/*CEP FRETE*/
	$(document).ready(function(){
		$("#cep_frete").mask("99999-999");
	});	
	
	$(document).ready(function(){
		$("#num_cartao").mask("9999.9999.9999.9999");
	});
	