// JavaScript Document

 	/*BARRA DE PESQUISA*/
	/*$(document).ready(function(){
		$("#formPesquisa").validate({
			rules:{
				pesquisa:{
					required:true
					}				
				}
		})
	})
*/
/*ÁREA CADASTRO DE PESSOA FÍSICA*/	
	/*ÁREA DE LOGIN*/
	$(document).ready(function(){
		$("#formLogin").validate({
			rules:{
				email_login:{
					required:true,
					email:true
					},
				senha_login:{
					required:true
					}					
			}				
		})
	})
	/*ÁREA DE CADASTRO*/
	$(document).ready(function(){
		$("#formCadastro").validate({
			rules:{
				nome_user:{
					required:true,
					minWords:2,
					},
				tel_user:{
					required:true,
					},
				cpf_user:{
					required:true,
					},	
				email_user:{
					required:true,
					email:true				
					},
				senha_user:{
					required:true,
					},
			}
		})        
    })
/*FIM DA ÁREA CADASTRO DE PESSOA FÍSICA*/
/*ÁREA CADASTRO DE PESSOA JURÍDICA*/
	$(document).ready(function(){
		$("#formCadastro_juridico").validate({
			rules:{
				razao_social:{
					required:true
					},				
				cnpj_user:{
					required:true
					},
				tel_user:{
					required:true
					},
				cpf_user:{
					required:true
					},	
				email_user:{
					required:true,
					email:true				
					},
				senha_user:{
					required:true,
					},
			}
		})
	})
/*FIM DA ÁREA CADASTRO DE PESSOA JURÍDICA*/

	