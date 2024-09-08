<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $variables = ['North Natuna Defense and Security', 'National Defense and Security Infrastructure', 'Marine Resource Utilizatio'];

        $variableIds = DB::table('variables')
            ->join('models', 'models.id', '=', 'variables.model_id')
            ->whereIn('variables.name', $variables)
            ->where('models.is_active', 1)  //ganti model yang aktif
            ->pluck('variables.id', 'variables.name');

        $first_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['North Natuna Defense and Security'] ?? null)  //nama disesuaikan
            ->first();
 
        if ($first_var == null) {
            $first_var = 0;
        } else {
            $first_var = $first_var->value;
        }
         
        $second_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['National Defense and Security Infrastructure'] ?? null)  //nama disesuaikan
            ->first();

        if ($second_var == null) {
            $second_var = 0;
        } else {
            $second_var = $second_var->value;
        }
        
        $third_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Marine Resource Utilizatio'] ?? null)  //nama disesuaikan
            ->first();

        # if len naval_capabilities == 0, then naval_capabilities = 0
        if ($third_var == null) {
            $third_var = 0;
        }

        $data = [
            'title' => 'Dashboard | Executive Summary',
            'head_title' => 'Executive Summary',
            'breadcrumb_item' => 'Dashboard',
            'first_var' => $first_var,
            'second_var' => $second_var,
            'third_var' => $third_var

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
