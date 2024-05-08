<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function geografi()
    {
        $data = [
            'title' => 'Peta',
            'head_title' => 'Peta Geografi',
            'breadcrumb_item' => 'Peta',
        ];

        return view('peta-geografi', $data);
    }

    public function keamanan()
    {
        $data = [
            'title' => 'Peta',
            'head_title' => 'Peta Keamanan',
            'breadcrumb_item' => 'Peta',
        ];

        return view('peta-keamanan', $data);
    }
}
