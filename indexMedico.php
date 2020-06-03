<!DOCTYPE html>
<html lang="en">
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <title>Centro Medico</title>
    </head>
    <body>
        <?php 
            $cedula = $_GET['cc'];

            $str_datos = "<div class=\"container-fluid bg-dark text-white\">
                <h1 align=\"center\">Menú Principal Médico</h1>
                <div class=\"row alert alert-success\" align=\"center\">
                <div class=\"col\">
                    <form action='verPacientes.php' method='get'>
                        <div class=\"col\">
                            <button type=\"submit\" value='$cedula' name='verPacientes' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                                Ver Pacientes
                            </button>
                        </div>
                        </form>
                    <form action='verHabitaciones.php' method='post'>
                        <div class=\"col\">
                            <button type=\"submit\" value='$cedula' name='verHabitaciones' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                                Ver Habitaciones
                            </button>
                        </div>
                    </form>
                </div>
                </div>  
                </div>";
                
            echo $str_datos;

            echo '<br>';
            echo "<a class=\"btn btn-info\" href=\"login.php\">Cerrar Sesión</a>";
        ?>
    </body>
</html>