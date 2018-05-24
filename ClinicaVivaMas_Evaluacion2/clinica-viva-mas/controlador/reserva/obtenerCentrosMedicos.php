<?php

if(isset($_GET['codigoEspecialidad'])) {
    echo json_encode(getCentrosMedicos($_GET['codigoEspecialidad']));
}

function getCentrosMedicos($codigoEspecialidad) {
    $host = "localhost";
    $user = "admin";
    $password = "sa123";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "SELECT c.id, c.nombre 
              FROM centromedico c, especialidad_centromedico ec 
              WHERE ec.id_centromedico = c.id AND ec.id_especialidad = ?";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }   
    
    $centrosMedicos = array();

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $codigoEspecialidad);
    $stmt->bind_result($id, $nombre);
    
    $resultado = $stmt->execute();

    if($resultado != false) {        
        while($stmt->fetch() ){ 
            array_push($centrosMedicos, array("nombre"=>$nombre, "id"=>$id));
        } 
    }
    
    return $centrosMedicos;
}