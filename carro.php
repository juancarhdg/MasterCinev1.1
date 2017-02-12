<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Master´s Cine</title>

        <!-- Mobile Specific Metas
      ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- CSS
      ================================================== -->
        <link rel="stylesheet" href="css/zerogrid.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/responsiveslides.css" />


        <link href='./images/favicon.ico' rel='icon' type='image/x-icon'/>
        <script src="js/jquery.min.js"></script>
        <script src="Scripts/jquery-1.11.0.js"></script>
        <script src="js/responsiveslides.js"></script>
        <script src="./Scripts/index.js"></script>
        <script src="./lib/jquery.raty.js"></script>

        <script>
            $(document).ready(function() {
                //En esta llamada comprobamos si el usuario se a logueado ya.
                //Si lo está mostraremos en el menú de navegación el enlace a la página de usuario
                $.ajax({
                    type: "POST",
                    url: "comprobar_logueado.php",
                    async: true,
                    success: function(logueado) {
                        $("#cerrar_sesion").hide();
                        if (logueado == 1) {
                            estasLogueado = logueado;
                            //Agregamos el enlace a la página de usuario
                            $("#menuNavegacion5").append("<li><a href='usuario.html' id='usuarioLink'>Usuario</a></li>");
                            $("#cerrar_sesion").show();
                        }
                        else if (logueado == 2) {
                            //Agregamos el enlace a la página de administrador
                            $("#menuNavegacion5").append(" <li><a href='admin/admin.html' id='usuarioLink'>Admin</a></li>");
                            $("#loginLink").hide(); //Oculta el enlace de login
                            $("#cerrar_sesion").show();
                        }
                    },
                    error: function(xhr, status) {
                        console.log(status);
                    }
                });
                
                //Para validar los campos de los datos de la tarjeta
                $("#validar_tarjeta").click(function(){
                    if($("#titular").val()== ""){
                        $("#titular").css("background-color","red");
                        $("#aviso").show();
                        $("#aceptar").hide();
                    }else{
                        $("#titular").css("background-color","white");
                        $("#aviso").hide();
                    }
                    if($("#tarjeta").val()== ""){
                        $("#tarjeta").css("background-color","red");
                        $("#aviso2").show();
                        $("#aceptar").hide();
                    }else{
                        $("#tarjeta").css("background-color","white");
                        $("#aviso2").hide();
                    }
                    //Si los campos de nombre de titulat y número de tarjeta son correctos mostramos el botón de comprar
                    if($("#titular").val()!= "" && $("#tarjeta").val()!= "" ){
                        $("#aceptar").show();
                    }                   
                });            
            });

        </script>

    </head>
    <body>
        <!--------------Header--------------->
        <header>
            <div class="wrap-header zerogrid">
                <div id="logo"><img src="./img/logotipo.png"/></div>
            </div>
        </header>

        <nav>
            <div class="wrap-nav zerogrid">
                <div class="menu">
                    <ul id="menuNavegacion5">
                        <li class="current"><a href="index.html">Home</a></li>
                        <li><a href="peliculas.html">Peliculas</a></li>
                        <li><a id="cerrar_sesion" href="#" style="display: block;">Cerrar Sesion</a></li>    
                    </ul>
                </div>
                <div id="desplegableForm">
                    <form id="formularioLogin" method="post" action="login.php">
                        <input type="text" value="Nombre" name="nombre " id="nombre">
                        <input type="password" value="****" name="pass" id="pass">
                        <input type="button" id="loguearse" value="Log in">
                        <input type="checkbox" value="¿Recordar?">Recordar
                    </form>
                </div>


            </div>
        </nav>

        <!--------------Content--------------->
        <section id="content">
            <div class="wrap-content zerogrid">
                <div class="row block03">
                    <div class="col-2-3">
                        <?php
                        require_once "ClaseCarro.php";
                        $carro = new Carro();
                        $carro->ver_carro($_SESSION['nick']);
                        ?>
                    </div>
                    <div class="col-1-3">
                        <div class="wrap-col">
                            <div class="box">
                                <div class="heading"><h2>Resumen</h2></div>
                                <div class="content">
                                    <?php
                                    require_once "ClaseCarro.php";
                                    $carro = new Carro();
                                    $carro->resumen_compra($_SESSION['nick']);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--------------Footer--------------->
        <footer>
            <div class="wrap-footer zerogrid">
                <div class="row block09">
                    <div class="col-1-4">
                        <div class="wrap-col">
                            <div class="box">
                                <div class="heading"><h2>Contact Us</h2></div>
                                <div class="content">
                                    <ul>
                                        <li>Direccion : Avd. Manoteras 210 Madrid (España)</li>
                                        <li>Teléfono : 91000111222</li>
                                        <li>Email : contacto@mastercine.com</li>
                                        <li>Website : www.mastercine.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row copyright">
                    <p>Copyright © 2013 - <a href="index.html" target="_blank">Master´s Cines</a> by Daniel Morillas, Juan Carlos Hidalgo, Alejandro Jimenez</p>
                </div>
            </div>
        </footer>

    </body></html>