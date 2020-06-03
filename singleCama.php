<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Cama</title>
    </head>
    <body>
        <div class="container fluid">
            <div class="container-fluid alert alert-success" style="margin: 1vw">
                <h1>Registrar Paciente</h1>
                <form action='Operaciones.php' method='post'>
                    <div class="row form-group">
                        <label for="user" class="col-sm-2 col-form-label">Cedula</label>
                        <div class="col-sm-4">
                            <input type="number" name="cedulaPaciente" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-4">
                            <input type="text" name="nombrePaciente" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
                        <div class="col-sm-4">
                            <input type="text" name="apellidoPaciente" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="cedula" class="col-sm-2 col-form-label">Diagnostico</label>
                        <div class="col-sm-4">
                            <input type="text" name="diagnosticoPaciente" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="cedula" class="col-sm-2 col-form-label">Prioridad</label>
                        <div class="col-sm-4">
                            <input type="number" name="prioridadPaciente" class="form-control" max="3" min="1">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="cedula" class="col-sm-2 col-form-label">Fecha de Ingreso</label>
                        <div class="col-sm-4"> 
                            <input type="date" name="fechaPaciente" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="cedula" class="col-sm-2 col-form-label">Duración de la hospitalizacion (dias)</label>
                        <div class="col-sm-4">
                            <input type="number" name="duracionPaciente" class="form-control">
                        </div>
                    </div>
                    <?php 
                        $idCama = $_GET['cc'];
                        $idMedico = $_GET['ccm'];
                    ?>
                    <div class="row form-group">
                        <label for="cedula" class="col-sm-2 col-form-label">ID Cama</label>
                        <div class="col-sm-4">
                            <input type="number" value="<?php echo $idCama;?>" name="idCamaPaciente" readonly class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="cedula" class="col-sm-2 col-form-label">ID Medico</label>
                        <div class="col-sm-4">
                            <input type="number"  value="<?php echo $idMedico;?>" name="idMedicoPaciente" readonly class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <button type="submit" name='asignarPaciente' class="btn btn-success btn-lg btn-block">
                                Asignar Paciente
                            </button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </body>
</html>