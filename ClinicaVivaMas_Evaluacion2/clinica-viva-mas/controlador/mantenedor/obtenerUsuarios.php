<?php

echo json_encode(getUsuarios());

function getUsuarios() {
    $host = "localhost";
    $user = "admin";
    $password = "sa123";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "  SELECT  usu.email,
                        usu.nombre,
                        rol.tipo_usuario
                FROM    usuario usu,
                        rel_usuario_rolusuario rur,
                        rol_usuario rol
                WHERE   usu.email = rur.email
                AND     rur.id_tipo_usuario = rol.id_tipo_usuario";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }   
    
    $usuarios = array();

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_result($email,$nombre,$tipousuario);
    
    $resultado = $stmt->execute();

   
    if($resultado != false) {        
        while( $stmt->fetch() ){ 
            array_push($usuarios, Array("email"=>$email,
                                        "nombre"=>$nombre,
                                        "tipousuario"=>$tipousuario));
        } 
    }
    
    return $usuarios;
}
