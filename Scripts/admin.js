$(document).ready(function() {

// función peliculas recibe un JSON para cargar y mostrar todas las peliculas.
	function peliculas(){
		$.ajax({
			type: "POST",
			url: "cargarPeliculas.php",
			async: true,
			dataType: "json",
			success: function(datos) {
				update(datos);
			},
			error: function(xhr, status) {
				console.log(status);
			}
		});
		function update(datos) {
			for(var i=0;i<datos.length;i++){
				$("#tablaPeliculas table").append(
				 "<tr> <td>" + datos[i].id + "</td>"
				+ "<td>" + datos[i].nombre + "</td>"
				+ "<td>" + datos[i].puntuacion + "</td>"
				+ "<td><img src='../" + datos[i].cartel + "'></td>"	
				+" <td>"+  datos[i].anno + "</td>"	
				+ "<td class='sinopsis'>" + datos[i].sinopsis + "</td>"	
				+ "<td>" +"<button class='editarPelicula buton' value=" +i+">Editar</button" + "</td>"	

				+ "</tr></table>"
				)
			}
			//Al darle al botón editar se abrirá una pequeña ventana desde la cual se podrán cambiar los campos del elemento seleccionado.
			$(".editarPelicula").click(function(){
				window.open("EditarPelicula.php?id=" + datos[this.value].id+ "", "", "height=400,width=400");
			});
		}

	}
	peliculas();
	
// función usuarios recibe un JSON para cargar y mostrar todas las usuarios.	
	function usuarios(){
		$.ajax({
			type: "POST",
			url: "cargarUsuarios.php",
			async: true,
			dataType: "json",
			success: function(datos) {
				update(datos);
			},
			error: function(xhr, status) {
				console.log(status);
			}
		});
		
		function update(datos) {
			for(var i=0;i<datos.length;i++){
				$("#tablaUsuarios ").append(
				 "<tr> <td>" + datos[i].nick + "</td>"
				+ "<td>" + datos[i].nombre + "</td>"
				+ "<td>" + datos[i].apellido + "</td>"
				+ "<td>" + datos[i].nCompras + "</td>"	
				+ "<td>" + datos[i].esAdmin + "</td>"	
				+ "<td>" +"<button class='editar'  value="+i+">Editar</button" + "</td>"	
				+ "</tr></table>"
				)
			}
			//Al darle al botón editar se abrirá una pequeña ventana en donde se podrán cambiar los campos del elemento seleccionado.
			$(".editar").click(function(){
				window.open("EditarUsuario.php?nick=" + datos[this.value].nick+ "", "", "height=300,width=400");
			});
		}
	}
	//Función para cargar datos de las salas
	function salas(){
		$.ajax({
			type: "POST",
			url: "cargarSala.php",
			async: true,
			dataType: "json",
			success: function(datos) {
				update(datos);
			},
			error: function(xhr, status) {
				console.log(status);
			}
		});
		
		function update(datos) {
			for(var i=1;i<datos.length;i++){
				$("#tablaSala table ").append(
				 "<tr> <td>" + datos[i].sala + "</td>"
				+ "<td>" + datos[i].butacas + "</td>"
				+ "</tr></table>"
				)
			}
		}
	}	
	salas();
	usuarios();
	function estadisticas() {
		$.ajax({
			type: "POST",
			url: "informacion.php",
			async: true,
			dataType: "json",
			success: function(datos) {
				//alert(datos);
				$("#total").text(datos + " €");
			},
			error: function(xhr, status) {
				console.log(status);
			}
		});		
	}
	estadisticas();
	function subirPelicula(){
		$.ajax({
			type: "POST",
			url: "subirPelicula.php",
			async: true,
			dataType: "json",
			success: function(datos) {

				update(datos);
			},
			error: function(xhr, status) {
				console.log(status);
			}
		});	
	}
	$("#CambiarPrecio").change(function(){
		var precio = $(this).val();
		$.ajax({
			type: "POST",
			url: "cambiarPrecio.php",
			async: true,
            data: "precio=" + precio,
			dataType: "json",
			success: function(datos) {
				//estadisticas();
				alert(datos);
			},
			error: function(xhr, status) {
				console.log(status);
			}
		});		
	});
	
	$("#reestablece").click(function(){
		$.ajax({
			type: "POST",
			url: "reestablece.php",
			async: true,
			dataType: "json",
			success: function(datos) {
				//estadisticas();
				alert(datos);
			},
			error: function(xhr, status) {
				console.log(status);
			}
		});		
	});
	//Esta función comprueba que los campos del formulario para subir nuevas peliculas no estén vacíos.
	/*$("#buttonSubir").hover(function(){
	alert("");
		var nombre = $("#nombre").val();
		var ruta = $("#anno").val();
		var sinopsis = $("#sinopsis").val();
		//if(nombre != null && ruta != null && sinopsis != null){
			(this).removeAttr('disabled');
		//}

	});*/
	//$("#editar").click(function(){

	//});
} );