<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Menú Principal</title>
    </head>
    <body>
        <?php
            include_once dirname(__FILE__) . '../../config.php';
            include_once dirname(__FILE__) . '/utils.php';

            $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
            if (mysqli_connect_errno()) {
                echo "Error en la conexión: " . mysqli_connect_error();
            }

            if(isset($_POST['iniciarsesion'])){

                $usuario = $_POST['Usuario'];
                $password = $_POST['Contrasena'];

                $verify = "SELECT * FROM Usuarios WHERE NombreUsuario = \"$usuario\" ";
                $res = mysqli_query($con, $verify);
                $exists = mysqli_num_rows($res);

                if($_POST['Usuario'] != '' && $_POST['Contrasena'] != ''){
                    if($exists > 0){

                        $fila = mysqli_fetch_array($res);
                        $rol = $fila['Rol'];
                        $hashBD = $fila['Contrasena'];
                        $cedula = $fila['Cedula'];
                
                        if (hash_equals($hashBD, crypt($password, $hashBD))) {
                            
                            if($rol == "medico"){

                                echo "<h2>Sesion iniciada correctamente</h2>";
                                echo "<br>";
                                echo "<a class=\"btn btn-info\" href=\"indexMedico.php?cc=".$cedula."\">Ir al centro Medico</a>";
                
                            }else if($rol == "administrador"){

                                echo "<h2>Sesion iniciada correctamente</h2>";
                                echo "<br>";
                                echo "<a class=\"btn btn-info\" href=\"indexAdministrador.php\">Ir al centro Administrativo</a>";
                            }
                            echo '<br>';
                            echo "<a class=\"btn btn-info\" href=\"login.php\">Cerrar Sesión</a>";
                
                        } else {
                            echo "<h2>Contraseña Incorrecta</h2>";
                            echo "<br>";
                            echo "<a class=\"btn btn-info\" href=\"login.php\">Regresar</a>";
                        }
                
                    }else{
                        echo "<h2>No existe el nombre de usuario</h2>";
                        echo "<br>";
                        echo "<a class=\"btn btn-info\" href=\"login.php\">Regresar</a>";
                    }
                }else{
                    header ("Location: login.php");
                }
            }
        
            if(isset($_POST['nuevoAdmin'])){
                if($_POST['user'] != '' && $_POST['email1'] != '' && $_POST['email2'] != '' 
                    && $_POST['contrasena'] != '' && $_POST['nombre'] != '' && $_POST['apellido'] != '' 
                    && $_POST['cedula'] != ''){

                    $usuario = $_POST['user'];
                    $email1 = $_POST['email1'];
                    $email2 = $_POST['email2'];
                    $password = $_POST['contrasena'];
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $cedula = $_POST['cedula'];

                    if($email1 === $email2){
                        $verify = "SELECT * FROM Personas WHERE Cedula = \"$cedula\" ";
                        $res = mysqli_query($con, $verify);
                        $exists = mysqli_num_rows($res);

                        if($exists == 0){
                            $verify2 = "SELECT * FROM Usuarios WHERE NombreUsuario = \"$nombre\" ";
                            $res2 = mysqli_query($con, $verify2);
                            $exists2 = mysqli_num_rows($res2);

                            if($exists2 > 0){
                                echo "<h2>No se puede regitrar al Administrador, el nombre de usuario ya existe</h2>";
                            }else{
                                $rol = "administrador";

                                if (CRYPT_SHA512 == 1){
                                    $hash = crypt($password, 'saltMeloParaPasswords');
                                }else{
                                    echo "SHA-512 no esta soportado.";
                                }

                                $sql1 = "INSERT INTO Personas (Cedula, Nombre, Apellido, Email) VALUES (\"$cedula\", \"$nombre\", \"$apellido\", \"$email1\")";
                                $sql2 = "INSERT INTO Usuarios (NombreUsuario, Rol, Contrasena, Cedula) VALUES (\"$usuario\", \"$rol\", \"$hash\", \"$cedula\")";
                                
                                if(mysqli_query($con, $sql1)){
                                    if(mysqli_query($con, $sql2)){
                                        echo "<h2>Administrador registrado correctamente.</h2>";
                                        echo "<a href=\"indexAdministrador.php\" class=\"btn btn-info\">Regresar</a>";
                                    }
                                }
                            }

                        }else{
                            echo "<h2>No se puede registrar al Administrador, ya se encuentra en el sistema.</h2>";
                            echo "<br>";
                            echo "<a class=\"btn btn-info\" href=\"agregarAdmin.php\">Regresar</a>";
                        }
                    }else{
                        echo "<h2>Error, los correos electronicos no coinciden</h2>";
                        echo "<br>";
                        echo "<a class=\"btn btn-info\" href=\"agregarAdmin.php\">Regresar</a>";
                    }
                }else{
                    echo "<h2>Datos Incorrectos.</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"agregarAdmin.php\">Regresar</a>";
                }
            }

            if(isset($_POST['registrarmedico'])){

                if($_POST['user'] != '' && $_POST['email1'] != '' && $_POST['email2'] != '' 
                    && $_POST['contrasena'] != '' && $_POST['nombre'] != '' && $_POST['apellido'] != '' 
                    && $_POST['cedula'] != ''){

                    $usuario = $_POST['user'];
                    $email1 = $_POST['email1'];
                    $email2 = $_POST['email2'];
                    $password = $_POST['contrasena'];
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $cedula = $_POST['cedula'];

                    if($email1 === $email2){
                        $verify = "SELECT * FROM Personas WHERE Cedula = \"$cedula\" ";
                        $res = mysqli_query($con, $verify);
                        $exists = mysqli_num_rows($res);

                        if($exists == 0){
                            $verify2 = "SELECT * FROM Usuarios WHERE NombreUsuario = \"$nombre\" ";
                            $res2 = mysqli_query($con, $verify2);
                            $exists2 = mysqli_num_rows($res2);

                            if($exists2 > 0){
                                echo "<h2>No se puede regitrar al medico, el nombre de usuario ya existe</h2>";
                            }else{
                                $rol = "medico";

                                if (CRYPT_SHA512 == 1){
                                    $hash = crypt($password, 'saltMeloParaPasswords');
                                }else{
                                    echo "SHA-512 no esta soportado.";
                                }

                                $sql1 = "INSERT INTO Personas (Cedula, Nombre, Apellido, Email) VALUES (\"$cedula\", \"$nombre\", \"$apellido\", \"$email1\")";
                                $sql2 = "INSERT INTO Usuarios (NombreUsuario, Rol, Contrasena, Cedula) VALUES (\"$usuario\", \"$rol\", \"$hash\", \"$cedula\")";
                                
                                if(mysqli_query($con, $sql1)){
                                    if(mysqli_query($con, $sql2)){
                                        echo "<h2>Médico registrado correctamente.</h2>";
                                        echo "<a class=\"btn btn-info\" href=\"login.php\">Iniciar Sesion Nuevamente</a>";
                                    }
                                }
                            }

                        }else{
                            echo "<h2>No se puede registrar al medico, ya se encuentra en el sistema.</h2>";
                            echo "<br>";
                            echo "<a class=\"btn btn-info\" href=\"RegistroMedico.php\">Regresar</a>";
                        }
                    }else{
                        echo "<h2>Error, los correos electronicos no coinciden</h2>";
                        echo "<br>";
                        echo "<a class=\"btn btn-info\" href=\"RegistroMedico.php\">Regresar</a>";
                    }
                }else{
                    echo "<h2>Datos Incorrectos.</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"RegistroMedico.php\">Regresar</a>";

                }
            }

            if(isset($_POST['agregarHabitacion'])){

                if(isset($_POST['numeroHabitacion']) != ''){
                    $numeroHabitacion = $_POST['numeroHabitacion'];
                    $sql = "SELECT * FROM HABITACIONES WHERE NUMERO = \"$numeroHabitacion\" "; 
                    $res = mysqli_query($con, $sql);
                    $exists = mysqli_num_rows($res);

                    if($exists == 0 ){
                        $sql2 ="INSERT INTO HABITACIONES (NUMERO) VALUES (\"$numeroHabitacion\")";
                        if(mysqli_query($con, $sql2)){
                            echo '<h2>Habitación creada</h2><br>';
                            // echo '<a class=\"btn btn-info\" href="Operaciones.php>Regresar</a>"';
                            echo "<a href=\"indexAdministrador.php\" class=\"btn btn-info\">Regresar</a>";
                        }
                    }
                    else{
                        echo "<h2>No se puede crear la habitación $numeroHabitacion, ya se encuentra en el sistema.</h2>";
                        echo "<br>";
                        echo "<a class=\"btn btn-info\" href=\"agregarHabitacion.php\">Regresar</a>";
                    }
                }
                else{
                    echo "<h2>Datos Incorrectos.</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"agregarHabitacion.php\">Regresar</a>";
                }
            }

            if(isset($_POST['agregarCama'])){

                if(isset($_POST['habitacion']) != ''){
                $habitacion = $_POST['habitacion'];
                
                    $sql2 ="INSERT INTO CAMAS (HABITACION, Estado) VALUES (\"$habitacion\", 'Disponible')";
                    if(mysqli_query($con, $sql2)){
                        echo "<h2>Cama agregada a la habitación</h2><br>";
                        // echo '<a class=\"btn btn-info\" href="Operaciones.php">Regresar</a>';
                        echo "<a href=\"indexAdministrador.php\" class=\"btn btn-info\">Regresar</a>";
                    }
                }
                else{
                echo "<h2>Datos Incorrectos.</h2>";
                echo "<br>";
                echo "<a class=\"btn btn-info\" href=\"agregarCama.php\">Regresar</a>";
                }
                
            }

            if(isset($_GET['idPaciente']) && isset($_GET['idInventario']) && isset($_GET['idMed'])){
                
                $idPaciente = $_GET['idPaciente'];
                $idInventario = $_GET['idInventario'];
                $idmed = $_GET['idMed'];

                $sqlDelete = "DELETE FROM PacientesXInventario WHERE Paciente = \"$idPaciente\" AND Item = \"$idInventario\";
                UPDATE Inventario set Cantidad = Cantidad + 1 where Id =\"$idInventario\"";

                if (mysqli_multi_query($con, $sqlDelete)) {
                    echo "<h2>Equipo Eliminado correctamente.</h2>";
                    echo "<br>";
                    echo '<a class="btn btn-info" href=\'singlePaciente.php?cc='.$idPaciente.'&ccm='.$idmed.'\'>'. 'Regresar' . '</a>';
                } 
                else {
                    echo "Error al borrar el equipo" . mysqli_error($con);
                }
            }

            if(isset($_POST['asignarPaciente'])){
                $cedulaPaciente = $_POST['cedulaPaciente'];
                $nombrePaciente = $_POST['nombrePaciente'];
                $apellidoPaciente = $_POST['apellidoPaciente'];
                $diagnosticoPaciente = $_POST['diagnosticoPaciente'];
                $prioridadPaciente = $_POST['prioridadPaciente'];
                $fechaPaciente = date('Y-m-d',strtotime($_POST['fechaPaciente']));
                $duracionPaciente = $_POST['duracionPaciente'];
                $idCamaPaciente = $_POST['idCamaPaciente'];
                $idMedicoPaciente = $_POST['idMedicoPaciente'];

                $sqlInsertPaciente = "INSERT INTO PACIENTES
                (Nombre,
                Apellido,
                Cedula,
                Duracion,
                Diagnostico,
                FechaIngreso,
                Prioridad,
                Medico,
                Cama)
                Values (\"$nombrePaciente\",
                \"$apellidoPaciente\",
                \"$cedulaPaciente\",
                \"$duracionPaciente\",
                \"$diagnosticoPaciente\",
                \"$fechaPaciente\",
                \"$prioridadPaciente\",
                \"$idMedicoPaciente\",
                \"$idCamaPaciente\");
                UPDATE CAMAS SET Estado = \"Ocupado\" WHERE ID = \"$idCamaPaciente\";";

                $sqlmed = "SELECT * FROM usuarios WHERE Id = \"$idMedicoPaciente\"";
                $resmed = mysqli_query($con,$sqlmed);
                $filamed = mysqli_fetch_array($resmed);
                $cedulam = $filamed['Cedula'];

                if (mysqli_multi_query($con, $sqlInsertPaciente)) {
                    echo "<h2>Paciente Asignado</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"indexMedico.php?cc=".$cedulam."\">Ir al centro Medico</a>";
                } 
                else {
                    echo "Error al Asignar el paciente" . mysqli_error($con);
                }
            }

            if(isset($_POST['agregarRecursoPaciente'])){

                $nrecurso = $_POST['recurso'];
                $crecurso = $_POST['cantidadRe'];
                $idp = $_POST['idpac'];
                $idmed = $_POST['idmed'];
                $fyh = $_POST['fyh'];

                $sqlPaciente = "SELECT * FROM PACIENTES WHERE Idp = \"$idp\"";
                $resPaciente = mysqli_query($con,$sqlPaciente);
                $filaPaciente = mysqli_fetch_array($resPaciente);
                $cedulap = $filaPaciente['Cedula'];

                $sqlSuministro = "SELECT * FROM Inventario WHERE Nombre = \"$nrecurso\"";
                $resSuministro = mysqli_query($con,$sqlSuministro);
                $filaSuministro = mysqli_fetch_array($resSuministro);
                $idsum = $filaSuministro['Id'];

                // echo ' '.$cedulap.' '.$idp.' '.$idmed.' '.$fyh.' '.$idsum.' '.$crecurso;

                $sqlSolicitud = "INSERT INTO Solicitudes (IdSolicitud, Paciente, Medico, FechaSolicitud, Suministro, Cantidad, Estado)
                                VALUES (\"$cedulap\", \"$idp\", \"$idmed\", \"$fyh\", \"$idsum\", \"$crecurso\", 'No aprobado')";

                if (mysqli_query($con, $sqlSolicitud)) {
                    echo "<h2>Recurso agregado a la solicitud</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"agregarRecursos.php?cc=".$idp."&ccm=".$idmed."\">Regresar y agregar mas recursos</a>";
                } 
                else {
                    echo "Error al Asignar el paciente" . mysqli_error($con);
                }
            }

            if(isset($_POST['registrarEquipo'])){

                $idMedico = $_POST['idMedico'];
                $idPaciente = $_POST['idPaciente'];
                $fechaSolicitud = $_POST['fechaSolicitud'];
                $equipos = $_POST['equipos'];

                $sqlPaciente = "SELECT * FROM Pacientes WHERE Idp = \"$idPaciente\" "; 
                $resPaciente = mysqli_query($con, $sqlPaciente);
                $fila = mysqli_fetch_array($resPaciente);
                $prioridad = $fila['Prioridad'];
                $cedula = $fila['Cedula'];

                $verify2 ="SELECT * FROM PacientesXInventario WHERE Paciente = \"$idPaciente\" AND Item = \"$equipos\" ";
                $res2 = mysqli_query($con, $verify2);
                $exists = mysqli_fetch_array($res2);

                if($exists == 0) {

                    $verify3 ="SELECT * FROM PacientesXInventario WHERE Paciente = \"$idPaciente\" ";
                    $res3 = mysqli_query($con, $verify3);
                    $exists = mysqli_fetch_array($res3);
                    if($exists <= $prioridad){
                        $sql ="INSERT INTO Solicitudes (IdSolicitud, Paciente, Medico, FechaSolicitud, Suministro, Cantidad, Estado)
                               VALUES (\"$cedula\", \"$idPaciente\", \"$idMedico\", \"$fechaSolicitud\", \"$equipos\", 1, 'No aprobado')";
                        if(mysqli_query($con, $sql)){
                            echo "<h2>Equipo agregado a la solicitud</h2><br>";
                            echo '<a class=\"btn btn-info\" href="Operaciones.php>Regresar</a>"';
                        }
                    } else {
                        echo "<h2>El usuario ya cuenta con el máximo número de equipos según su prioridad.</h2>";
                        echo "<br>";
                    }
                } else {
                    echo "<h2>El usuario ya cuenta con el equipo solicitado.</h2>";
                    echo "<br>";
                }
                
            }

            if(isset($_POST['comprarRecurso'])){
                $nameR = $_POST['recurso'];

                $sqlcompra = "UPDATE Inventario SET Cantidad =  Cantidad + 1 WHERE Nombre = \"$nameR\"";
                
                if (mysqli_query($con, $sqlcompra)) {
                    echo "<h2>Recurso comprado correctamente</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"administrarRecursos.php\">Regresar a administrar los recursos</a>";
                } 
                else {
                    echo "Error al comprar el recurso" . mysqli_error($con);
                }

            }

            if(isset($_POST['nuevoRecurso'])){
                $nombren = $_POST['name'];
                $cantidadn = $_POST['cantidadcompra'];

                $sqlcompra = "INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES (\"$nombren\", \"$cantidadn\", 'Enseres')";
                
                if (mysqli_query($con, $sqlcompra)) {
                    echo "<h2>Recurso nuevo comprado correctamente</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"administrarRecursos.php\">Regresar a administrar los recursos</a>";
                } 
                else {
                    echo "Error al ingresar el recurso" . mysqli_error($con);
                }
            }

            if(isset($_POST['comprarEquipo'])){
                $nameEq = $_POST['equipo'];

                $sqlcompra = "UPDATE Inventario SET Cantidad =  Cantidad + 1 WHERE Nombre = \"$nameEq\"";
                
                if (mysqli_query($con, $sqlcompra)) {
                    echo "<h2>Equipo comprado correctamente</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"administrarEquipos.php\">Regresar a administrar los equipos</a>";
                } 
                else {
                    echo "Error al comprar el equipo" . mysqli_error($con);
                }
            }

            if(isset($_POST['nuevoEquipo'])){
                $nombren = $_POST['name'];
                $cantidadn = $_POST['cantidadcompra'];

                $sqlcompra = "INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES (\"$nombren\", \"$cantidadn\", 'Equipo')";
                
                if (mysqli_query($con, $sqlcompra)) {
                    echo "<h2>Equipo nuevo comprado correctamente</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"administrarEquipos.php\">Regresar a administrar los equipos</a>";
                } 
                else {
                    echo "Error al ingresar el equipo" . mysqli_error($con);
                }
            }

            if(isset($_GET['idCambiar']) && isset($_GET['idEquipo']) && isset($_GET['idNuevo'])){
                
                $idAntiguo = $_GET['idCambiar'];
                $idNuevo = $_GET['idNuevo'];
                $idEquipo = $_GET['idEquipo'];

                $sqlAntiguo = "SELECT * FROM PACIENTES WHERE Idp = \"$idAntiguo\"";
                $resAntiguo = mysqli_query($con, $sqlAntiguo);
                $filaAntiguo = mysqli_fetch_array($resAntiguo);
                $prioridadAntiguo = $filaAntiguo['Prioridad'];

                $sqlNuevo = "SELECT * FROM PACIENTES WHERE Idp = \"$idNuevo\"";
                $resNuevo = mysqli_query($con, $sqlNuevo);
                $filaNuevo = mysqli_fetch_array($resNuevo);
                $prioridadNuevo = $filaNuevo['Prioridad'];

                $verify = "SELECT * FROM PacientesXInventario WHERE Paciente = \"$idNuevo\" AND Item = \"$idEquipo\" ";
                $res = mysqli_query($con, $verify);
                $exists = mysqli_num_rows($res);
                if($exists == 0){
                    if($prioridadNuevo > $prioridadAntiguo){
                        $verify2 ="SELECT * FROM PacientesXInventario WHERE Paciente = \"$idNuevo\" ";
                        $res2 = mysqli_query($con, $verify2);
                        $exists2 = mysqli_fetch_array($res2);
                        if($exists2 <= $prioridadNuevo){
                            $sql = "UPDATE PacientesXInventario SET Paciente = \"$idNuevo\" WHERE Paciente = \"$idAntiguo\" AND Item = \"$idEquipo\" ";
                            if (mysqli_query($con, $sql)){
                                echo "<h2>Se realizó el intercambio con exito</h2>";
                                echo "<br>";
                                echo "<a class=\"btn btn-info\" href=\"administrarEquipos.php\">Regresar</a>";
                            } else {
                                echo "<h2>Error realizando el intercambio</h2>";
                                echo "<br>";
                                echo "<a class=\"btn btn-info\" href=\"cambiarPaciente.php?idCambiar=".$idAntiguo."&idEquipo=".$idEquipo."\">Regresar</a>";
                            }
                        } else {
                            echo "<h2>No se puede hacer el intercambio. El paciente a intercambiar ya tiene el máximo número de equipos a asignar según su prioridad</h2>";
                            echo "<br>";
                            echo "<a class=\"btn btn-info\" href=\"cambiarPaciente.php?idCambiar=".$idAntiguo."&idEquipo=".$idEquipo."\">Regresar</a>";

                        }
                    } else {
                        echo "<h2>No se puede hacer el intercambio. El paciente a intercambiar tiene menos prioridad que el antiguo</h2>";
                        echo "<br>";
                        echo "<a class=\"btn btn-info\" href=\"cambiarPaciente.php?idCambiar=".$idAntiguo."&idEquipo=".$idEquipo."\">Regresar</a>";

                    }
                } else {
                    echo "<h2>No se puede hacer el intercambio. El paciente a intercambiar ya tiene el mismo equipo asignado</h2>";
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"cambiarPaciente.php?idCambiar=".$idAntiguo."&idEquipo=".$idEquipo."\">Regresar</a>";

                }
            }

            if(isset($_GET['rechazarSol'])){

                $idSol = $_GET['idSolicitud'];
                $nombreI = $_GET['suministro'];

                $sqlInventario = "SELECT * FROM Inventario WHERE Nombre = \"$nombreI\"";
                $resInventario = mysqli_query($con,$sqlInventario);
                $filaInventario = mysqli_fetch_array($resInventario);

                $idI = $filaInventario['Id'];

                $sqlSolicitud = "SELECT * FROM SOLICITUDES WHERE IdSolicitud = \"$idSol\" AND Suministro =\"$idI\" ";
                $resSolicitud = mysqli_query($con,$sqlSolicitud);
                $filaSolicitud = mysqli_fetch_array($resSolicitud);

                $idP = $filaSolicitud['Paciente'];
                $idM = $filaSolicitud['Medico'];

                $sqlPaciente = "SELECT * FROM Pacientes WHERE Idp = \"$idP\"";
                $resPaciente = mysqli_query($con,$sqlPaciente);
                $filaPaciente = mysqli_fetch_array($resPaciente);

                $nombrePaciente = $filaPaciente['Nombre'];

                $sqlMedico = "SELECT * FROM USUARIOS INNER JOIN PERSONAS ON USUARIOS.Cedula = PERSONAS.Cedula WHERE USUARIOS.Id = \"$idM\" ";
                $resMedico = mysqli_query($con,$sqlMedico);
                $filaMedico = mysqli_fetch_array($resMedico);

                $sqlDelete = "DELETE FROM Solicitudes WHERE IdSolicitud = \"$idSol\" AND Suministro = \"$idI\" ";

                if (mysqli_query($con, $sqlDelete)) {
                    $str = "Buenos dias estimado, la solicitud para el paciente ".$nombrePaciente." pidiendo el suministro ".$nombreI." ha sido rechazada. ";
                    echo "<h2>Solicitud rechazada. Se ha enviado un correo al médico</h2>";
                    sendemail("juancamachoc97@gmail.com", "Juan", "Camacho", "Solicitud rechazada", $str);
                    echo "<br>";
                    echo "<a class=\"btn btn-info\" href=\"singleSolicitud.php?idS=".$idSol."\">Regresar a la solicitud</a>";
                } 
                else {
                    echo "Error al ingresar el equipo" . mysqli_error($con);
                }
            }

            if(isset($_GET['aprobarSol'])){

                $idSol = $_GET['idSolicitud'];
                $nombreI = $_GET['suministro'];

                $sqlInventario = "SELECT * FROM Inventario WHERE Nombre = \"$nombreI\"";
                $resInventario = mysqli_query($con,$sqlInventario);
                $filaInventario = mysqli_fetch_array($resInventario);

                $idI = $filaInventario['Id'];
                $disponible = $filaInventario['Cantidad'];

                $sqlSolicitud = "SELECT * FROM SOLICITUDES WHERE IdSolicitud = \"$idSol\" AND Suministro =\"$idI\" ";
                $resSolicitud = mysqli_query($con,$sqlSolicitud);
                $filaSolicitud = mysqli_fetch_array($resSolicitud);

                $idM = $filaSolicitud['Medico'];
                $idP = $filaSolicitud['Paciente'];
                $cantidad = $filaSolicitud['Cantidad'];

                $sqlPaciente = "SELECT * FROM Pacientes WHERE Idp = \"$idP\"";
                $resPaciente = mysqli_query($con,$sqlPaciente);
                $filaPaciente = mysqli_fetch_array($resPaciente);

                $nombrePaciente = $filaPaciente['Nombre'];

                $sqlMedico = "SELECT * FROM USUARIOS INNER JOIN PERSONAS ON USUARIOS.Cedula = PERSONAS.Cedula WHERE USUARIOS.Id = \"$idM\" ";
                $resMedico = mysqli_query($con,$sqlMedico);
                $filaMedico = mysqli_fetch_array($resMedico);

                if($cantidad <= $disponible){

                    $sqlAprobar = "DELETE FROM Solicitudes WHERE IdSolicitud = \"$idSol\" AND Suministro = \"$idI\";
                                   INSERT INTO PacientesXInventario (Paciente, Item) VALUES (\"$idP\", \"$idI\");
                                   UPDATE Inventario SET Cantidad = Cantidad - $cantidad WHERE Id = \"$idI\"";

                    if (mysqli_multi_query($con, $sqlAprobar)) {
                        $str = "Buenos dias estimado, la solicitud para el paciente ".$nombrePaciente." pidiendo el suministro ".$nombreI." ha sido aprobada. ";
                        echo "<h2>Solicitud Aprobada. Se ha enviado un correo al médico</h2>";
                        sendemail("juancamachoc97@gmail.com", "Juan", "Camacho", "Solicitud aprobada", $str);
                        echo "<br>";
                        echo "<a class=\"btn btn-info\" href=\"singleSolicitud.php?idS=".$idSol."\">Regresar a la solicitud</a>";
                    } 
                    else {
                        echo "Error al ingresar el equipo" . mysqli_error($con);
                    }
                } else {
                    echo "<h2>Solicitud rechazada. La cantidad a pedir no se encuentra disponible.</h2>";
                        echo "<br>";
                        echo "<a class=\"btn btn-info\" href=\"singleSolicitud.php?idS=".$idSol."\">Regresar a la solicitud</a>";
                }
            }
        ?>
    </body>
</html>