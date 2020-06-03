<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Agregar Recursos</title>
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
                $fechaHoy = date('Y/m/d G:i:s');

                $sqlPaciente = "SELECT * FROM PACIENTES WHERE Idp = \"$idPaciente\"";
                $resPaciente = mysqli_query($con,$sqlPaciente);
                $filaPaciente = mysqli_fetch_array($resPaciente);
                $nombrePaciente = $filaPaciente['Nombre'];

                $sqlMedico = "SELECT * FROM USUARIOS INNER JOIN PERSONAS ON USUARIOS.Cedula = PERSONAS.Cedula WHERE USUARIOS.Id = \"$idMedico\" ";
                $resMedico = mysqli_query($con,$sqlMedico);
                $filaMedico = mysqli_fetch_array($resMedico);
                $nombreMedico = $filaMedico['Nombre'];

                $sql = "SELECT * FROM Inventario WHERE Tipo='Enseres' AND Cantidad > 0";
                $res = mysqli_query($con,$sql);
                $exists = mysqli_num_rows($res);

                if($exists > 0) {

                    $str_datos = "";
                    
                    $str_datos .= 

                    "<div class=\"container fluid\">
                    <div class=\"container-fluid alert alert-success\" style=\"margin: vw\">
                        <h1>Solicitar Recurso</h1>
                            <div class=\"row form-group\">
                                <label for=\"nombreMedico\" class=\"col-sm-2 col-form-label\">Nombre del Médico</label>
                                <div class=\"col-sm-4\">
                                    <input type=\"text\" name=\"nombreMedico\" value=\"$nombreMedico\" class=\"form-control\" readonly>
                                </div>
                            </div>
                            <div class=\"row form-group\">
                                <label for=\"nombrePaciente\" class=\"col-sm-2 col-form-label\">Nombre del Paciente</label>
                                <div class=\"col-sm-4\">
                                    <input type=\"text\" name=\"nombrePaciente\" value=\"$nombrePaciente\" class=\"form-control\" readonly>
                                </div>
                            </div>
                            <div class=\"row form-group\">
                                <label for=\"fechaSolicitud\" class=\"col-sm-2 col-form-label\">Fecha/Hora de la solicitud</label>
                                <div class=\"col-sm-4\">
                                    <input type=\"text\" name=\"fechaSolicitud\" value=\"$fechaHoy\" class=\"form-control\" readonly>
                                </div>
                            </div>
                            <div class=\"row form-group\">";
                            $str_datos.= "";
                            $str_datos.='<table class="table">';
                                $str_datos.='<thead class="thead-dark">';
                                    $str_datos.='<tr>';
                                        $str_datos.='<th scope="col">Nombre</th>';
                                        $str_datos.='<th scope="col">Cantidad</th>';
                                        $str_datos.='<th scope="col"></th>';
                                        $str_datos.='<th scope="col">Id Paciente</th>';
                                        $str_datos.='<th scope="col">Id Medico</th>';
                                        $str_datos.='<th scope="col">Fecha Solicitud</th>';
                                    $str_datos.='</tr>';
                                    $str_datos.='</thead>';
                                    $str_datos.='<tbody>';
                                    foreach($res as $inv){
                                            $str_datos.= '<form action=\'Operaciones.php\' method=\'post\'>';
                                            $str_datos.='<tr>';
                                                $str_datos.='<td><input type="text" name="recurso" value="'. $inv['Nombre'].'" readonly></td>';
                                                $str_datos.='<td><input type="number" name="cantidadRe"></td>';
                                                $str_datos.='<td><div class="row form-group">
                                                            <div class="col-sm-12">
                                                            <button type="submit" class="btn btn-info" name="agregarRecursoPaciente" value="Agregar">Agregar</button>                                
                                                            </div>
                                                            </div></td>';
                                                $str_datos.='<td><input type="number" name="idpac" value="'. $idPaciente.'" readonly></td>';
                                                $str_datos.='<td><input type="number" name="idmed" value="'. $idMedico.'" readonly></td>';
                                                $str_datos.='<td><input type="text" name="fyh" value="'. $fechaHoy.'" readonly></td>';
                                            $str_datos.='</tr>';
                                            $str_datos.='</form>';
                                    }
                                    $str_datos.='</tbody>';
                                $str_datos.='</table>';
                            $str_datos.='<br>';
                            $str_datos .= 
                            "</div>
                        <a href=\"singlePaciente.php?cc=".$idPaciente."&ccm=".$idMedico."\" class=\"btn btn-info\">Regresar</a>
                    </div> 
                </div>";

                echo $str_datos;

                } else {
                    echo "No hay recursos disponibles en el sistema";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"Operaciones.php\">Regresar</a>";
                }
            ?>
        </div>
    </body>
</html>