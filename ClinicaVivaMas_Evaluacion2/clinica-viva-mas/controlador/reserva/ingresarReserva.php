<?php

if(isset($_POST['idPaciente']) && isset($_POST['idProfesional']) && isset($_POST['fecha']) && isset($_POST['hora'])) {
    echo ingresarReserva($_POST['idPaciente'],$_POST['idProfesional'], $_POST['fecha'], $_POST['hora']);
}

function ingresarReserva($idPaciente, $idProfesional, $fecha, $hora) {
    $host = "localhost";
    $user = "dbavivamas";
    $password = "a1s2d3";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "INSERT INTO reserva (id_paciente, id_profesional, fecha, hora) VALUES(?, ?, ?, ?)";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }       

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_param("iisi", $idPaciente, $idProfesional, $fecha, $hora);

    $resultado = $stmt->execute();
    
    if($resultado != false) {        
        return "La reserva ha sido ingresada exitosamente";
    } else {
        return "No fue posible ingresar la reserva";
    }   
}