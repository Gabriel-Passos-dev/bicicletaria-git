
function validacao_num_cartao(){
	var campo_num_cartao = document.getElementById('num_cartao').value;
	var span_num_cartao = document.getElementById('span_msg_campo_vazio_num_cartao');
	
	if(campo_num_cartao == ""){span_num_cartao.innerHTML = "CAMPO OBRIGATÓRIO";}
	else{span_num_cartao.innerHTML = "";}
}

function validacao_nome_cartao(){
	var campo_nome_cartao = document.getElementById('nome_cartao').value;
	var span_nome_cartao = document.getElementById('span_msg_campo_vazio_nome_cartao');
	
	if(campo_nome_cartao == ""){span_nome_cartao.innerHTML = "CAMPO OBRIGATÓRIO";}
	else{span_nome_cartao.innerHTML = "";}
}

function validacao_cvc_cartao(){
	var campo_cvc_cartao = document.getElementById('cvc_cartao').value;	
	var span_cvc_cartao = document.getElementById('span_msg_campo_vazio_cvc_cartao');
	
	if(campo_cvc_cartao == ""){span_cvc_cartao.innerHTML = "CAMPO OBRIGATÓRIO";}
	else{span_cvc_cartao.innerHTML = "";}
}

function validacao_parcelas_cartao(){
	var campo_parcelas_cartao = document.getElementById('parcelas_cartao').value;	
	var span_parcelas_cartao = document.getElementById('span_msg_campo_vazio_parcelas_cartao');	
	
	if(campo_parcelas_cartao == ""){span_parcelas_cartao.innerHTML = "CAMPO OBRIGATÓRIO";}	
	else if(campo_parcelas_cartao > 12){span_parcelas_cartao.innerHTML = "ATÉ 12x";}
	else{span_parcelas_cartao.innerHTML = "";}
}

