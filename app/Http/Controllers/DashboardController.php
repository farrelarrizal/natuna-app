<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //index
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        return view('dashboard', $data);
    }
    public function executiveSummary()
    {
        $data = [
            'title' => 'Dashboard | Executive Summary',
            'head_title' => 'Executive Summary',
            'breadcrumb_item' => 'Dashboard',
        ];
        return view('dashboard.executive-summary', $data);
    }
    public function recommendation()
    {
        $data = [
            'title' => 'Dashboard | Recommendation',
            'head_title' => 'Recommendation',
            'breadcrumb_item' => 'Dashboard',
        ];
        return view('dashboard.recommendation', $data);
    }

    public function maps()
    {
        $data = [
            'title' => 'Dashboard | Maps',
            'head_title' => 'Maps',
            'breadcrumb_item' => 'Dashboard',
        ];
        return view('dashboard.maps', $data);
    }

    public function policyBrief()
    {
        $data = [
            'title' => 'Dashboard | Policy Brief',
            'head_title' => 'Policy Brief',
            'breadcrumb_item' => 'Dashboard',
        ];
        return view('dashboard.policy-brief', $data);
    }
}
