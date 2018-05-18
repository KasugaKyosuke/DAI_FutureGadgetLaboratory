<?php

require_once ROOT_DIR.'/modelo/dao/AbstractDao.class.php';
require_once ROOT_DIR.'/modelo/dao/DBConexion.class.php';

class UsuarioDao implements AbstractDao  {
    private $conexion;
    
    function __construct(){
        $this->conexion = DBConexion::getInstance();
    }
    
    public function getAll(){
        
        
    }
    
    public function getById($idUsuario) {
        
    }
    
    public function insert($usuario) {
        
    }
    
    public function update($usuario) {
        
    }
    
    public function delete($idUsuario) {
        
    }
    
    public function autenticate($email, $clave) {
        $preparedStmt = $this->conexion->prepare("SELECT email, clave, nombre FROM usuario WHERE email = ? AND clave = PASSWORD(?)");
        
        if($preparedStmt != false) {
            $preparedStmt->bindParam(1,$email);
            $preparedStmt->bindParam(2,$clave);
            $preparedStmt->bindColumn("email", $dbEmail);
            $preparedStmt->bindColumn("clave", $dbClave);
            $preparedStmt->bindColumn("nombre",$dbNombre);            
            $preparedStmt->execute();

            if($preparedStmt->fetch()) {
                $user = new Usuario($dbNombre, $dbClave, $dbEmail);
            } else {
                $user = null;
            }
        } else {
            throw new Exception('no se pudo preparar la consulta a la base de datos: '.$this->conexion->error);
        }
        
        return $user;
    }
}
