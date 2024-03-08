<?php

namespace App\Repositories\Surat;

use Illuminate\Database\Eloquent\Builder;
use Lerouse\LaravelRepository\EloquentRepository;
use App\Models\JenisSurat;

class JenisSuratRepository extends EloquentRepository
{
    /**
     * Get the Repository Query Builder
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return JenisSurat::query();
    }
}
