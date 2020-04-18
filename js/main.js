window.onload = (function(a){a.fn.validCampoFranz=function(b){a(this).on({keypress:function(a){var c=a.which,d=a.keyCode,e=String.fromCharCode(c).toLowerCase(),f=b;(-1!=f.indexOf(e)||9==d||37!=c&&37==d||39==d&&39!=c||8==d||46==d&&46!=c)&&161!=c||a.preventDefault()}})}})(jQuery);


$(buscar_datos());

	function buscar_datos(consulta){
		$.ajax({
			url: '../php/buscar.php' ,
			type: 'POST' ,
			dataType: 'html',
			data: {consulta: consulta},
		})
		.done(function(respuesta){
			$("#datos").html(respuesta);
		})
		.fail(function(){
			console.log("error");
		});
	}


	$(document).on('keyup','#caja_busqueda', function(){
		var valor = $(this).val();
		if (valor != "") {
			buscar_datos(valor);
		}else{
			buscar_datos();
		}
});
function Confirmation() {
		if (confirm('Esta seguro de eliminar el registro?')==true) {
		    return true;
		}else{
		    //alert('Cancelo la eliminacion');
		    return false;
		}
}

$(function () {
				$('#nom_fam').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				$('#ced_fam').validCampoFranz('0123456789');
				$('#ape_fam').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				$('#ced_fun').validCampoFranz('0123456789');
				$('#nom_fun_r').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				$('#ape_fun_r').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				$('#lug_nac_fun_r').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				$('#pai_fun_r').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				$('#tel_exp_r').validCampoFranz('0123456789');
				$('#municipio_r').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				$('#parroquia_r').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou');
				
						
});

$('#alert').fadeIn();     
	setTimeout(function() {
	    $("#alert").fadeOut();           
	},5000);

	$('#actualiza_user').click(function(){
		actualizadatos();
	});

	function agregar_form(datos) {
		d = datos.split('||');
		$('#username').val(d[0]);
		$('#nombre').val(d[1]);
		$('#apellido').val(d[2]);
		$('#status').val(d[3]);		
	}

	function actualizadatos() {
		username=$('#username').val();
		nombre=$('#nombre').val();
		apellido=$('#apellido').val();
		status=$('#status').val();

		cadena="username=" + username +
			   "&nombre=" + nombre +
		   	   "&apellido=" + apellido +
		   	   "&status=" + status;
		$.ajax({
			type:"POST",
			url:"usuarios_actualizar.php",
			data:cadena,
			success:function(r){
				if (r==1) {
					alert("Actualización exitoso");
					location.reload();
				}else{
					alert("Error al actualizar");
				}
				}
			});
	}				
		
