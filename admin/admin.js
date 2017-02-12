$(document).ready(function() {
    function peliculas() {
        $.ajax({
            type: "POST",
            url: "cargar_fotos.php",
            async: true,
            dataType: "json",
            success: function(datos) {
                /* for (var i in datos) {
                 alert(datos[i].nombre);
                 }*/
                update(datos);
            },
            error: function(xhr, status) {
                console.log(status);
            }
        });
        function update(datos) {
            for (var i = 0; i < datos.length; i++) {
                $("#tablaPeliculas table").append(
                        "<tr> <td>" + datos[i].id + "</td>"
                        + "<td>" + datos[i].nombre + "</td>"
                        + "<td>" + datos[i].puntuacion + "</td>"
                        + "<td><img src='../" + datos[i].cartel + "'></td>"
                        + " <td>" + datos[i].anno + "</td>"
                        + "<td class='sinopsis'>" + datos[i].sinopsis + "</td>"
                        + "<td>" + "<button class='editarPelicula' value=" + i + ">Editar</button" + "</td>"

                        + "</tr></table><hr/>"
                        )
            }
            $(".editarPelicula").click(function() {
                window.open("EditarPelicula.php?id=" + datos[this.value].id + "", "", "height=400,width=400");
            });
        }

    }
    peliculas();

    function usuarios() {
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
            for (var i = 0; i < datos.length; i++) {
                $("#tablaUsuarios ").append(
                        "<tr> <td>" + datos[i].nick + "</td>"
                        + "<td>" + datos[i].nombre + "</td>"
                        + "<td>" + datos[i].apellido + "</td>"
                        + "<td>" + datos[i].email + "</td>"
                        + "<td>" + datos[i].nCompras + "</td>"
                        + "<td>" + datos[i].esAdmin + "</td>"
                        + "<td>" + "<button class='editar'  value=" + i + ">Editar</button" + "</td>"
                        + "</tr></table>"
                        )
            }
            $(".editar").click(function() {
                window.open("n.php?nick=" + datos[this.value].nick + "", "", "height=400,width=400");
            });
        }
    }
    usuarios();



    function subirPelicula() {
        $.ajax({
            type: "POST",
            url: "subirPelicula.php",
            async: true,
            dataType: "json",
            success: function(datos) {
                /* for (var i in datos) {
                 alert(datos[i].nombre);
                 }*/
                update(datos);
            },
            error: function(xhr, status) {
                console.log(status);
            }
        });
    }
    estadisticas();



    //$("#editar").click(function(){

    //});
});