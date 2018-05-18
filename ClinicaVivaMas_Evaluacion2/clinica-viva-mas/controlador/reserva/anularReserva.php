<?php

if(isset($_POST['idPaciente']) && isset($_POST['idProfesional']) && isset($_POST['fecha'])) {
    echo anularReserva($_POST['idPaciente'],$_POST['idProfesional'], $_POST['fecha']);
}

function anularReserva($idPaciente, $idProfesional, $fecha) {
    $host = "localhost";
    $user = "dbavivamas";
    $password = "a1s2d3";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "DELETE FROM reserva WHERE id_profesional = ? AND id_paciente = ? and fecha = ?";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }       

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_param("iis", $idProfesional, $idPaciente, $fecha);

    $resultado = $stmt->execute();
    
    if($resultado != false) {        
        return "La reserva ha sido anulada exitosamente";
    } else {
        return "No fue posible anular la reserva";
    }   
}