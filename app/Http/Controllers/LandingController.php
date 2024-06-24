<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    //
    public function index()
    {
        $articles = DB::table('articles')->orderBy('created_at', 'desc')->limit(3)->get();
        $packages = DB::table('packages')->orderBy('created_at', 'asc')->limit(3)->get();
        $data = [
            'title' => 'Home',
            'articles' => $articles,
            'packages' => $packages,
        ];

        return view('landing.index', $data);
    }

    public function contact()
    {
        $favorite_packages = DB::table('packages')->where('is_favorite', 1)->orderBy('updated_at', 'desc')->get();

        $data = [
            'title' => 'Contact',
            'favorite_packages' => $favorite_packages
        ];

        return view('landing.contact', $data);
    }
}
