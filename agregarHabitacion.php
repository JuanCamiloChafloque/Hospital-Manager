<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Agregar Habitación</title>
    </head>
    <body>
        <div class="container fluid">
            <div class="container-fluid alert alert-success" style="margin: 1vw">
                <h1>Agregar Habitación</h1>
                <form action='Operaciones.php' method='post'>
                    <div class="row form-group">
                        <label for="numeroHabitacion" class="col-sm-2 col-form-label">Número de Habitación</label>
                        <div class="col-sm-4">
                            <input type="number" name="numeroHabitacion" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <input type="submit" value="Agregar Habitación" name='agregarHabitacion' class="btn btn-success btn-lg btn-block">
                        </div>
                    </div> 
                </form>
                <a href="indexAdministrador.php" class="btn btn-info">Regresar</a>
            </div>
        </div>
    </body>
</html>