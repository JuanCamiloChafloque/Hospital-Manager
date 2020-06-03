<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Equipo</title>
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

                $idEquipo = $_GET['ce'];

                $sqlEquipo = "SELECT * FROM Inventario WHERE Id = \"$idEquipo\"";
                $resEquipo = mysqli_query($con, $sqlEquipo);
                $fila = mysqli_fetch_array($resEquipo);
                
                $nombre = $fila['Nombre'];
                $cantidad = $fila['Cantidad'];
                $tipo = $fila['Tipo'];

                $sqlPacientes = "SELECT * FROM PacientesXInventario INNER JOIN Pacientes ON PacientesXInventario.Paciente = Pacientes.Idp WHERE Item = \"$idEquipo\" ";
                $resPacientes = mysqli_query($con,$sqlPacientes);
                $filaPacientes = mysqli_fetch_array($resPacientes);

                echo "<h1 align=\"center\">Equipo $idEquipo</h1>";

                $str_datos="";
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">Nombre</th>';
                            $str_datos.='<th scope="col">Cantidad</th>';
                            $str_datos.='<th scope="col">Tipo</th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                        $str_datos.='<tr>';
                            $str_datos .= '<td>'. $nombre . '</td>';
                            $str_datos .= '<td>'. $cantidad . '</td>';
                            $str_datos .= '<td>'. $tipo .'</td>';
                        $str_datos.='</tr>';
                    $str_datos.='</tbody>';
                    $str_datos.='</table>';
                $str_datos.='<br>';
                echo $str_datos;


                echo "<h1 align=\"center\">Pacientes asignados al equipo</h1>";
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
                                $str_datos.='<tr>';
                                    $str_datos.='<td>'. $paciente['Nombre'].'</td>';
                                    $str_datos.='<td>'. $paciente['Apellido'].'</td>';
                                    $str_datos.='<td>'. $paciente['Cedula'].'</td>';
                                    $str_datos.='<td>'. $paciente['Prioridad'].'</td>';
                                    $str_datos.='<td>
                                    <a class="btn btn-success"
                                    href=\'cambiarPaciente.php?
                                    idCambiar='.$paciente['Idp'].
                                    '&idEquipo='.$idEquipo.
                                    '\'>'. 'Cambiar de paciente'. '</a>
                                    </td>';
                                    $str_datos.='</tr>';
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