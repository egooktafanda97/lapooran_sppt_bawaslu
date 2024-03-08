<?php

namespace App\Repositories\Model;

use Illuminate\Database\Eloquent\Builder;
use Lerouse\LaravelRepository\EloquentRepository;
use App\Models\Bawaslu;

class BawasluRepository extends EloquentRepository
{
    /**
     * Get the Repository Query Builder
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return Bawaslu::query();
    }
}
