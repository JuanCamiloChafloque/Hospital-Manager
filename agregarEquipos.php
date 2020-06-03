<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Agregar Equipos</title>
    </head>
    <body>
        <div class="container-fluid">
            <?php 
                include_once dirname(__FILE__) . '../../config.php';
                include_once dirname(__FILE__) . '/utils.php';
                
                $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
                if (mysqli_connect_errno()) {
                    echo "Error en la conexión: " . mysqli_connect_error();
                }

                $idPaciente = $_GET['cc'];
                $idMedico = $_GET['ccm'];

                $sqlPaciente = "SELECT * FROM PACIENTES WHERE Idp = \"$idPaciente\"";
                $resPaciente = mysqli_query($con,$sqlPaciente);
                $filaPaciente = mysqli_fetch_array($resPaciente);
                $nombrePaciente = $filaPaciente['Nombre'];

                $sqlMedico = "SELECT * FROM USUARIOS INNER JOIN PERSONAS ON USUARIOS.Cedula = PERSONAS.Cedula WHERE USUARIOS.Id = \"$idMedico\" ";
                $resMedico = mysqli_query($con,$sqlMedico);
                $filaMedico = mysqli_fetch_array($resMedico);
                $nombreMedico = $filaMedico['Nombre'];

                $sql = "SELECT * FROM Inventario WHERE Tipo='Equipo' AND Cantidad > 0";
                $res = mysqli_query($con,$sql);
                $exists = mysqli_num_rows($res);

                if($exists > 0) {

                    $str_datos = "";
                    $recursos = array();
                    while($fila = mysqli_fetch_array($res)){
                        $recursos["'".$fila['Id']."'"] = $fila['Nombre'];
                    }
                    $fecha = date('Y-m-d H:i:s');
                    $selectRecursos = crearSelect('Equipos', 'equipos', $recursos);
                    $str_datos .= 
                    "<div class=\"container fluid\">
                    <div class=\"container-fluid alert alert-success\" style=\"margin: 1vw\">
                        <h1>Solicitar Equipo</h1>
                        <form action='Operaciones.php' method='post'>
                            <div class=\"row form-group\">
                                <label for=\"nombreMedico\" class=\"col-sm-2 col-form-label\">Nombre del Médico</label>
                                <div class=\"col-sm-4\">
                                    <input type=\"text\" name=\"idMedico\" value=\"$idMedico\" class=\"form-control\" readonly>
                                </div>
                            </div>
                            <div class=\"row form-group\">
                                <label for=\"nombrePaciente\" class=\"col-sm-2 col-form-label\">Nombre del Paciente</label>
                                <div class=\"col-sm-4\">
                                    <input type=\"text\" name=\"idPaciente\" value=\"$idPaciente\" class=\"form-control\" readonly>
                                </div>
                            </div>
                            <div class=\"row form-group\">
                                <label for=\"fechaSolicitud\" class=\"col-sm-2 col-form-label\">Fecha de la solicitud</label>
                                <div class=\"col-sm-4\">
                                    <input type=\"text\" name=\"fechaSolicitud\" value=\"$fecha\" class=\"form-control\" readonly>
                                </div>
                            </div>
                            <div class=\"row form-group\">";
                                $str_datos .= $selectRecursos;
                                $str_datos .= 
                            "</div>
                            <div class=\"row form-group\">
                                <div class=\"col-sm-6\">
                                    <button type=\"submit\" name='registrarEquipo' class=\"btn btn-success btn-lg btn-block\">
                                        Registrar Solicitud
                                    </button>
                                </div>
                            </div> 
                        </form>
                        <a href=\"singlePaciente.php?cc=".$idPaciente."&ccm=".$idMedico."\" class=\"btn btn-info\">Regresar</a>
                    </div> 
                </div>";

                echo $str_datos;

                } else {
                    echo "No hay equipos disponibles en el sistema";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"Operaciones.php\">Regresar</a>";
                }
            ?>
        </div>
    </body>
</html>