<?php

namespace Test\BaceManager\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface {

    public static function Load();

    public function get(Array $filters);

    public function show(int $id);

    public function create(Array $data);

    public function update(Array $data, Model $model);

}