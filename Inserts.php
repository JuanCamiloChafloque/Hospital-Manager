<?php
include_once dirname(__FILE__) . '../../config.php';
$con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);

if (CRYPT_SHA512 == 1){
    $hash1 = crypt('juanm', 'saltMeloParaPasswords');
    $hash2 = crypt('danielam', 'saltMeloParaPasswords');
}else{
    echo "SHA-512 no esta soportado.";
}

$sql = "INSERT INTO Personas (Cedula, Nombre, Apellido, Email) VALUES (12345, 'Juan D', 'Vera P', 'juanm@gmail.com');
        INSERT INTO Usuarios (NombreUsuario, Rol, Contrasena, Cedula) VALUES ('juanm', 'medico', \"$hash1\", 12345);

        INSERT INTO Personas (Cedula, Nombre, Apellido, Email) VALUES (67890, 'Daniela A', 'Vera P', 'danielam@gmail.com');
        INSERT INTO Usuarios (NombreUsuario, Rol, Contrasena, Cedula) VALUES ('danielam', 'medico', \"$hash2\", 67890);
        
        INSERT INTO Habitaciones (Numero) VALUES (901);
        INSERT INTO Habitaciones (Numero) VALUES (902);

        INSERT INTO Camas (Estado, Habitacion) VALUES ('Disponible', 1);
        INSERT INTO Camas (Estado, Habitacion) VALUES ('Disponible', 1);
        INSERT INTO Camas (Estado, Habitacion) VALUES ('Disponible', 2);
        INSERT INTO Camas (Estado, Habitacion) VALUES ('Disponible', 2);
        INSERT INTO Camas (Estado, Habitacion) VALUES ('Disponible', 1);
        INSERT INTO Camas (Estado, Habitacion) VALUES ('Disponible', 2);
        
        INSERT INTO Pacientes (Nombre, Apellido, Cedula, Duracion, Diagnostico, FechaIngreso, Prioridad, Medico, Cama) VALUES ('Juanito', 'Camachutra', 12345, 3, 'Se va a morir', '2020/6/1', 3, 2, 1);
        UPDATE Camas SET Estado = 'Ocupado' WHERE Id = 1;
        INSERT INTO Pacientes (Nombre, Apellido, Cedula, Duracion, Diagnostico, FechaIngreso, Prioridad, Medico, Cama) VALUES ('JuCami', 'Deschaflo', 13579, 5, 'Tiene Sida', '2020/6/2', 2, 2, 2);
        UPDATE Camas SET Estado = 'Ocupado' WHERE Id = 2;
        INSERT INTO Pacientes (Nombre, Apellido, Cedula, Duracion, Diagnostico, FechaIngreso, Prioridad, Medico, Cama) VALUES ('Juliancho', 'Stop', 24680, 7, 'Tiene cancer', '2020/6/3', 1, 2, 3);
        UPDATE Camas SET Estado = 'Ocupado' WHERE Id = 3;

        INSERT INTO Pacientes (Nombre, Apellido, Cedula, Duracion, Diagnostico, FechaIngreso, Prioridad, Medico, Cama) VALUES ('Rien', 'Sptm', 67890, 9, 'Coronaviros is real', '2020/6/4', 2, 3, 4);
        UPDATE Camas SET Estado = 'Ocupado' WHERE Id = 4;

        INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES ('Mascarillas', 10, 'Enseres');
        INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES ('Suero', 5, 'Enseres');
        INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES ('Anestesia', 3, 'Enseres');

        INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES ('Ventiladores', 15, 'Equipo');
        INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES ('Máquinas de Resonancia', 5, 'Equipo');
        INSERT INTO Inventario (Nombre, Cantidad, Tipo) VALUES ('Máquinas de Ecografía', 7, 'Equipo');

        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (1,1);
        UPDATE Inventario SET Cantidad = 9 WHERE Id = 1;
        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (1,2);
        UPDATE Inventario SET Cantidad = 4 WHERE Id = 2;
        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (1,3);
        UPDATE Inventario SET Cantidad = 2 WHERE Id = 3;
        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (1,4);
        UPDATE Inventario SET Cantidad = 14 WHERE Id = 4;
        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (1,5);
        UPDATE Inventario SET Cantidad = 4 WHERE Id = 5;
        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (1,6);
        UPDATE Inventario SET Cantidad = 6 WHERE Id = 6;

        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (2,1);
        UPDATE Inventario SET Cantidad = 8 WHERE Id = 1;
        INSERT INTO PacientesXInventario (Paciente, Item) VALUES (2,4);
        UPDATE Inventario SET Cantidad = 13 WHERE Id = 4;

        INSERT INTO Solicitudes (IdSolicitud, Paciente, Medico, FechaSolicitud, Suministro, Cantidad, Estado) VALUES (10, 1, 2, '2020/6/4 22:34:00', 1, 3, 'No aprovado');
        INSERT INTO Solicitudes (IdSolicitud, Paciente, Medico, FechaSolicitud, Suministro, Cantidad, Estado) VALUES (10, 1, 2, '2020/6/4 23:54:00', 2, 1, 'No aprovado');
        INSERT INTO Solicitudes (IdSolicitud, Paciente, Medico, FechaSolicitud, Suministro, Cantidad, Estado) VALUES (10, 1, 2, '2020/6/4 18:14:00', 3, 1, 'No aprovado');
        INSERT INTO Solicitudes (IdSolicitud, Paciente, Medico, FechaSolicitud, Suministro, Cantidad, Estado) VALUES (11, 4, 3, '2020/6/5 6:32:00', 2, 1, 'No aprovado');

        ";
if (mysqli_multi_query($con, $sql)) {
    echo "Inserts hechos correctamente";
} else {
    echo "Error en la creacion " . mysqli_error($con);
}

?>