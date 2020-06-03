<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Agregar Cama</title>
    </head>
    <body>
        <div class="container fluid">
            <div class="container-fluid alert alert-success" style="margin: 1vw">
                <h1>Agregar Cama</h1>
                <form action='Operaciones.php' method='post'>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <?php
                                include_once dirname(__FILE__) . '../../config.php';
                                include_once dirname(__FILE__) . '/utils.php';

                                $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
                                if (mysqli_connect_errno()) {
                                    echo "Error en la conexión: " . mysqli_connect_error();
                                }

                                $sql ="SELECT * FROM HABITACIONES";
                                $res = mysqli_query($con, $sql);
                                $exists = mysqli_num_rows($res);
                                if($exists > 0){
                                    $habitaciones = array();
                                    while($fila = mysqli_fetch_array($res)){
                                        $habitaciones["'".$fila['Id']."'"] = $fila['Numero'];
                                    }
                                    $selectHabitaciones = crearSelect('Habitación', 'habitacion',$habitaciones);
                                    echo $selectHabitaciones;
                                }
                                else{
                                    echo "No hay habitaciones disponibles, inserte una habitacion primero";
                                    echo "<br>";
                                    echo "<a href=\"indexAdministrador.php\" class=\"btn btn-info\">Regresar</a>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <input type="submit" value="Agregar Cama" name='agregarCama' class="btn btn-success btn-lg btn-block">
                        </div>
                    </div> 
                </form>
                <a href="indexAdministrador.php" class="btn btn-info">Regresar</a>
            </div>
        </div>
    </body>
</html>