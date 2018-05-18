<?php

if(isset($_GET['codigoEspecialidad']) && isset($_GET['codigoCentroMedico'])) {
    echo json_encode(getProfesionales($_GET['codigoEspecialidad'], $_GET['codigoCentroMedico']));
}

function getProfesionales($codigoEspecialidad, $codigoCentroMedico) {
    $host = "localhost";
    $user = "dbavivamas";
    $password = "a1s2d3";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "SELECT p.id, p.nombres, p.apellidos
              FROM profesional p 
              WHERE p.id_centromedico = ? AND p.id_especialidad = ?";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }   
    
    $profesionales = array();

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii",$codigoCentroMedico,$codigoEspecialidad);    

    $stmt->bind_result($id, $nombres, $apellidos);
    
    $resultado = $stmt->execute();
            
    if($resultado != false) {        
        while($stmt->fetch()){ 
            array_push($profesionales, array("nombre"=>$apellidos.', '.$nombres,"id"=>$id));
        } 
    }
    
    return $profesionales;
}