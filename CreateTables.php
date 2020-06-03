<?php
    include_once dirname(__FILE__) . '../../config.php';
    $con = mysqli_connect(HOST_DB, USUARIO_DB, USUARIO_PASS, NOMBRE_DB);
    $sql = "CREATE TABLE Personas 
    (
        Cedula INT NOT NULL,
        PRIMARY KEY(Cedula),
        Nombre CHAR(25),
        Apellido CHAR(25),
        Email CHAR(50) NOT NULL
    )";
    if (mysqli_query($con, $sql)) {
        echo "Tabla Personas creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";

    $cedula = "1010105825";
    $nombre = "Pepito";
    $apellido = "Perez";
    $email = "prowe202010@gmail.com";

    $sqlu = "INSERT INTO Personas (Cedula, Nombre, Apellido, Email) VALUES (\"$cedula\", \"$nombre\", \"$apellido\", \"$email\")";
    
    if(mysqli_query($con, $sqlu)){

        echo "PersonaAdministradora creado correctamente.";
    }

    echo "<br>";

    $sql2 = "CREATE TABLE Usuarios 
    (
        Id  int AUTO_INCREMENT,
        PRIMARY KEY(Id),
        NombreUsuario VARCHAR(255) NOT NULL,
        Rol VARCHAR(255) NOT NULL,
        Contrasena VARCHAR(255) NOT NULL,
        Cedula INT NOT NULL,
        FOREIGN KEY (Cedula) references Personas (Cedula)
    )";
    if (mysqli_query($con, $sql2)) {
        echo "Tabla Usuarios creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";

    $password = "admin202010";
    $user = "admin";
    $rol = "administrador";

    if (CRYPT_SHA512 == 1){
        $hash = crypt($password, 'saltMeloParaPasswords');
    }else{
        echo "SHA-512 no esta soportado.";
    }

    $sql = "INSERT INTO Usuarios (NombreUsuario, Rol, Contrasena, Cedula) VALUES (\"$user\", \"$rol\", \"$hash\", \"$cedula\")";
    
    if(mysqli_query($con, $sql)){

        echo "Usuario creado correctamente.";
    }

    echo "<br>";

    $sql3 = "CREATE TABLE Habitaciones 
    (
        Id  int AUTO_INCREMENT,
        PRIMARY KEY(Id),
        Numero INT NOT NULL
    )";
    if (mysqli_query($con, $sql3)) {
        echo "Tabla Habitaciones creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";

    $sql4 = "CREATE TABLE Camas 
    (
        Id  int AUTO_INCREMENT,
        PRIMARY KEY(Id),
        Estado VARCHAR(25),
        Habitacion INT NOT NULL,
        FOREIGN KEY (Habitacion) references Habitaciones (Id)
    )";
    if (mysqli_query($con, $sql4)) {
        echo "Tabla Camas creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";

    $sql5 = "CREATE TABLE Pacientes 
    (
        Idp  int AUTO_INCREMENT,
        PRIMARY KEY(Idp),
        Nombre CHAR(25),
        Apellido CHAR(25),
        Cedula INT NOT NULL,
        Duracion INT NOT NULL,
        Diagnostico VARCHAR(255), 
        FechaIngreso DATE NOT NULL,
        Prioridad int,
        Medico INT NOT NULL,
        FOREIGN KEY (Medico) references Usuarios (Id),
        Cama INT NOT NULL,
        FOREIGN KEY (Cama) references Camas (Id)
    )";
    if (mysqli_query($con, $sql5)) {
        echo "Tabla Pacientes creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";

    $sql6 = "CREATE TABLE Inventario 
    (
        Id  int AUTO_INCREMENT,
        PRIMARY KEY(Id),
        Nombre CHAR(60),
        Cantidad INT NOT NULL,
        Tipo VARCHAR(255)
    )";
    if (mysqli_query($con, $sql6)) {
        echo "Tabla Inventario creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";

    $sql7 = "CREATE TABLE PacientesXInventario 
    (
        Id  int AUTO_INCREMENT,
        PRIMARY KEY(Id),
        Paciente INT NOT NULL,
        FOREIGN KEY (Paciente) references Pacientes (Idp),
        Item INT NOT NULL,
        FOREIGN KEY (Item) references Inventario (Id)
    )";
    if (mysqli_query($con, $sql7)) {
        echo "Tabla PacientesXInventario creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";

    $sql8 = "CREATE TABLE Solicitudes
    (
        IdSolicitud  INT NOT NULL,
        Paciente INT NOT NULL,
        FOREIGN KEY (Paciente) references Pacientes (Idp),
        Medico INT NOT NULL,
        FOREIGN KEY (Medico) references Usuarios (Id),
        FechaSolicitud DATETIME,
        Suministro INT NOT NULL,
        FOREIGN KEY (Suministro) references Inventario (Id),
        Cantidad INT NOT NULL,
        Estado Char(25)

    )";
    if (mysqli_query($con, $sql8)) {
        echo "Tabla Solicitudes creada correctamente";
    } else {
        echo "Error en la creacion " . mysqli_error($con);
    }

    echo "<br>";
?>