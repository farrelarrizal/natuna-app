<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarineResourceController extends Controller
{
    //
    public function summary(){
        $naval_strength = DB::table('models')
            ->join('variables', 'models.id', '=', 'variables.model_id')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('models.is_active', 1)
            ->where('variables.name', 'Naval Strength')
            ->first();

        if ($naval_strength == null) {
            $naval_strength = 0;
        } else {
            $naval_strength = $naval_strength->value;
        }

        $naval_deployment = DB::table('models')
            ->join('variables', 'models.id', '=', 'variables.model_id')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('models.is_active', 1)
            ->where('variables.name', 'Naval Deployment')
            ->first();

        if ($naval_deployment == null) {
            $naval_deployment = 0;
        } else {
            $naval_deployment = $naval_deployment->value;
        }

        $naval_capabilities = DB::table('models')
            ->join('variables', 'models.id', '=', 'variables.model_id')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('models.is_active', 1)
            ->where('variables.name', 'Naval Capabilities')
            ->first();

        # if len naval_capabilities == 0, then naval_capabilities = 0
        if ($naval_capabilities == null) {
            $naval_capabilities = 0;
        }

        $data = [
            'title' => 'Marine | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Marine',
            'naval_strength' => $naval_strength,
            'naval_deployment' => $naval_deployment,
            'naval_capabilities' => $naval_capabilities
        ];

        return view('summary.marine', $data);
    }
}
