<?php

if(isset($_GET['idPaciente'])) {
    echo json_encode(getReservas($_GET['idPaciente']));
}

function getReservas($idPaciente) {
    $host = "localhost";
    $user = "dbavivamas";
    $password = "a1s2d3";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "SELECT r.id_paciente, 
                     e.nombre as especialidad, 
                     c.nombre as centromedico, 
                     p.nombres as nombre_profesional, 
                     p.apellidos as apellido_profesional, 
                     r.fecha, 
                     h.hora,
                     r.id_profesional
              FROM especialidad e, 
                   centromedico c,
                   profesional p, 
                   horario h, 
                   reserva r 
              WHERE r.id_profesional = p.id AND 
                    p.id_especialidad = e.id AND 
                    p.id_centromedico = c.id AND 
                    r.hora = h.id and r.id_paciente = ?";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }   
    
    $reservas = array();

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $idPaciente);
    $stmt->bind_result($id_paciente,$especialidad,$centromedico,$apellido_profesional,$nombre_profesional,$fecha, $hora, $id_profesional);
    
    $resultado = $stmt->execute();

   
    if($resultado != false) {        
        while( $stmt->fetch() ){ 
            array_push($reservas, Array("paciente"=>$id_paciente,
                                        "especialidad"=>$especialidad,
                                        "centromedico"=>$centromedico,
                                        "profesional"=>$apellido_profesional.", ".$nombre_profesional,
                                        "fecha"=>$fecha,
                                        "hora"=>$hora,
                                        "id_profesional"=>$id_profesional));
        } 
    }
    
    return $reservas;
}