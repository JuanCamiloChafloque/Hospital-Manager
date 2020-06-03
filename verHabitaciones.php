<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Habitaciónes</title>
    </head>
    <body>
        <div class="container-fluid">
        <?php 
            include_once dirname(__FILE__) . '../../config.php';

            $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
            if (mysqli_connect_errno()) {
                echo "Error en la conexión: " . mysqli_connect_error();
            }
            $idMedico = $_POST['verHabitaciones'];

            $sqlHabitaciones = "SELECT * FROM Habitaciones";
            $resHabitaciones = mysqli_query($con, $sqlHabitaciones);
            $exists = mysqli_num_rows($resHabitaciones);

            $sqlMedico = "SELECT * FROM USUARIOS WHERE CEDULA = \"$idMedico\"";
            $resMedico = mysqli_query($con,$sqlMedico);
            $filaMedico = mysqli_fetch_array($resMedico);

            $IdM = $filaMedico['Id'];

            if($exists > 0){
                $str_datos="";
                $str_datos.='<h1 align="center">Lista de Habitaciones</h1>';
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">ID</th>';
                            $str_datos.='<th scope="col">Numero</th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                
                foreach ($resHabitaciones as $persona) {
                    $str_datos.='<tbody>';
                        $str_datos.='<tr>';
                            $str_datos .= '<td>'.'<a href=\'singleHabitacion.php?cc='.$persona['Id'].'&ccm='.$IdM.'\'>'. $persona['Id'] . '</a>'.'</td>';
                            $str_datos .= '<td>'. $persona['Numero'] . '</td>';
                        $str_datos.='</tr>';
                    $str_datos.='</tbody>';
                }
                $str_datos.='</table>';
                $str_datos.='<br>';
                
                echo $str_datos;
                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"indexMedico.php?cc=".$idMedico."\">Regresar</a>";
            }
            else{
                echo "No hay habitaciones en el sistema";
                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"indexMedico.php?cc=".$idMedico."\">Regresar</a>";
            }

        ?>
        </div>
    </body>
</html>