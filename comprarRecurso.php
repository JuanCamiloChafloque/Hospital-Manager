<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comprar Recurso Nuevo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container fluid">
        <div class="container-fluid alert alert-success" style="margin: 1vw">
            <h1>Comprar Recurso Nuevo</h1>
            <form action='Operaciones.php' method='post'>
                <div class="row form-group">
                    <label for="name" class="col-sm-2 col-form-label">Nombre del recurso</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label for="cantidadcompra" class="col-sm-2 col-form-label">Cantidad a comprar</label>
                    <div class="col-sm-4">
                        <input type="number" name="cantidadcompra" class="form-control">
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-sm-6">
                        <input type="submit" value='Agregar Recurso' name='nuevoRecurso' class="btn btn-success btn-lg btn-block">
                    </div>
                </div> 
            </form>
            <a href="administrarRecursos.php" class="btn btn-info">Regresar</a>
        </div>
    </div>
    </body>
</html>