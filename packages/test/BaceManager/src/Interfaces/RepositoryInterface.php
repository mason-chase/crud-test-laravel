<?php

namespace Test\BaceManager\Interfaces;

interface RepositoryInterface {

    public static function Load() : Array;

    public function get(Array $filters);

    public function show(int $id);

    public function create(int $id, Array $data);

    public function update(int $id, Array $data);
    
    public function delete(int $id);

    public function multydelete(Array $list);


}