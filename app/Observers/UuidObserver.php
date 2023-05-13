<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UuidObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param Model $model
     * @return void
     */
    public function creating(Model $model): void
    {
        if ($model->isFillable('uuid')) {
            $model->fill([
                'uuid' => Str::uuid()
            ]);
        }

    }
}
