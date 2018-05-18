<?php

interface AbstractDao {

    public function getAll();

    public function getById($id);

    public function insert($element);

    public function update($element) ;
    
    public function delete($id);
}
