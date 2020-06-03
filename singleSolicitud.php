<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Ver Solicitud</title>
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

                $idS = $_GET['idS'];

                $sqlSolicitud = "SELECT * FROM SOLICITUDES WHERE IdSolicitud = \"$idS\"";
                $resSolicitud = mysqli_query($con,$sqlSolicitud);
                $filaSolicitud = mysqli_fetch_array($resSolicitud);

                $idM = $filaSolicitud['Medico'];
                $idP = $filaSolicitud['Paciente'];

                $sqlMedico = "SELECT * FROM USUARIOS INNER JOIN PERSONAS ON USUARIOS.Cedula = PERSONAS.Cedula WHERE USUARIOS.Id = \"$idM\" ";
                $resMedico = mysqli_query($con,$sqlMedico);
                $filaMedico = mysqli_fetch_array($resMedico);

                $sqlPaciente = "SELECT * FROM PACIENTES WHERE Idp = \"$idP\"";
                $resPaciente = mysqli_query($con,$sqlPaciente);
                $filaPaciente = mysqli_fetch_array($resPaciente);

                $nombrePaciente = $filaPaciente['Nombre'];
                $apellidoPaciente = $filaPaciente['Apellido'];
                $nombreMedico = $filaMedico['Nombre'];

                $str_datos = "";
                
                $str_datos .= 

                "<div class=\"container fluid\">
                <div class=\"container-fluid alert alert-success\" style=\"margin: vw\">
                    <h1>Solicitar Recursos</h1>
                        <div class=\"row form-group\">
                            <label for=\"nombrePaciente\" class=\"col-sm-2 col-form-label\">Nombre del paciente</label>
                            <div class=\"col-sm-4\">
                                <input type=\"text\" name=\"nombrePaciente\" value=\"$nombrePaciente\" class=\"form-control\" readonly>
                            </div>
                        </div>
                        <div class=\"row form-group\">
                            <label for=\"apellidoPaciente\" class=\"col-sm-2 col-form-label\">Apellido del Paciente</label>
                            <div class=\"col-sm-4\">
                                <input type=\"text\" name=\"apellidoPaciente\" value=\"$apellidoPaciente\" class=\"form-control\" readonly>
                            </div>
                        </div>
                        <div class=\"row form-group\">
                            <label for=\"nombreMedico\" class=\"col-sm-2 col-form-label\">Nombre del Médico</label>
                            <div class=\"col-sm-4\">
                                <input type=\"text\" name=\"nombreMedico\" value=\"$nombreMedico\" class=\"form-control\" readonly>
                            </div>
                        </div>
                        <div class=\"row form-group\">";
                        $str_datos.= "";
                        $str_datos.='<table class="table">';
                            $str_datos.='<thead class="thead-dark">';
                                $str_datos.='<tr>';
                                    $str_datos.='<th scope="col">Id Solicitud</th>';
                                    $str_datos.='<th scope="col">Suministros a pedir</th>';
                                    $str_datos.='<th scope="col"></th>';
                                    $str_datos.='<th scope="col"></th>';

                                    $str_datos.='</tr>';
                                $str_datos.='</thead>';
                                $str_datos.='<tbody>';
                                foreach($resSolicitud as $inv){
                                    
                                    $idI = $inv['Suministro'];
                                    $sqlInventario = "SELECT * FROM Inventario WHERE Id = \"$idI\"";
                                    $resInventario = mysqli_query($con,$sqlInventario);
                                    $actual = mysqli_fetch_array($resInventario);

                                    $str_datos.= '<form action=\'Operaciones.php\' method=\'get\'>';
                                    $str_datos.='<tr>';
                                        $str_datos.='<td><input type="text" name="idSolicitud" value="'. $inv['IdSolicitud'].'" readonly></td>';
                                        $str_datos.='<td><input type="text" name="suministro" value="'. $actual['Nombre'].'" readonly></td>';
                                        $str_datos.='<td><div class="row form-group">
                                                    <button type="submit" class="btn btn-success" name="aprobarSol" value="Aprobar Solicitud">Aprobar Solicitud</button>                                
                                                    </div></td>';
                                        $str_datos.='<td><div class="row form-group">
                                        <button type="submit" class="btn btn-danger" name="rechazarSol" value="Rechazar Solicitud">Rechazar Solicitud</button>                                
                                        </div></td>';
                                    $str_datos.='</tr>';
                                    $str_datos.='</form>';
                                }
                                $str_datos.='</tbody>';
                            $str_datos.='</table>';
                        $str_datos.='<br>';
                        $str_datos.='<br>';
                        $str_datos.='<a class="btn btn-info" href="administrarSolicitudes.php">Regresar a las solicitudes</a>';
                        $str_datos .= 
                        "</div>
                </div> 
            </div>";
            echo $str_datos;
            ?>
        </div>
    </body>
</html>