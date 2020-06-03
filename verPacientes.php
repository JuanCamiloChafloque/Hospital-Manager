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
            $usuario = $_GET['verPacientes'];

            $sqlMedico = "SELECT Id FROM Usuarios WHERE CEDULA = \"$usuario\"";
            $resMedico = mysqli_query($con, $sqlMedico);
            $fila = mysqli_fetch_array($resMedico);
            $id = $fila['Id'];



            $verify = "SELECT * FROM PACIENTES WHERE Medico = \"$id\" ";
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
                        $str_datos.='</tr>';
                        $str_datos.='</thead>';
                        $str_datos.='<tbody>';
                foreach ($res as $persona) {
                        $str_datos.='<tr>';
                            $str_datos .= '<td>'.'<a href=\'singlePaciente.php?cc='.$persona['Idp'].'&ccm='.$id.'\'>'. $persona['Nombre'] . '</a>'.'</td>';
                            $str_datos .= '<td>'. $persona['Apellido'] . '</td>';
                            $str_datos .= '<td>'. $persona['Cama'].'</td>';
                            $str_datos .= '<td>'. $persona['Prioridad'] . '</td>';
                        $str_datos.='</tr>';
                }
                $str_datos.='</tbody>';
                $str_datos.='</table>';
                $str_datos.='<br>';
                
                echo $str_datos;
                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"indexMedico.php?cc=".$usuario."\">Regresar</a>";
            }
            else{
                echo "El medico no tiene pacientes asignados";
                echo "<br>";
                // echo "<a class=\"btn btn-info\" href=\"Operaciones.php\">Regresar</a>";
                echo "<a class=\"btn btn-info\" href=\"indexMedico.php?cc=".$usuario."\">Regresar</a>";
            }
        ?>
    </body>
</html>