<?php

namespace App\Repositories\Model;

use Illuminate\Database\Eloquent\Builder;
use Lerouse\LaravelRepository\EloquentRepository;
use App\Models\PtpSppd;

class PtpSppdRepository extends EloquentRepository
{
    /**
     * Get the Repository Query Builder
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return PtpSppd::query();
    }
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
