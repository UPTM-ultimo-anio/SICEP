$(document).ready(function(){
		//var boton = document.getElementById('boton');
		//boton.disabled = true;
	$(buscar_datos());

	function buscar_datos(consulta){
		$.ajax({
			url: '../php/validar.php' ,
			type: 'POST' ,
			data: {consulta: consulta},
			dataType: 'JSON',
			success: function(data){
				if (data.codigo == 1){ //Si el código es 1
            		$("#funcionario_registrar").prop("disabled", false);
            		$("#nom_fun_r").prop("disabled", false);
            		$("#ape_fun_r").prop("disabled", false);
            		$("#inlineRadio1").prop("disabled", false);
            		$("#inlineRadio2").prop("disabled", false);
            		$("#lug_nac_fun_r").prop("disabled", false);
            		$("#pai_fun_r").prop("disabled", false);
            		$("#fec_nac_fun_r").prop("disabled", false);
            		$("#area_tel_r").prop("disabled", false);
            		$("#tel_exp_r").prop("disabled", false);
            		$("#cor_fun_r").prop("disabled", false);
            		$("#est_civ_exp_r").prop("disabled", false);
            		$("#dir_exp_r").prop("disabled", false);
                        $("#parroquia_r").prop("disabled", false);
                        $("#municipio_r").prop("disabled", false);
            		$("#cond_exp_r").prop("disabled", false);
            		$("#estatus_car_r").prop("disabled", false);
            		$("#f_ing_exp_r").prop("disabled", false);
            		$("#est_fun_r").prop("disabled", false);
            		$("#cod_car_r").prop("disabled", false);
            		$("#cod_dep_r").prop("disabled", false);
                        $("#mostrar").hide();

        		}else if(data.codigo == 0){
        			$("#funcionario_registrar").prop("disabled", true);
        			$("#nom_fun_r").prop("disabled", true);
            		$("#ape_fun_r").prop("disabled", true);
            		$("#inlineRadio1").prop("disabled", true);
            		$("#inlineRadio2").prop("disabled", true);
            		$("#lug_nac_fun_r").prop("disabled", true);
            		$("#pai_fun_r").prop("disabled", true);
            		$("#fec_nac_fun_r").prop("disabled", true);
            		$("#area_tel_r").prop("disabled", true);
            		$("#tel_exp_r").prop("disabled", true);
            		$("#cor_fun_r").prop("disabled", true);
            		$("#est_civ_exp_r").prop("disabled", true);
            		$("#dir_exp_r").prop("disabled", true);
                        $("#parroquia_r").prop("disabled", true);
                        $("#municipio_r").prop("disabled", true);
            		$("#cond_exp_r").prop("disabled", true);
            		$("#estatus_car_r").prop("disabled", true);
            		$("#f_ing_exp_r").prop("disabled", true);
            		$("#est_fun_r").prop("disabled", true);
            		$("#cod_car_r").prop("disabled", true);
            		$("#cod_dep_r").prop("disabled", true);
                        $("#mostrar").hide();
        		}else if(data.codigo == 2){
                        $("#funcionario_registrar").prop("disabled", true);
                        $("#nom_fun_r").prop("disabled", true);
                        $("#ape_fun_r").prop("disabled", true);
                        $("#inlineRadio1").prop("disabled", true);
                        $("#inlineRadio2").prop("disabled", true);
                        $("#lug_nac_fun_r").prop("disabled", true);
                        $("#pai_fun_r").prop("disabled", true);
                        $("#fec_nac_fun_r").prop("disabled", true);
                        $("#area_tel_r").prop("disabled", true);
                        $("#tel_exp_r").prop("disabled", true);
                        $("#cor_fun_r").prop("disabled", true);
                        $("#est_civ_exp_r").prop("disabled", true);
                        $("#dir_exp_r").prop("disabled", true);
                        $("#parroquia_r").prop("disabled", true);
                        $("#municipio_r").prop("disabled", true);
                        $("#cond_exp_r").prop("disabled", true);
                        $("#estatus_car_r").prop("disabled", true);
                        $("#f_ing_exp_r").prop("disabled", true);
                        $("#est_fun_r").prop("disabled", true);
                        $("#cod_car_r").prop("disabled", true);
                        $("#cod_dep_r").prop("disabled", true);
                        $("#mostrar").show();
                        }
			}
		});
	}

	$(document).on('keyup','#ced_fun', function(){
		var valor = $(this).val();
		if (valor != "") {
			buscar_datos(valor);
		}else{
			buscar_datos();
		}
	});

});