$(document).ready(main);

	function main () {

	////////////////// PREVIEW  ///////////

	$('.OpenModalPreview').click(function(){
		var numero = $('#numero').val();
		var message = $('#message').val(); 
		$('#PreviewNumero').text("Contenido "+numero);
		$('#PreviewContenido').text(message);


	});
}
