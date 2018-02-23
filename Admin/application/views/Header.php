<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?=$title?></title>

        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-client_id" content="742193328681-fjeleva82fn49jaj7vp1usqc9or7mc3a.apps.googleusercontent.com">

        <link rel="icon" type="image/png" href="assets/img/ico.png" />
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" href="assets/css/styles.css">
        <!-- EOF CSS INCLUDE -->
        <link rel="stylesheet" href="assets/css/dev.css">

    </head>
    <body>
        <div class="col-xs-12 loader">
            <div class="vertical centered col-xs-2">
                <div class="app-spinner pulse pulse-primary"></div>
            </div>
        </div>
        <!-- APP WRAPPER -->
        <div class="app">

            <!-- START APP CONTAINER -->
            <div class="app-container">
                <!-- START SIDEBAR -->
                <div class="app-sidebar app-navigation app-navigation-style-default app-navigation-open-hover dir-left" data-type="close-other">
                    <a href="Admin" class="app-navigation-logo">

                    </a>
                    <nav>
                        <ul>
                            <li class="title">NAVEGACIÓN</li>
                            <li><a href="Admin"><span class="nav-icon-hexa text-bloody-100">In</span> Inicio</a></li>
                            <li>
                                <a href="#"><span class="nav-icon-hexa text-teal-100">Pd</span> Productos</a>
                                <ul>
                                    <li><a href="ListProductos"><span class="nav-icon-hexa">Us</span> Productos</a></li>
                                    <li><a href="NuevoProducto"><span class="nav-icon-hexa">Ag</span> Agregar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="nav-icon-hexa text-teal-100">Ep</span> Escala de precios</a>
                                <ul>
                                    <li><a href="ListEscalaPrecios"><span class="nav-icon-hexa">Ep</span> Escalas de precios</a></li>
                                    <li><a href="NuevaEscalaPrecio"><span class="nav-icon-hexa">Ag</span> Agregar</a></li>
                                </ul>
                            </li>
                            <li><a href="LineaSublinea"><span class="nav-icon-hexa text-bloody-100">Ls</span> Lineas</a></li>
                            <li><a href="ListCotizaciones"><span class="nav-icon-hexa text-bloody-100">Cs</span> Cotizaciones</a></li>
                            <!--
                            <li>
                                <a href="#"><span class="nav-icon-hexa text-teal-100">Us</span> Usuarios</a>
                                <ul>
                                    <li><a href="ListMentores"><span class="nav-icon-hexa">Us</span> Usuarios</a></li>
                                    <li><a href="NuevoMentor"><span class="nav-icon-hexa">Ad</span> Agregar</a></li>
                                </ul>
                            </li>
                            -->
                            <li><a href="Configuracion"><span class="nav-icon-hexa text-bloody-100">Cf</span> Configuración</a></li>
                            <li><a href="../" target="_blank"><span class="nav-icon-hexa text-bloody-100">Ws</span> WebSite</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- END SIDEBAR -->

                <!-- START APP CONTENT -->
                <div class="app-content">
                    <!-- START APP HEADER -->
                    <div class="app-header noPrint">
                        <ul class="app-header-buttons">
                            <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                            <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                        </ul>

                        <ul class="app-header-buttons pull-right">
                            <li>
                                <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls">
                                    <?php
                                        if (file_exists("assets/img/Users/".$this->session->userdata('IdPersona')."/sm_profile_pic.jpg")) {
                                            $urlImage='assets/img/Users/'.$this->session->userdata('IdPersona').'/sm_profile_pic.jpg';
                                        }else{
                                            $urlImage='assets/img/Users/no-image.png';
                                        }
                                    ?>
                                    <div class="imgProfile" style="background-image: url(<?=$urlImage;?>);"></div>
                                    <div class="contact-container">
                                        <a href="#"><?=$this->session->userdata('Nombre');?></a>
                                        <span><?=$this->session->userdata('Nivel');?></span>
                                    </div>
                                    <div class="contact-controls">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown"><span class="icon-cog"></span></button>
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="ProfileConfig"><span class="icon-cog"></span> Mi cuenta</a></li>
                                                <li class="divider"></li>
                                                <li><a href="LogOut"><span class="icon-exit"></span> Log Out</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- END APP HEADER  -->

                    <!-- START PAGE HEADING -->
                    <div class="app-heading app-heading-bordered app-heading-page noPrint">
                        <div class="title">
                            <h2><?=$header?></h2>
                            <p><?=$description?></p>
                        </div>
                        <!--<div class="heading-elements">
                            <a href="#" class="btn btn-danger" id="page-like"><span class="app-spinner loading"></span> loading...</a>
                            <a href="https://themeforest.net/item/boooya-revolution-admin-template/17227946?ref=aqvatarius&license=regular&open_purchase_for_item_id=17227946" class="btn btn-success btn-icon-fixed"><span class="icon-text">$24</span> Purchase</a>
                        </div>-->
                    </div>
                    <div class="app-heading-container app-heading-bordered bottom noPrint">
                        <ul class="breadcrumb">
                        <?php if(isset($breadcrumb)) echo $breadcrumb; ?>
                        </ul>
                    </div>
                    <!-- END PAGE HEADING -->

                    <!-- START PAGE CONTAINER -->
                    <div class="container">
