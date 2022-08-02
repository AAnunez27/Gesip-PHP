$(document).ready(function(){
	
});

function iniciar(){
	var rut = $('#txt_rut').val();
	var pas = $("#txt_pas").val();
	
	$.ajax({
		url: 'Usuarios/buscar_usuario.php',
		type: "POST",
		data: "submit="
		+"&rut="+rut
		+"&pas="+pas,
		success: function(datos){
			if(datos == "ok"){
				window.top.location.replace("menu.php");
				
			}else{
				alert(datos);
			}
		}
	});
	return false;
}