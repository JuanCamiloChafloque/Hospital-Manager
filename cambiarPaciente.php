<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cambiar de paciente a equipo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php 
                include_once dirname(__FILE__) . '../../config.php';

                $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
                if (mysqli_connect_errno()) {
                    echo "Error en la conexión: " . mysqli_connect_error();
                }

                $idPaciente = $_GET['idCambiar'];
                $idEquipo = $_GET['idEquipo'];

                $sqlAntiguo = "SELECT * FROM Pacientes WHERE Idp = \"$idPaciente\"";
                $resAntiguo = mysqli_query($con, $sqlAntiguo);
                $fila = mysqli_fetch_array($resAntiguo);
                
                $nombre = $fila['Nombre'];
                $apellido = $fila['Apellido'];
                $cedula = $fila['Cedula'];
                $prioridad = $fila['Prioridad'];

                $sqlPacientes = "SELECT * FROM Pacientes";
                $resPacientes = mysqli_query($con,$sqlPacientes);
                $filaPacientes = mysqli_fetch_array($resPacientes);

                echo "<h1 align=\"center\">Paciente Actual $idPaciente</h1>";

                $str_datos="";
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">Nombre</th>';
                            $str_datos.='<th scope="col">Apellido</th>';
                            $str_datos.='<th scope="col">Cedula</th>';
                            $str_datos.='<th scope="col">Prioridad</th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                        $str_datos.='<tr>';
                            $str_datos .= '<td>'. $nombre . '</td>';
                            $str_datos .= '<td>'. $apellido . '</td>';
                            $str_datos .= '<td>'. $cedula .'</td>';
                            $str_datos .= '<td>'. $prioridad .'</td>';
                        $str_datos.='</tr>';
                    $str_datos.='</tbody>';
                    $str_datos.='</table>';
                $str_datos.='<br>';
                echo $str_datos;


                echo "<h1 align=\"center\">Pacientes a intercambiar</h1>";
                $str_datos = "";
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">Nombre</th>';
                            $str_datos.='<th scope="col">Apellido</th>';
                            $str_datos.='<th scope="col">Cedula</th>';
                            $str_datos.='<th scope="col">Prioridad</th>';
                            $str_datos.='<th scope="col"></th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                        foreach($resPacientes as $paciente){
                            if($paciente['Cedula'] != $cedula){
                                $str_datos.='<tr>';
                                $str_datos.='<td>'. $paciente['Nombre'].'</td>';
                                $str_datos.='<td>'. $paciente['Apellido'].'</td>';
                                $str_datos.='<td>'. $paciente['Cedula'].'</td>';
                                $str_datos.='<td>'. $paciente['Prioridad'].'</td>';
                                $str_datos.='<td>
                                <a class="btn btn-danger"
                                href=\'Operaciones.php?
                                idCambiar='.$idPaciente.
                                '&idEquipo='.$idEquipo.
                                '&idNuevo='.$paciente['Idp'].
                                '\'>'. 'Intercambiar'. '</a>
                                </td>';
                                $str_datos.='</tr>';
                            }
                        }
                        $str_datos.='</tbody>';
                    $str_datos.='</table>';
                $str_datos.='<br>';
                echo $str_datos;

                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"administrarEquipos.php\">Regresar</a>";
            ?>
        </div>
    </body>
</html>