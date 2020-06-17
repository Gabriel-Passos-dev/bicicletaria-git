	var cesta = document.getElementById('area_cesta');
	let button_cesta = document.getElementById('cesta');
	let entrega = document.getElementById('area_entrega');
	let button_entrega = document.getElementById('entrega');
	let pagamento = document.getElementById('area_pagamento');
	let button_pagamento = document.getElementById('pagamento');
	let agradecimento = document.getElementById('area_agradecimento');
	let button_agradecimento = document.getElementById('agradecimento');
		
	function area_cesta(){		
		entrega.style.opacity = 0;	entrega.style.zIndex = 0;
		pagamento.style.opacity = 0; pagamento.style.zIndex = 0;		
		agradecimento.style.opacity = 0; 
		cesta.style.opacity = 1; cesta.style.zIndex = 1;
		
		button_cesta.style.background = '#900';	button_cesta.style.color = '#FFF';
		button_entrega.style.background = '#FFF';	button_entrega.style.color = '#900';
		button_pagamento.style.background = '#FFF';	button_pagamento.style.color = '#900';
		button_agradecimento.style.background = '#FFF';	button_agradecimento.style.color = '#900';
	}
	function area_entrega(){		
		entrega.style.opacity = 1; entrega.style.zIndex = 1; 
		pagamento.style.zIndex = 0; pagamento.style.opacity = 0;	
		agradecimento.style.opacity = 0; 
		cesta.style.opacity = 0;		
		button_entrega.style.background = '#900';button_entrega.style.color = '#FFF';
		button_pagamento.style.background = '#FFF';	button_pagamento.style.color = '#900';
		button_agradecimento.style.background = '#FFF';	button_agradecimento.style.color = '#900';
		button_cesta.style.background = '#FFF';	button_cesta.style.color = '#900';
	}
	function area_pagamento(){
		var num_casa = document.getElementById('num_casa').value;
		var msg_campo_vazio = document.getElementById('span_msg_campo_vazio');
		
		if(num_casa == ""){
			msg_campo_vazio.innerHTML = 'CAMPO OBRIGATÓRIO';
		}
		else if(num_casa > 9999){
			msg_campo_vazio.innerHTML = 'MAX 9999';
		}
		else{
		pagamento.style.opacity = 1; pagamento.style.zIndex = 1;
		entrega.style.zIndex = 0; entrega.style.opacity = 0;
		agradecimento.style.opacity = 0; 
		cesta.style.opacity = 0;
		button_pagamento.style.background = '#900';	button_pagamento.style.color = '#FFF';
		button_agradecimento.style.background = '#FFF';	button_agradecimento.style.color = '#900';
		button_cesta.style.background = '#FFF';	button_cesta.style.color = '#900';
		button_entrega.style.background = '#FFF';button_entrega.style.color = '#900';
		msg_campo_vazio.style.opacity = 0;
		}
	}
	function area_agradecimento(){		
		entrega.style.opacity = 0; 
		pagamento.style.opacity = 0; 
		agradecimento.style.opacity = 1; 
		cesta.style.opacity = 0;
		button_agradecimento.style.background = '#900';	button_agradecimento.style.color = '#FFF';
		button_cesta.style.background = '#FFF';	button_cesta.style.color = '#900';
		button_entrega.style.background = '#FFF';button_entrega.style.color = '#900';
		button_pagamento.style.background = '#FFF';	button_pagamento.style.color = '#900';
	}
	


		
	