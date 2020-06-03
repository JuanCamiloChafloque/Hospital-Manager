<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Ver Pacientes</title>
    </head>
    <body>
        <?php 
            include_once dirname(__FILE__) . '../../config.php';

            $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
            if (mysqli_connect_errno()) {
                echo "Error en la conexión: " . mysqli_connect_error();
            }

            $verify = "SELECT * FROM PACIENTES INNER JOIN USUARIOS ON PACIENTES.Medico =  USUARIOS.Id";
            $res = mysqli_query($con, $verify);
            $exists = mysqli_num_rows($res);

            if($exists > 0){
                $str_datos="";
                $str_datos.='<h1 align="center">Lista de Pacientes</h1>';
                $str_datos.='<br>';
                $str_datos.='<br>';
                $str_datos.='<table class="table">';
                    $str_datos.='<thead class="thead-dark">';
                        $str_datos.='<tr>';
                            $str_datos.='<th scope="col">Nombre</th>';
                            $str_datos.='<th scope="col">Apellido</th>';
                            $str_datos.='<th scope="col">Cama</th>';
                            $str_datos.='<th scope="col">Prioridad</th>';
                            $str_datos.='<th scope="col">Médico</th>';
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                foreach ($res as $persona) {
                        $str_datos.='<tr>';
                            $str_datos .= '<td>'.'<a href=\'singlePacienteAdmin.php?cc='.$persona['Idp'].'\'>'. $persona['Nombre'] . '</a>'.'</td>';
                            $str_datos .= '<td>'. $persona['Apellido'] . '</td>';
                            $str_datos .= '<td>'. $persona['Cama'].'</td>';
                            $str_datos .= '<td>'. $persona['Prioridad'] . '</td>';
                            $str_datos .= '<td>'. $persona['NombreUsuario'] . '</td>';
                        $str_datos.='</tr>';
                }
                $str_datos.='</tbody>';
                $str_datos.='</table>';
                $str_datos.='<br>';
                
                echo $str_datos;
                echo "<br>";
                echo "<a href=\"indexAdministrador.php\" class=\"btn btn-info\">Regresar</a>";
            }
            else{
                echo "No hay pacientes registrados en el sistema";
                echo "<br>";
                echo "<a href=\"indexAdministrador.php\" class=\"btn btn-info\">Regresar</a>";
            }
        ?>
    </body>
</html>