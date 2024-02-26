<?php

namespace Package\Attribute;

use Attribute;
use Package\Attribute\SetGet;

#[Attribute]
class Rules
{
    public $rules;
    public $message;
    private $custom;

    public function __construct($rules, ?string $message, ...$args)
    {
        $this->rules = $rules;
        $this->message = $message;

        $this->custom = array();

        // Jika ada argumen, tambahkan ke properti array
        foreach ($args as $arg) {
            $this->custom[] = $arg;
        }
    }


    // Metode setter untuk menambahkan data ke properti array
    public function setData($key, $value)
    {
        $this->custom[$key] = $value;
    }

    // Metode getter untuk mendapatkan nilai dari properti array
    public function getData($key)
    {
        return isset($this->custom[$key]) ? $this->custom[$key] : null;
    }

    // Metode untuk mendapatkan keseluruhan data array
    public function getAllData()
    {
        return $this->custom;
    }

    public function getAttribute()
    {
        $inData =  array_merge(get_object_vars($this), ...[...$this->custom]);
        unset($inData['custom']);
        return $inData;
    }
}


// #[Rule('required|unique:surat', 'Kolom ini diperlukan dan harus unik.')]
// public string $kode_surat;

// #[Rule('required', 'Kolom ini diperlukan.')]
// public string $klasifikasi;

// #[Rule('required|date', 'Kolom ini diperlukan dan harus dalam format tanggal.')]
// public Date $tanggal;

// #[Rule('nullable|date', 'Kolom ini opsional tetapi jika diisi harus dalam format tanggal.')]
// public Date $tanggal_dinas;

// #[Rule('required', 'Kolom ini diperlukan.')]
// public string $perihal;

// #[Rule('required', 'Kolom ini diperlukan.')]
// public string $tujuan_surat;

// #[Rule('nullable', 'Kolom ini opsional.')]
// public string $pengirim;

// #[Rule('nullable', 'Kolom ini opsional.')]
// public string $status_surat;

// #[Rule('nullable', 'Kolom ini opsional.')]
// public string $lampiran;