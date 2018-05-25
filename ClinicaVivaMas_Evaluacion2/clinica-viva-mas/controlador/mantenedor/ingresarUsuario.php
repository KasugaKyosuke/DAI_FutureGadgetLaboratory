<?php

if(isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['pass']) && isset($_POST['idtipousuario'])) {
    echo ingresarUsuario($_POST['email'],$_POST['nombre'], $_POST['pass'], $_POST['idtipousuario']);
}

function ingresarUsuario($email, $nombre, $pass, $idtipousuario) {
    $host = "localhost";
    $user = "admin";
    $password = "sa123";
    $database = "clinicavivamas";
    $port = 3306;           

    $query = "INSERT INTO usuario (email, clave, nombre) VALUES(?, PASSWORD(?), ?)";
    
    $db = new mysqli($host, $user, $password, $database, $port);

    if($db->errno) {
        echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
        exit;
    }       

    $db->set_charset("utf8");
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $email, $pass, $nombre);

    $resultado = $stmt->execute();
    
    if($resultado != false) {
        
        $query = "INSERT INTO rel_usuario_rolusuario (email, id_tipo_usuario) VALUES(?, ?)";

        $db = new mysqli($host, $user, $password, $database, $port);

        if($db->errno) {
            echo '<div class="error">No se pudo conectar a la base de datos: '.$db->error.'</div>';
            exit;
        }       

        $db->set_charset("utf8");
        $stmt = $db->prepare($query);
        $stmt->bind_param("si", $email, $idtipousuario);

        $resultado = $stmt->execute();        
        
        if($resultado != false) {
            return "El usuario ha sido creado exitosamente";
        } else {
            return "No fue posible crear usuario";
        }
    } else {
        return "No fue posible crear usuario";
    }   
}

