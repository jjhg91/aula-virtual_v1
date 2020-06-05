$(document).ready(main);

	function main () {

		/////////////// TIPO DE EVALUACION /////////////////
		
		$('.tipo').change(function(){
			
			 $('.tipo').find("option:selected").each(function() {
				if ($(this).val().trim() == 8) {
					$('#otros').removeClass('oculto');
					
				}else{
					$('#otros').addClass('oculto');
				}
			});

		

		});


	////////////////// PREVIEW  ///////////

	$('.OpenModalPreview').click(function(){
		var tipo = $('#tipo_evaluacion').val();
		var valor = $('#valor_evaluacion').val();
		var semana = $('#semana_evaluacion').val();
		var descripcion = $('#descripcion_evaluacion').val();
		var t = "";

		
		if(tipo == 1){
			t = "Prueba";
		}else if(tipo == 2){
			t = "Trabajo";
		}else if(tipo == 3){
			t = "Exposición";
		}else if(tipo == 4){
			t = "Taller";
		}else if(tipo == 5){
			t = "Discusión";	
		}else if(tipo == 6){
			t = "Seminario";	
		}else if(tipo == 7){
			t = "Informe";	
		}else if(tipo == 8){
			t = "Otro";		
		}

		$('#tipo').text(t);
		$('#semana').text(semana);
		$('#valor').text(valor*5+"%");
		$('#puntos').text(20*((valor*5)*0.01)+"pts" );
		$('#descripcion').text(descripcion);





	});
}
