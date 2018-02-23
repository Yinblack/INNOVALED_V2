<div class="block block-arrow-top padding-top-20">
    <div class="row">
        <div class="col-md-9">
            <div class="app-heading app-heading-small noHPadding">
                <div class="title">
                    <h2>Datos de usuario</h2>
                </div>
            </div>
            <div class="listing listing-separated margin-bottom-0">
                <div class="listing-item margin-bottom-10">
                    <div class="row padding-left-20">
                        <div class="col-md-4">
                            <div>
                                <a class="text-primary">Usuario</a>
                                <p class="margin-bottom-10"><?=$this->session->userdata('Usuario');?></p>
                            </div>
                            <div>
                                <a class="text-primary">Contraseña</a>
                                <p class="margin-bottom-10">******</p>
                            </div>
                            <div class="col-xs-12 noHPadding vpadding">
                                <button class="btn btn-info btn-icon-fixed" data-toggle="modal" data-target="#modal-profile"><span class="icon-cog"></span> Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DEFAULT -->
<div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="modal-default-header">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-default-header">Datos de perfil <small>Los cambios se veran reflejados la proxima vez que inicie sesión</small></h4>
            </div>
            <div class="modal-body">
                <form id="profile_config">
                <input type="hidden" name="IdUsuario" id="IdUsuario" value="<?=$this->session->userdata('IdUsuario');?>">
                    <div class="col-xs-12">
                        <div class="app-heading app-heading-small noHPadding">
                            <div class="title">
                                <h2>Datos de usuario</h2>
                            </div>
                        </div>
                        <div class="input-group inputCliente">
                            <span class="input-group-addon">Nombre: </span>
                            <input type="text" class="form-control" name="Nombre" id="Nombre" value="<?=$this->session->userdata('Nombre');?>">
                        </div>
                        <div class="app-heading app-heading-small noHPadding">
                            <div class="title">
                                <h2>Datos de inicio de sesión <small>Solo llene los campos contraseña si desea cambiarla.</small></h2>
                            </div>
                        </div>
                        <div class="input-group inputCliente">
                            <span class="input-group-addon">Usuario: </span>
                            <input type="text" class="form-control" name="Usuario" id="Usuario" value="<?=$this->session->userdata('Usuario');?>">
                        </div>
                        <div class="input-group inputCliente">
                            <span class="input-group-addon">Contraseña: </span>
                            <input type="password" class="form-control" name="password1" id="password1">
                        </div>
                        <div class="input-group inputCliente">
                            <span class="input-group-addon">Repetir Contraseña: </span>
                            <input type="password" class="form-control" name="password2" id="password2">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-default" id="formProcess">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL DEFAULT -->
