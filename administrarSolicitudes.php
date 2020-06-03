<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Centro de mensajes</title>
    </head>
    <body>
        <?php 
            include_once dirname(__FILE__) . '../../config.php';

            $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
            if (mysqli_connect_errno()) {
                echo "Error en la conexión: " . mysqli_connect_error();
            }
            $sql = "SELECT * FROM SOLICITUDES INNER JOIN PACIENTES ON SOLICITUDES.PACIENTE = PACIENTES.Idp GROUP BY IdSolicitud ORDER BY PRIORIDAD DESC, FechaSolicitud ASC";
            $res = mysqli_query($con, $sql);
            $fila = mysqli_fetch_array($res);



            $verify = "SELECT * FROM SOLICITUDES";
            $resVerify = mysqli_query($con, $verify);
            $exists = mysqli_num_rows($res);

            if($exists > 0){
                $str_datos="";
                $str_datos.='<h1 align="center">Lista de Solicitudes</h1>';
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">Id Solicitud</th>';
                            $str_datos.='<th scope="col">Nombre</th>';
                            $str_datos.='<th scope="col">Apellido</th>';
                            $str_datos.='<th scope="col">Prioridad</th>';
                            $str_datos.='<th scope="col"></th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                foreach ($res as $solicitud) {
                    $str_datos.= '<form action=\'singleSolicitud.php\' method=\'get\'>';
                    $str_datos.='<tr>';
                        $str_datos.='<td><input type="text" name="idS" value="'. $solicitud['IdSolicitud'].'" readonly></td>';
                        $str_datos.='<td><input type="text" name="nombre" value="'. $solicitud['Nombre'].'" readonly></td>';
                        $str_datos.='<td><input type="text" name="apellido" value="'. $solicitud['Apellido'].'" readonly></td>';
                        $str_datos.='<td><input type="text" name="prioridad" value="'. $solicitud['Prioridad'].'" readonly></td>';
                        $str_datos.='<td><div class="row form-group">
                                    <button type="submit" class="btn btn-info" name="verSolicitud" value="verSolicitud">Ver Solicitud</button>                                
                                    </div></td>';
                    $str_datos.='</tr>';
                    $str_datos.='</form>';

                }
                $str_datos.='</tbody>';
                $str_datos.='</table>';
                $str_datos.='<br>';
                
                echo $str_datos;
                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"indexAdministrador.php\">Regresar</a>";
            }
            else{
                echo "No hay solicitudes pendientes";
                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"indexAdministrador.php\">Regresar</a>";
            }
        ?>
    </body>
</html>