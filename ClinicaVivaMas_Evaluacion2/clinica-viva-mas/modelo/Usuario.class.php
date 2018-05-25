<?php

class Usuario {
    private $nombre;
    private $clave;
    private $email;    
   
    function __construct($nombre, $clave, $email) {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->email = $email;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getClave() {
        return $this->clave;
    }

    function getEmail() {
        return $this->email;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setEmail($email) {
        $this->email = $email;
    }
}
