<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Paciente</title>
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

                $identificacion = $_GET['cc'];

                $sqlPaciente = "SELECT * FROM Pacientes WHERE Idp = \"$identificacion\"";
                $resPaciente = mysqli_query($con, $sqlPaciente);
                $fila = mysqli_fetch_array($resPaciente);
                
                $id = $fila['Idp'];
                $nombre = $fila['Nombre'];
                $apellido = $fila['Apellido'];
                $prioridad = $fila['Prioridad'];
                $cama = $fila ['Cama'];

                $sqlCama = "SELECT * FROM CAMAS WHERE ID = \"$cama\" ";
                $resCama = mysqli_query($con,$sqlCama);
                $filaCama = mysqli_fetch_array($resCama);

                $habitacion = $filaCama['Habitacion'];

                $sqlHabitacion = "SELECT * FROM Habitaciones WHERE ID = \"$habitacion\" ";
                $resHabitacion = mysqli_query($con,$sqlHabitacion);
                $filaHabitacion = mysqli_fetch_array($resHabitacion);

                $numeroHabitacion = $filaHabitacion['Numero'];

                echo "<h1 align=\"center\">Paciente $id</h1>";

                $str_datos="";
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">ID</th>';
                            $str_datos.='<th scope="col">Nombre</th>';
                            $str_datos.='<th scope="col">Apellido</th>';
                            $str_datos.='<th scope="col">Prioridad</th>';
                            $str_datos.='<th scope="col">Cama</th>';
                            $str_datos.='<th scope="col">#Habitacion</th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                        $str_datos.='<tr>';
                            $str_datos .= '<td>'. $id . '</td>';
                            $str_datos .= '<td>'. $nombre . '</td>';
                            $str_datos .= '<td>'. $apellido . '</td>';
                            $str_datos .= '<td>'. $prioridad .'</td>';
                            $str_datos .= '<td>'. $cama .'</td>';
                            $str_datos .= '<td>'. $numeroHabitacion . '</td>';
                        $str_datos.='</tr>';
                    $str_datos.='</tbody>';
                    $str_datos.='</table>';
                $str_datos.='<br>';
                echo $str_datos;


                $sqlInventario = "SELECT * FROM Inventario INNER JOIN PacientesXInventario
                ON Inventario.Id = PacientesXInventario.Item 
                WHERE PacientesXInventario.Paciente = \"$identificacion\" AND Inventario.Tipo = 'Equipo'  ";

                $resInventario = mysqli_query($con,$sqlInventario);
                $filaInventario = mysqli_fetch_array($resInventario);

                echo "<h1 align=\"center\">Inventario</h1>";
                $str_datos = "";
                $str_datos="";
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">Nombre</th>';
                            $str_datos.='<th scope="col">Tipo</th>';
                            $str_datos.='<th scope="col"></th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                        foreach($resInventario as $inventario){
                                $str_datos.='<tr>';
                                    $str_datos.='<td>'. $inventario['Nombre'].'</td>';
                                    $str_datos.='<td>'. $inventario['Tipo'].'</td>';
                                $str_datos.='</tr>';
                        }
                        $str_datos.='</tbody>';
                    $str_datos.='</table>';
                $str_datos.='<br>';
                echo $str_datos;

                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"verPacientesAdmin.php\">Regresar</a>";
            ?>
        </div>
    </body>
</html>