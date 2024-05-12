<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;
use Illuminate\Support\Str;


class BaseControllers extends Controller
{

    public function show(Request $request)
    {
        // Mendapatkan nama view dari request
        $viewName = $request->view;

        // Memeriksa apakah view ada
        if (view()->exists($viewName)) {
            // Jika view ada, tampilkan view tersebut
            return view($viewName);
        } else {
            // Jika view tidak ada, cari asset di direktori publik Laravel
            $assetPath = public_path($viewName);

            // Memeriksa apakah asset ada
            if (file_exists($assetPath)) {
                // Jika asset ada, tampilkan asset tersebut
                return response()->file($assetPath);
            } else {
                // Jika asset tidak ada, berikan respons sesuai kebutuhan Anda
                abort(404, 'Asset not found');
            }
        }
    }
}
