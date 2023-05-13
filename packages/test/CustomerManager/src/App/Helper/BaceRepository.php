<?php

namespace Test\CustomerManager\App\Helper;

use Test\BaceManager\Interfaces\RepositoryInterface;

abstract class BaceRepository implements RepositoryInterface{

    public static function checkIsList(string $fild, Array $list)
    {
        return isset($list[$fild]) && 
            is_array($list[$fild]);
    }

    public function multydelete(Array $list)
    {
        foreach ($list as $id) {
            $this->delete($id);
        }
    }

}