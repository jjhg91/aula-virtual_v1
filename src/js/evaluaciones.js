$(document).ready(main);

	function main () {

	////////////////// PREVIEW  ///////////

	$('.OpenModalPreview').click(function(){
		var plan =  $('#plan_evaluacion').val();
		var options = $('#plan_evaluacion').children('option');
		var fecha = $('#fecha_evaluacion').val();
		var descripcion = $('#descripcion_evaluacion').val();
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
		$('#descripcion').text(descripcion);




	});
}
