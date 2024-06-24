<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    //
    public function index()
    {

        $package_umroh_reguler = DB::table('packages')->where('category_id', 1)->where('is_active', 1)->get();
        $package_haji_plus = DB::table('packages')->where('category_id', 2)->where('is_active', 1)->get();
        $package_umroh_hemat = DB::table('packages')->where('category_id', 3)->where('is_active', 1)->get();
        $package_umroh_tour = DB::table('packages')->where('category_id', 4)->where('is_active', 1)->get();

        $data = [
            'title' => 'List Paket',
            'package_umroh_reguler' => $package_umroh_reguler,
            'package_haji_plus' => $package_haji_plus,
            'package_umroh_hemat' => $package_umroh_hemat,
            'package_umroh_tour' => $package_umroh_tour,
        ];

        return view('landing.package', $data);
    }

    public function show($url)
    {
        // dd($url);
        $package = DB::table('packages')
            ->join('package_detail', 'packages.slug', '=', 'package_detail.slug')
            ->join('package_category', 'packages.category_id', '=', 'package_category.id')
            ->where('packages.slug', $url)->first();
        // dd($package);

        $data = [
            'title' => $package->package_name,
            'package' => $package,
            // 'categoryPackage' => $categoryPackage,
        ];
        return view('landing.package-detail', $data);
    }
}
