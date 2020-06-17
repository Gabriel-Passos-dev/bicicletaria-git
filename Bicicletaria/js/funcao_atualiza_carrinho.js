var timeout;

jQuery(function($){	

	//Campo quantidade
	$('.funcao_att_quant').on('change', 'input.quantidade', function(){//.funcao_att_quant: foi chamado com class pq com id nao da certo		
		if (timeout !== undefined){
			clearTimeout(timeout);
		}		
		timeout = setTimeout(function(){
			$("[name='update_cart']").trigger("click");
		}, 500);//1 segundo de atraso, meio segundo (500) também parece bacana de deixar
	});
	
	//Select Numero de Parcelas		
	$('#funcao_att_select').on('change', 'select.parcelas', function(){
		if (timeout !== undefined){
			clearTimeout(timeout);
		}		
		timeout = setTimeout(function(){		
			$("[name='update_cart']").trigger("click");
		}, 500);//1 segundo de atraso, meio segundo (500) também parece bacana de deixar
	});	
	
	//Select Forma de Pagamento	
	$('#funcao_att_form_pag').on('change', 'select.form_pag', function(){
		if (timeout !== undefined){
			clearTimeout(timeout);
		}		
		timeout = setTimeout(function(){
			$("[name='update_cart']").trigger("click");
		}, 500);//1 segundo de atraso, meio segundo (500) também parece bacana de deixar
	});	

});
