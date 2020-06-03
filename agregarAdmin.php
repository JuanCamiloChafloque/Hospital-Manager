<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Registrar Administrador</title>
    </head>
    <body>
        <div class="container fluid">
            <div class="container-fluid alert alert-success" style="margin: 1vw">
                <h1>Registrar Administrador</h1>
                <form action='Operaciones.php' method='post'>
                    <div class="row form-group">
                        <label for="user" class="col-sm-2 col-form-label">Usuario</label>
                        <div class="col-sm-4">
                            <input type="text" name="user" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="email1" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" name="email1" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="email2" class="col-sm-2 col-form-label">Confirmar Email</label>
                        <div class="col-sm-4">
                            <input type="email" name="email2" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="contrasena" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-4">
                            <input type="password" name="contrasena" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-4">
                            <input type="text" name="nombre" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
                        <div class="col-sm-4">
                            <input type="text" name="apellido" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="cedula" class="col-sm-2 col-form-label">Cedula</label>
                        <div class="col-sm-4">
                            <input type="number" name="cedula" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <input type="submit" value='Agregar Administrador' name='nuevoAdmin' class="btn btn-success btn-lg btn-block">
                        </div>
                    </div> 
                </form>
                <a href="indexAdministrador.php" class="btn btn-info">Regresar</a>
            </div>
        </div>
    </body>
</html>