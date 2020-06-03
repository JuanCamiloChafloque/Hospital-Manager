<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                $idHabitacion = $_GET['cc'];
                $idMedico = $_GET['ccm'];

                $sqlHabitacion = "SELECT * FROM Habitaciones WHERE ID = $idHabitacion";
                $resHabitacion = mysqli_query($con, $sqlHabitacion);
                $filaHabitacion = mysqli_fetch_array($resHabitacion);

                $numeroHabitacion = $filaHabitacion['Numero'];

                $sqlCama = "SELECT * FROM CAMAS WHERE Habitacion = $idHabitacion and Estado = 'Disponible'";
                $resCama = mysqli_query($con, $sqlCama);
                $exists = mysqli_num_rows($resCama);
                
                $str_datos="";
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<h1 align="center">Habitacion</h1>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">ID</th>';
                            $str_datos.='<th scope="col">Numero</th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                        $str_datos.='<tr>';
                            $str_datos .= '<td>'. $idHabitacion . '</td>';
                            $str_datos .= '<td>'. $numeroHabitacion . '</td>';
                        $str_datos.='</tr>';
                    $str_datos.='</tbody>';
                    $str_datos.='</table>';
                $str_datos.='<br>';
                echo $str_datos;

                if($exists > 0){
                    $str_datos="";
                    $str_datos.='<br>';
                    $str_datos.='<br>';
                    $str_datos.='<h1 align="center">Camas</h1>';
                    $str_datos.='<table class="table">';
                        $str_datos.='<thead class="thead-dark">';
                            $str_datos.='<tr>';
                                $str_datos.='<th scope="col">ID</th>';
                            $str_datos.='</tr>';
                            $str_datos.='</thead>';
                            $str_datos.='<tbody>';
                                foreach($resCama as $cama){
                                    $str_datos.='<tr>';
                                        $str_datos .= '<td>'.'<a href=\'singleCama.php?cc='.$cama['Id'].'&ccm='.$idMedico.'\'>'. $cama['Id'] . '</a>'.'</td>';
                                    $str_datos.='</tr>';
                                }
                            
                        $str_datos.='</tbody>';
                        $str_datos.='</table>';
                    $str_datos.='<br>';
                echo $str_datos;
                }
                else{
                    echo "No hay camas disponibles";
                }

            ?>
        </div>
    </body>
</html>