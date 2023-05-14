<?php

namespace Test\BaceManager\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface {

    public static function Load() : Array;

    public function get(Array $filters) : LengthAwarePaginator;

    public function show(int $id);

    public function create(Array $data);

    public function update(int $id, Array $data);
    
    public function delete(int $id);

    public function multydelete(Array $list);


}