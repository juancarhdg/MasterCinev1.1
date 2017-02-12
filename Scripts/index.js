$(document).ready(function() {
    var arrayDatos = []; //array donde se guardarán los datos de la película seleccionada


    /******************* Caragar Peliculas mas vistas**************/

    //Carga de informacion de peliculas mas vistas
    $.ajax({
        type: "POST",
        url: "cargar_fotos.php",
        async: true,
        dataType: "json",
        success: function(datos) {
            update(datos);
        },
        error: function(xhr, status) {
            console.log(status);
        }
    });

    //En esta función pintamos la información de las peliculas mas valoradas
    function update(datos) {
        $(".block02 article").each(function(index) {
            $(this).find("img").first().attr("src", datos[index].cartel);
            $(this).find("a").first().text(datos[index].nombre);
            $(this).find("p").first().text(datos[index].sinopsis);
            $(this).find(".info span").first().text(datos[index].anno);
            $(this).find("a").first().attr("id", index); //añado un id para saber que pelicula se clickea
            $('.st' + index).raty({score: datos[index].puntuacion}); // Raty es un plugin para dibujar las estrellas de la puntuación
        });

        //Cuando pinche en un título cogeremos los datos de esa pelicula para mostrarlos en la página "peliculaUnica.html"
        $(".block02 article a").click(function() {
            var arrayDatos = [];
            var id = $(this).attr("id");

            arrayDatos.push(datos[id].cartel, datos[id].nombre, datos[id].sinopsis, datos[id].anno, datos[id].puntuacion, datos[id].id, datos[id].sala);

            localStorage.setItem('datosPeli', JSON.stringify(arrayDatos));

            $(location).attr('href', "peliculaUnica.html");
        });
    }
    /******************* *********************************/





    /******************* Caragar Todas las Peliculas **************/
    //Esta llamada recupera todas las peliculas de la bbdd
    $.ajax({
        type: "POST",
        url: "admin/cargarPeliculas.php",
        async: true,
        dataType: "json",
        success: function(datos2) {
            updatePeliculas(datos2); //LLamamos a la función que muestra todas las peliculas en la página pelicula.html
        },
        error: function(xhr, status) {
            console.log(status);
        }
    });

    //Función para cargar las imagenes de las peliculas en la página peliculas html
    function updatePeliculas(datos) {
        $(".todasPeliculas").each(function(i) {
            $(this).find("img").first().attr("src", datos[i].cartel);
            $(this).find("img").first().attr("id", i); //añado un id para saber que pelicula se clickea
            $(this).find("a").first().attr("id", i); //añado un id para saber que pelicula se clickea
            $(this).find("a").first().text(datos[i].nombre);
        });

        //Aquí se pintan en la página dinámicamente
        for (var i = 0; i < datos.length; i++) {
            if (i % 3 == 0) {
                $(".todasPeliculas").append("<div class='row block03'></div><div class='col-1-4'><div class='wrap-col'><article class='listaPelis'><img src='" + datos[i].cartel + "' id='" + i + "'/> <h2><a href='#' id='" + i + "'>" + datos[i].nombre + "</a></h2> </article></div></div></div>");

            } else {
                $(".todasPeliculas").append("<div class='col-1-4'><div class='wrap-col'><article class='listaPelis'><img src='" + datos[i].cartel + "' id='" + i + "'/> <h2><a href='#' id='" + i + "'>" + datos[i].nombre + "</a></h2> </article></div></div>");
            }
        }


        //Cuando pinche en el titulo de una pelicula de la lista debe dirigirme a la página peliculaUnica.html y mostrarme la info de esa película
        $(".listaPelis a").click(function() {
            var idPeli = $(this).attr("id");
            var arrayDatos = [];

            //Guardamos los datos en un array
            arrayDatos.push(datos[idPeli].cartel, datos[idPeli].nombre, datos[idPeli].sinopsis, datos[idPeli].anno, datos[idPeli].puntuacion, datos[idPeli].id, datos[idPeli].sala);

            //Almacenamos el array en la memoria. Después la recuperamos en la página peliculaUnica.html
            localStorage.setItem('datosPeli', JSON.stringify(arrayDatos));

            //Redireccionamos a la página peliculaUnica.html
            $(location).attr('href', "peliculaUnica.html");

        });
    }

    /******************* *********************************/





    /*****     Comprar entradas            **************/

    //Aqui redirigimos a la página donde se realiza la compra de entradas
    $("#boton_comprar").click(function() {
        $(location).attr('href', "compraEntradas.html");
    });

    /*****************************************///





    /**************** Plugin Estrellas Puntuación  ***********************/
    $(function() {
        $.fn.raty.defaults.path = 'lib/img';
        $('.st0').raty();
        $('.st0').raty({number: 10});
        $('.st0').raty({
            numberMax: 5,
            number: 500
        });
        $('.st1').raty();
        $('.st1').raty({number: 10});
        $('.st1').raty({
            numberMax: 5,
            number: 500
        });
        $('.st2').raty();
        $('.st2').raty({number: 10});
        $('.st2').raty({
            numberMax: 5,
            number: 500
        });
        $('.st2').raty();
        $('.st2').raty({number: 10});
        $('.st2').raty({
            numberMax: 5,
            number: 500
        });
        $('.st3').raty();
        $('.st3').raty({number: 10});
        $('.st3').raty({
            numberMax: 5,
            number: 500
        });
        $('.st4').raty();
        $('.st4').raty({number: 10});
        $('.st4').raty({
            numberMax: 5,
            number: 500
        });
    });
    //*************************************************





    /*************** Login ***********************/
    $('#loginLink').click(function() {
        $('#desplegableForm').show('fast');

    });

    $('#loginLink2').click(function() {
        $('#desplegableForm').show('fast');
    });

    $('#loginLink3').click(function() {
        $('#desplegableForm').show('fast');
    });

    $('#nombre').focus(function() {
        if ($(this).val() === "Nombre") {
            $("#nombre").val("");
        }
    });

    $('#pass').focus(function() {
        if ($(this).val() === "****") {
            $("#pass").val("");
        }
    });
    $('#loguearse').click(function() {
        var nombre, pass;
        if ($("#pass").val() !== "" && $("#nombre").val() !== "") {
            nombre = $('#nombre').val();
            pass = $('#pass').val();
            var alumno = {
                'nombre': nombre,
                'pass': pass
            };
            $.ajax({
                type: "POST",
                url: "login.php",
                async: true,
                data: "nombre=" + nombre + "&pass=" + pass,
                success: function(respuesta) {

                    //Si el usuario no existe pintamos el fondo del input en rojo
                    if (respuesta === "-1") {
                        $("#pass").css("background-color", 'Red');
                        alert("El usuario no existe o la contraseña es incorrecta");
                    }
                    //Si el usuario no es administrador le redirigimos a la página de usuario.html
                    else if (respuesta == "0" && respuesta != "admin") {
                        $('#desplegableForm').hide();
                        $(location).attr('href', "usuario.html");
                    }
                    //Si el usuario es el administrador le redirigimos a la página de administrador
                    else if (respuesta != "0" && respuesta == "1") {
                        $(location).attr('href', "admin/admin.html");
                    }
                }
            });
        }
    });
    //*************************************************


    /****************** OPCIONES USUARIO ********************/
    $("#seleccionar_usu").click(function() {
        var opcion = $('input:radio[name=opciones]:checked').val(); //En esta linea cojo el valor del radio que esta seleccionado

        if (opcion == "puntos") {
            //lo que sea para puntos
            consultarPuntos();

        }
        else if (opcion == "cambiarContrasena") {
            //cambiar contrasena
            cambioContrasena();
        }
        else if (opcion == "darseBaja") {
            //darse de baja
            darseBaja();
        }

    });
    /* *********************************************** */



    /****************** DARSE DE BAJA ********************/
    function darseBaja() {
        $("#consultar_puntos").hide();
        $("#form_cambio_contrasena").hide();
        $("#form_baja").show();

        $("#boton_baja").click(function() {
            var nombreUsu = $("#nombre_usu").val(); //recogemos el valor del campo de texto #nombreUsu del fichero usuario.html

            //Enviamos al fichero usuario.php el nombre del usuario mediante una petición AJAX
            $.ajax({
                type: "POST",
                url: "usuario.php",
                async: true,
                data: "nombreUsu=" + nombreUsu,
                success: function(respuesta) { //La respuesta del servidor se recoge en la variable "respuesta"
                    $("#form_baja").find("h3").text(respuesta); //Imprimimos el mensaje de respuesta en el <h3> del div #form_baja

                    if (respuesta === "El usuario " + nombreUsu + " se ha eliminado correctamente") {
                        setTimeout('window.location.href="index.html"', 2000); //redirigimos al index
                    }
                }
            });
        });
    }
    /* *********************************************** */



    /****************** CAMBIAR CONTRASEÑA ********************/
    function cambioContrasena() {
        $("#consultar_puntos").hide();
        $("#form_baja").hide();
        $("#form_cambio_contrasena").show();

        $("#boton_nueva_password").click(function() {
            $("#re_nueva_password").css("background-color", 'White');

            var nuevaPass = $("#nueva_password").val();
            var reNuevaPass = $("#re_nueva_password").val();

            //Si las 2 contraseñas son iguales
            if (nuevaPass == reNuevaPass) {

                $.ajax({
                    type: "POST",
                    url: "usuario.php",
                    async: true,
                    data: "nuevaPass=" + nuevaPass,
                    success: function(respuesta) {
                        $("#form_cambio_contrasena").find("h3").text(respuesta); //Mostramos mensaje de que se ha realizado correctamente
                    }
                });
            }
            else {
                $("#re_nueva_password").css("background-color", 'Red'); //Ponemos el fondo rojo si no coinciden
            }
        });

    }
    /* *********************************************** */



    /****************** CONSULTAR PUNTOS ********************/
    function consultarPuntos() {
        $("#form_baja").hide();
        $("#form_cambio_contrasena").hide();
        $("#consultar_puntos").show();

        var datos = 1;

        //Realizamos una petición al fichero usuario.php para recuperar los datos del usuario logueado
        $.ajax({
            type: "POST",
            url: "usuario.php",
            async: true,
            data: "datos=" + datos,
            success: function(respuesta) {
                var arrayDatos = JSON.parse(respuesta); //Recibimos los datos del usuario y lo pareseamos a un objeto JSON
                console.log(arrayDatos)
                $("#form_baja").hide();
                $("#form_cambio_contrasena").hide();
                $("#form_puntos").show();

                //Si no esta logueado mostramos mensaje de error
                if (typeof(arrayDatos.nombre) == "undefined") {
                    $("#form_puntos").find("h3").text("DEBE LOGUEARSE PRIMERO");
                }
                //Si esta logueado mostramos la información del usuario
                else {
                    $("#form_puntos").find("p").text("Nombre: " + arrayDatos.nombre + " " + arrayDatos.apellido + " " + arrayDatos.SegundoApellido);
                    $("#form_puntos").find("p").append("<br/>Nick: " + arrayDatos.nick);
                    $("#form_puntos").find("p").append("<br/>Puntos Acumulados: " + arrayDatos.puntuacion);
                    $("#form_puntos").find("p").append("<br/>Numero de compras: " + arrayDatos.nCompras);
                    $("#form_puntos").find("p").append("<br/>E-Mail: " + arrayDatos.email);
                }
            }
        });

    }
    /* *********************************************** */



    /* **********  CERRAR SESION  ************** */
    $("#cerrar_sesion").click(function() {
        var datos = 1;
        $.ajax({
            type: "POST",
            url: "usuario.php",
            async: true,
            data: "cerrarSesion=" + datos,
            success: function(sesionCerrada) {
                alert(sesionCerrada);

                $(location).attr('href', "index.html");
            }
        });
    });
    /* *********************************************** */


});
