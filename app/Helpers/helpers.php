<?php

if (!function_exists('_val')) {
    function _val($data, ?string $default = null)
    {
        if (!empty($data)) {
            return $data;
        }
        return $default;
    }
}

if (!function_exists('setSelected')) {
    function setSelected($items, ?string $default = null)
    {
        if (!empty($items)) {
            return $items->jenis_surat_id == $default ? "selected" : "";
        }
        return $default;
    }
}
