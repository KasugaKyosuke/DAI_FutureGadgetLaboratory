<?php

echo json_encode(getEspecialidades());


function getEspecialidades() {
    $host = "localhost";
    $user = "dbavivamas";
    $password = "a1s2d3";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "SELECT e.id, e.nombre 
              FROM especialidad e";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }   
    
    $especialidades = array();

    $db->set_charset("utf8");
    $resultado = $db->query($query);

    if($resultado != false) {        
        while( $row = $resultado->fetch_assoc() ){ 
            array_push($especialidades, array("nombre"=>$row['nombre'], "id"=>$row['id']));
        } 
    }
    
    return $especialidades;
}