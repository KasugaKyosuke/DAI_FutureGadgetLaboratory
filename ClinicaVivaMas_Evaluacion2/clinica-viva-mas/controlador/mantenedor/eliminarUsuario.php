<?php

if(isset($_POST['email'])) {
    echo eliminarUsuario($_POST['email']);
}

function eliminarUsuario($email) {
    $host = "localhost";
    $user = "admin";
    $password = "sa123";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "DELETE FROM rel_usuario_rolusuario WHERE email = ?";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }       

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);

    $resultado = $stmt->execute();
    
    if($resultado != false) {        
        
        $query = "DELETE FROM usuario WHERE email = ?";
    
        $db = new mysqli($host, $user, $password, $database, $port);

        if($db->errno) {
            echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
            exit;
        }       

        $db->set_charset("utf8");
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $email);

        $resultado = $stmt->execute();
        if($resultado != false) {
            return "El usuario ha sido eliminado exitosamente";
        } else {
            return "No fue posible eliminar al usuario";
        }
    } else {
        return "No fue posible eliminar al usuario";
    }   
}