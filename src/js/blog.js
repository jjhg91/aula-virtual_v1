$(document).ready(main);

	function main () {


	$('.OpenModalPreview').click(function(){
		var titulo = $('#title').val();
		var descripcion = $('#message').val().split("\n");
		
		$('#titulo_pre').text(titulo);

		var prueba = [];
		descripcion.forEach(function(pru,index){
			
			prueba.push(pru);
			prueba.push("<br>");
		});


		$('#descripcion_pre').empty();
		$('#descripcion_pre').append(prueba);


	});
}
