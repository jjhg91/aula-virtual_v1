$(document).ready(main);

	function main () {



		////////////////// VALIDAR FORMULARIO   ///////////
		$('#PreviewBoton').click(function(){

		
			var sl1 = true;
			var sl2 = true;
			var sl3 = true;
			var sl4 = true;
			var sno = true;
			var sco = true;
			var sfe = true;

		/////// LINK 1
			if ( ($('#nlink1').val() && !$('#link1').val()) || (!$('#nlink1').val() && $('#link1').val()) ) {
				$('#nlink1').css(
					{
						'border' : '3px solid red'
					}
				);
				$('#link1').css(
					{
						'border' : '3px solid red'
					}
				);
				sl1 = false;
			}else{
				$('#nlink1').css(
					{
						'border' : '0'
					}
				);
				$('#link1').css(
					{
						'border' : '0'
					}
				);
				sl1 = true;

			}





			/////// LINK 2
			if ( ($('#nlink2').val() && !$('#link2').val()) || (!$('#nlink2').val() && $('#link2').val()) ) {
				$('#nlink2').css(
					{
						'border' : '3px solid red'
					}
				);
				$('#link2').css(
					{
						'border' : '3px solid red'
					}
				);
				sl2 = false;
			}else{
				$('#nlink2').css(
					{
						'border' : '0'
					}
				);
				$('#link2').css(
					{
						'border' : '0'
					}
				);
				sl2 = true;

			}



			/////// LINK 3
			if ( ($('#nlink3').val() && !$('#link3').val()) || (!$('#nlink3').val() && $('#link3').val()) ) {
				$('#nlink3').css(
					{
						'border' : '3px solid red'
					}
				);
				$('#link3').css(
					{
						'border' : '3px solid red'
					}
				);
				sl3 = false;
			}else{
				$('#nlink3').css(
					{
						'border' : '0'
					}
				);
				$('#link3').css(
					{
						'border' : '0'
					}
				);
				sl3 = true;

			}



			/////// LINK 4
			if ( ($('#nlink4').val() && !$('#link4').val()) || (!$('#nlink4').val() && $('#link4').val()) ) {
				$('#nlink4').css(
					{
						'border' : '3px solid red'
					}
				);
				$('#link4').css(
					{
						'border' : '3px solid red'
					}
				);
				sl4 = false;
			}else{
				$('#nlink4').css(
					{
						'border' : '0'
					}
				);
				$('#link4').css(
					{
						'border' : '0'
					}
				);
				sl4 = true;

			}

	


			//// FEHCA 

			if ($('#fecha_evaluacion').val().length == 0) {
				$('#fecha_evaluacion').css(
					{
						'border' : '3px solid red'
					}
				);
				sfe = false;
			}else{
				$('#fecha_evaluacion').css(
					{
						'border' : '0'
					}
				);
				sfe = true;
			}
			

			///// CONTENIDO 
	
			if ($('#descripcion_evaluacion').val().length >= 50000 || $('#descripcion_evaluacion').val().length == 0) {
				$('#descripcion_evaluacion').css(
					{
						'border' : '3px solid red'
					}
				);
				sco = false;
			}else{
				$('#descripcion_evaluacion').css(
					{
						'border' : '0'
					}
				);
				sco = true;
			}


			if (sl1 && sl2 && sl3 && sl4 && sno && sco && sfe ) {
				$(".PreviewModal").attr('id','OpenModal');
				
				$("#btnSubmit").removeAttr('disabled');
			}else{
				$(".PreviewModal").removeAttr('id');
				$("#btnSubmit").attr('disabled','disabled');
			}

		});

























	////////////////// PREVIEW  ///////////

	$('.OpenModalPreview').click(function(){
		var plan =  $('#plan_evaluacion').val();
		var options = $('#plan_evaluacion').children('option');
		var fecha = $('#fecha_evaluacion').val();
		var descripcion = $('#descripcion_evaluacion').val().split("\n").join("<br>");
		var t = "";
		var v = "";

		options.each(function(index,option){
			if (plan == option.value) {
				t = option.text.split(":")[0];
				v = option.text.split(":")[1].split("%")[0]
			}
			
		});


		

		$('#tipo').text(t);
		$('#valor').text(v+"%");
		$('#puntos').text(20*(v*0.01)+"pts");
		$('#fecha').text(fecha);
		$('#descripcion').append(descripcion);


		$('#links').empty();
		if ($('#link1').val()) {
			var link1 = "<a href=" + $('#link1').val() + ">" + $('#nlink1').val() + "</a><br>";
			$('#links').append(link1);
		}
		
		if ($('#link2').val()) {
			var link2 = "<a href=" + $('#link2').val() + ">" + $('#nlink2').val() + "</a><br>";
			$('#links').append(link2);
		}
		
		if ($('#link3').val()) {
			var link3 = "<a href=" + $('#link3').val() + ">" + $('#nlink3').val() + "</a><br>";
			$('#links').append(link3);
		}
		
		if ($('#link4').val()) {
			var link4 = "<a href=" + $('#link4').val() + ">" + $('#nlink4').val() + "</a>";
			$('#links').append(link4);
		}
		






		if(!$("#file1").val()){
			var archivo1 = "<p>Archivo 1 - SIN CARGADO ";
		}else{
			var archivo1 = "<p>Archivo 1 - CARGADO ";
		}
		if(!$("#file2").val()){
			var archivo2 = "<p>Archivo 2 - SIN CARGADO ";
		}else{
			var archivo2 = "<p>Archivo 2 - CARGADO ";
		}
		if(!$("#file3").val()){
			var archivo3 = "<p>Archivo 3 - SIN CARGADO ";
		}else{
			var archivo3 = "<p>Archivo 3 - CARGADO ";
		}
		if(!$("#file4").val()){
			var archivo4 = "<p>Archivo 4 - SIN CARGADO ";
		}else{
			var archivo4 = "<p>Archivo 4 - CARGADO ";
		}

		$('#PreviewArchivos').empty();
		$('#PreviewArchivos').append(archivo1);
		$('#PreviewArchivos').append(archivo2);
		$('#PreviewArchivos').append(archivo3);
		$('#PreviewArchivos').append(archivo4);




	});
}
