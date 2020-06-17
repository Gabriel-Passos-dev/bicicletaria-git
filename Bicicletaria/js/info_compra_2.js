function area(area_some, area_aparece, button_some, button_aparece){
    var div_some = document.getElementById(area_some);
    var div_aparece = document.getElementById(area_aparece);
    var botao_some = document.getElementById(button_some);
    var botao_aparece = document.getElementById(button_aparece);

    var num_casa = document.getElementById('num_casa').value;
    var msg_campo_vazio = document.getElementById('span_msg_campo_vazio');
    
    if(area_some == 'area_entrega' && num_casa == ""){
			msg_campo_vazio.innerHTML = 'CAMPO OBRIGATÓRIO (MAX 9999)';	
    }
    else{
    msg_campo_vazio.innerHTML = '';

    div_some.style.display = 'none';
    div_aparece.style.display = "block";
    botao_some.style.background = '#FFF'; botao_some.style.color = '#900';
    botao_aparece.style.background = '#900'; botao_aparece.style.color = '#FFF';
    }
}

/*SCRIPT ESCOLHA DA FORMA DE PAGAMENTO*/	
let div_cartao = document.querySelector('div#opcao_cartao');
let div_boleto = document.querySelector('div#opcao_boleto');
			
		function op_cartao(){
			div_cartao.style.opacity = 1; div_cartao.style.zIndex = 1;
			div_boleto.style.zIndex = 0; div_boleto.style.opacity = 0;
		}
		function op_boleto(){
			div_cartao.style.opacity = 0; div_cartao.style.zIndex = 0;
			div_boleto.style.opacity = 1; div_boleto.style.zIndex = 1;
		}	