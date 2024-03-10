<?php

namespace App\Repositories\Model;

use App\Models\PermohonanSuratKeluar;
use Illuminate\Database\Eloquent\Builder;
use Lerouse\LaravelRepository\EloquentRepository;

class PsktRepository extends EloquentRepository
{
    /**
     * Get the Repository Query Builder
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return PermohonanSuratKeluar::query();
    }

    //update status
    public function StatusUpdate($id, $status)
    {
        try {
            $this->builder()->where('id', $id)->update(['status_surat' => $status]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
