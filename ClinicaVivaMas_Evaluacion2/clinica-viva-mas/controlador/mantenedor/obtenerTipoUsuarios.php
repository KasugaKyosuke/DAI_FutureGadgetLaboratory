<?php

echo json_encode(getTipoUsuarios());

function getTipoUsuarios() {
    $host = "localhost";
    $user = "admin";
    $password = "sa123";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "SELECT rol.id_tipo_usuario, rol.tipo_usuario
          FROM rol_usuario rol";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }   
    
    $tipousuarios = array();

    $db->set_charset("utf8");
    $resultado = $db->query($query);

    if($resultado != false) {        
        while( $row = $resultado->fetch_assoc() ){ 
            array_push($tipousuarios, array("tipousuario"=>$row['tipo_usuario'], "id"=>$row['id_tipo_usuario']));
        } 
    }
    
    return $tipousuarios;
}

