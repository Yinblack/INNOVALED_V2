<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?=$title?></title>

        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-client_id" content="742193328681-fjeleva82fn49jaj7vp1usqc9or7mc3a.apps.googleusercontent.com">

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" href="assets/css/styles.css">
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        <!-- APP WRAPPER -->
        <div class="app app-fh">

            <!-- START APP CONTAINER -->
            <div class="app-container" style="background: url(assets/img/background/bg-1.jpg) center center no-repeat fixed;">

                <div class="app-login-box">
                    <div class="app-login-box-user"><img src="assets/img/Users/no-image.png"></div>
                    <div class="app-login-box-title">
                        <div class="subtitle">Ingresa a tu cuenta</div>
                    </div>
                    <div class="app-login-box-container">
                        <form id="Login">
                            <div class="form-group">
                                <input type="text" class="form-control" name="User" id="User" placeholder="Email o usuario">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="Pass" id="Pass" placeholder="Contraseña">
                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <button type="button" class="btn btn-success btn-block" id="BtnLogin">Entrar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="app-login-box-or">
                        <div class="or">Ó</div>
                    </div>
                    <div class="col-xs-12 text-center">
                        <a href="Registro">Crea una cuenta</a>
                    </div>
                    <div class="app-login-box-footer">
                        &copy; Vaeo 2017. All rights reserved.
                    </div>
                </div>

            </div>
            <!-- END APP CONTAINER -->

        </div>
        <!-- END APP WRAPPER -->

        <!-- IMPORTANT SCRIPTS -->
        <script type="text/javascript" src="assets/js/vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/vendor/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/vendor/moment/moment.min.js"></script>
        <script type="text/javascript" src="assets/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <!-- END IMPORTANT SCRIPTS -->
        <!-- APP SCRIPTS -->
        <script type="text/javascript" src="assets/js/app.js"></script>
        <script type="text/javascript" src="assets/js/app_plugins.js"></script>
        <script type="text/javascript" src="assets/js/app_demo.js"></script>
        <script type="text/javascript" src="assets/js/dev.js"></script>
        <?=$js?>
        <!-- END APP SCRIPTS -->
    </body>
</html>
