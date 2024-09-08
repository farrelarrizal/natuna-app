<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarineResourceController extends Controller
{
    //
    public function summary(){
        // diganti dengan nama variable
        $variables = ['Marine Resource Utilization', 'Potential Economic Value of North Natuna Sea'];

        $variableIds = DB::table('variables')
            ->join('models', 'models.id', '=', 'variables.model_id')
            ->whereIn('variables.name', $variables)
            ->where('models.id', 97)  //ganti model yang aktif
            ->pluck('variables.id', 'variables.name');

        $var_1 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Marine Resource Utilization'] ?? null)  //nama disesuaikan
            ->first();
    
        if ($var_1 == null) {
            $var_1 = 0;
        } else {
            $var_1 = $var_1->value;
        }
            
        $var_2 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Potential Economic Value of North Natuna Sea'] ?? null)  //nama disesuaikan
            ->first();

        if ($var_2 == null) {
            $var_2 = 0;
        } else {
            $var_2 = $var_2->value;
        }
        
        $data = [
            'title' => 'Defence and Security | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Defence and Security',
            'first_variable' => $var_1,
            'second_variable' => $var_2,
        ];

        return view('summary.marine', $data);
    }
}
