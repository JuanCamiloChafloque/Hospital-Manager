<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Administrar Equipos </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid" style="margin: 1vw">
            <h1>Administrar Equipos</h1>
            <br><br>
            <a class="btn btn-success" href="comprarEquipo.php">Comprar Nuevo equipo</a>
            <br>
            <div class="row-form-group">
                <table class="table">
                    <thead class="table">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once dirname(__FILE__) . '../../config.php';

                            $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
                            if (mysqli_connect_errno()) {
                                echo "Error en la conexión: " . mysqli_connect_error();
                            }
            
                            $sql = "SELECT * FROM Inventario WHERE Tipo='Equipo' ORDER BY Cantidad ASC";
                            $res = mysqli_query($con,$sql);

                            foreach($res as $inv){
                                $str_datos = '';
                                $str_datos.= '<form action=\'Operaciones.php\' method=\'post\'>';
                                $str_datos.='<tr>';
                                    $str_datos.='<td><input type="text" name="equipo" value="'. $inv['Nombre'].'" readonly></td>';
                                    $str_datos.='<td><input type="number" name="cantidadEq" value="'. $inv['Cantidad'].'" readonly></td>';
                                    $str_datos.='<td><div class="row form-group">
                                                <div class="col-sm-12">
                                                <button type="submit" class="btn btn-info" name="comprarEquipo" value="Comprar Equipo">Comprar Equipo</button>                                
                                                <a href="singleEquipo.php?ce='.$inv['Id'].'" class="btn btn-info" name="verEquipo" value="Ver Equipo">Ver Equipo</a>                                
                                                </div>
                                                </div></td>';
                                $str_datos.='</tr>';
                                $str_datos.='</form>';

                                echo $str_datos;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <br>
            <a href="indexAdministrador.php" class="btn btn-info">Regresar</a>
        </div>
    </body>
</html>