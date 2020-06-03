<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Centro Administrativo</title>
    </head>
    <body>
        <?php
            $str_datos = "<div class=\"container-fluid bg-dark text-white\">
            <h1 align=\"center\">Menú Principal Administrador</h1>
            <div class=\"row alert alert-success\" align=\"center\">
                <div class=\"col\">
                    <form action='agregarAdmin.php' method='post'>
                        <div class=\"col\">
                            <button type=\"submit\" value='' name='agregarAdmin' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                                Agregar nuevo administrador
                            </button>
                        </div>
                    </form>
                    <form action='agregarHabitacion.php' method='post'>
                        <div class=\"col\">
                            <button type=\"submit\" value='' name='agregarHabitacion' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                                Agregar Habitación
                            </button>
                        </div>
                    </form>
                    <form action='agregarCama.php' method='post'>
                        <div class=\"col\">
                            <button type=\"submit\" value='' name='agregarCama' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                                Agregar Cama
                            </button>
                        </div>
                    </form>
                    <form action='verPacientesAdmin.php' method='post'>
                    <div class=\"col\">
                        <button type=\"submit\" value='' name='verPacientesAdmin' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                            Visualizar pacientes
                        </button>
                    </div>
                    </form>
                    <form action='administrarRecursos.php' method='post'>
                    <div class=\"col\">
                        <button type=\"submit\" value='' name='administrarRecursos' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                            Administrar Recursos
                        </button>
                    </div>
                    </form>
                    <form action='administrarEquipos.php' method='post'>
                    <div class=\"col\">
                        <button type=\"submit\" value='' name='administrarEquipos' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                            Administrar Equipos
                        </button>
                    </div>
                    </form>
                    <form action='administrarSolicitudes.php' method='post'>
                    <div class=\"col\">
                        <button type=\"submit\" value='' name='administrarSolicitudes' class=\"btn btn-info btn-lg btn-block\" style=\"margin-bottom: 1vw; margin-top: 1vw;\">
                            Centro de mensajes
                        </button>
                    </div>
                    </form>
                </div>
            </div>  
            </div>";
            echo "".$str_datos;

            echo '<br>';
            echo "<a class=\"btn btn-info\" href=\"login.php\">Cerrar Sesión</a>";
        ?>
    </body>
</html>