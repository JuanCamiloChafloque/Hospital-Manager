<!DOCTYPE html>
<!--
Antes de mostar esta página se debió ejecutar lo siguiente 
1. createTables.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> Login </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid" style="margin: 1vw">
            <div class="row">
                <div class="col">
                    <h1>Login</h1>
                    <form action='Operaciones.php' method='post'>
                        <div class="row form-group">
                            <label for="Usuario" class="col-sm-2 col-form-label">Usuario</label>
                            <div class="col-sm-4">
                                <input type="text" name="Usuario" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="Contrasena" class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-4">
                                <input type="password" name="Contrasena" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-info btn-lg btn-block" name="iniciarsesion" value="Iniciar Sesión">Iniciar Sesión</button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row form-group">
                        <form action='RegistroMedico.php' method='post'>
                            <div class="col-sm-6">
                                <button type="submit" value='Registrar Medico' name='registrarmedico' class="btn btn-info btn-lg btn-block">Registrar Médico</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>