<?php

require_once ROOT_DIR.'/modelo/dao/DBConexion.class.php';
require_once ROOT_DIR.'/modelo/dao/AbstractDao.class.php';
require_once ROOT_DIR.'/modelo/Especialidad.class.php';

class EspecialidadDAO implements AbstractDao {
    private static $insertQuery = "INSERT INTO especialidad (id,nombre) VALUES(?, ?)";
    private static $updateQuery = "UPDATE especialidad SET nombre=? WHERE id=?";    
    private static $deleteQuery = "DELETE FROM especialidad WHERE id = ?";
    private static $selectAllQuery = "SELECT id, nombre FROM especialidad";
    private $conexion;
    
    function __construct(){
        $this->conexion = DBConexion::getInstance();
    }
    
    public function delete($idEspecialidad) {
        $preparedStmt = $this->conexion->prepared(static::$deleteQuery);
        $preparedStmt->bind_param("i",$idEspecialidad);
        $preparedStmt->execute();
        
        return ($this->conexion->affected_rows > 0);            
    }

    public function getAll() {
        $this->conexion->set_charset("utf8");
        $resultSet = $this->conexion->query(static::$selectAllQuery);
        $listado = array();
        
        while($registro = $resultSet->fetch_assoc()) {
            $especialidad = new Especialidad($registro["id"],$registro["nombre"]);            
            array_push($listado, $especialidad);
        }
        
        return $listado;
    }

    public function getById($idEspecialidad) {
        
    }

    public function insert($especialidad) {
        
    }

    public function update($especialidad) {
        
    }

}