<?php

namespace Src\Common\Application\Items\Commands;

abstract class CreateItemCommand
{
    abstract public function handle(array $data);
}
