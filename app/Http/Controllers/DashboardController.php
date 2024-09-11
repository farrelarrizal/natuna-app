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
        # redirect to scenario id 28
        return redirect()->route('dashboard.executive-summary-scenario', ['scenarioId' => 28]);
    }

    //     $flag_first_var = false;
    //     $time = 60;
    //     $variables = ['North Natuna Defense and Security', 'National Defense and Security Infrastructure', 'Marine Resource Utilizatio', 'National Sea Threat Risk'];  //nama disesuaikan

    //     $variableIds = DB::table('variables')
    //         ->join('models', 'models.id', '=', 'variables.model_id')
    //         ->whereIn('variables.name', $variables)
    //         ->where('models.is_active', 1)  //ganti model yang aktif
    //         ->pluck('variables.id', 'variables.name');

    //     $first_var = DB::table('variables')
    //         ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
    //         ->where('variables.id', $variableIds['North Natuna Defense and Security'] ?? null)  //nama disesuaikan
    //         ->where('scenario_data.node_point', $time)
    //         ->first();

    //     $second_var = DB::table('variables')
    //         ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
    //         ->where('variables.id', $variableIds['National Defense and Security Infrastructure'] ?? null)  //nama disesuaikan
    //         ->where('scenario_data.node_point', $time)
    //         ->first();

    //     $third_var = DB::table('variables')
    //         ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
    //         ->where('variables.id', $variableIds['Marine Resource Utilizatio'] ?? null)  //nama disesuaikan
    //         ->where('scenario_data.node_point', $time)
    //         ->first();

    //     $fourth_var = DB::table('variables')
    //         ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
    //         ->where('variables.id', $variableIds['National Sea Threat Risk'] ?? null)  //nama disesuaikan
    //         ->where('scenario_data.node_point', $time)
    //         ->first();

    //     $scenarios = DB::table('scenarios')
    //         ->join('sfd', 'sfd.id', '=', 'scenarios.sfd_id')
    //         ->join('models', 'models.id', '=', 'sfd.model_id')
    //         ->where('models.is_active', 1)
    //         ->get(
    //             "scenarios.*"
    //         );
    //     // dd($scenarios);

    //     if ($first_var == null) {
    //         $first_var = 0;
    //     } else {
    //         $first_var = $first_var->value;
    //     }

    //     if ($first_var < 50) {
    //         $flag_first_var = 'LOW';
    //     } elseif ($first_var >= 50 && $first_var < 70) {
    //         $flag_first_var = 'MEDIUM';
    //     } else {
    //         $flag_first_var = 'HIGH';
    //     }

    //     if ($second_var == null) {
    //         $second_var = 0;
    //     } else {
    //         $second_var = $second_var->value;
    //     }

    //     if ($second_var < 50) {
    //         $flag_second_var = 'LOW';
    //     } elseif ($second_var >= 50 && $second_var < 70) {
    //         $flag_second_var = 'MEDIUM';
    //     } else {
    //         $flag_second_var = 'HIGH';
    //     }

    //     # if len naval_capabilities == 0, then naval_capabilities = 0
    //     if ($third_var == null) {
    //         $third_var = 0;
    //     } else {
    //         $third_var = $third_var->value;
    //     }

    //     if ($third_var < 50) {
    //         $flag_third_var = 'LOW';
    //     } elseif ($third_var >= 50 && $third_var < 70) {
    //         $flag_third_var = 'MEDIUM';
    //     } else {
    //         $flag_third_var = 'HIGH';
    //     }

    //     if ($fourth_var == null) {
    //         $fourth_var = 0;
    //     } else {
    //         $fourth_var = $fourth_var->value;
    //     }

    //     if ($fourth_var < 50) {
    //         $flag_fourth_var = 'LOW';
    //     } elseif ($fourth_var >= 50 && $fourth_var < 70) {
    //         $flag_fourth_var = 'MEDIUM';
    //     } else {
    //         $flag_fourth_var = 'HIGH';
    //     }

    //     // # LOGIC PENENTUAN REKOMENDASI, TP KERJAAIN NASINYA DULU AJA baru ambil lauknya
    //     // $recommendationId = DB::table('recommendations')
    //     //     ->where('defence_severity', $flag_first_var)
    //     //     ->where('infra_defence_severity', $flag_second_var)
    //     //     ->where('marine_resource', $flag_third_var)
    //     //     ->where('threat_severity', $flag_fourth_var)
    //     //     ->first();
    //     // dd($recommendationId);

    //     if ($flag_first_var == 'LOW' && $flag_second_var == 'LOW' && $flag_third_var == 'LOW') {
    //         $all_indicator = 'VERY LOW';
    //     } elseif ($first_var == 'MEDIUM' && $second_var == 'MEDIUM' && $flag_third_var == 'MEDIUM') {
    //         $all_indicator = 'VERY LOW';
    //     } elseif ($first_var == 'HIGH' && $second_var == 'HIGH' && $flag_third_var == 'HIGH') {
    //         $all_indicator = 'VERY LOW';
    //     } else {
    //         $all_indicator = 'UNKNOWN';
    //     }

    //     $data = [
    //         'title' => 'Dashboard | Executive Summary',
    //         'head_title' => 'Executive Summary',
    //         'breadcrumb_item' => 'Dashboard',
    //         'first_var' => $first_var,
    //         'second_var' => $second_var,
    //         'third_var' => $third_var,
    //         'fourth_var' => $fourth_var,
    //         'all_indicator' => $all_indicator,
    //         'actual_indicator' => $flag_first_var,
    //         'forecast_indicator' => $flag_fourth_var,
    //         'scenarios' => $scenarios,
    //         'ancaman' => $flag_fourth_var
    //     ];
    //     return view('dashboard.executive-summary', $data);
    // }


    public function executiveSummaryScenario(Request $request)
    {
        $scenarioId = $request->scenarioId;

        // Actual Logic
        $flag_first_var = false;
        $time = 60;
        $variables = ['North Natuna Defense and Security', 'National Defense and Security Infrastructure', 'Marine Resource Utilization', 'National Sea Threat Risk'];  //nama disesuaikan

        $variableIds = DB::table('variables')
            ->join('models', 'models.id', '=', 'variables.model_id')
            ->whereIn('variables.name', $variables)
            ->where('models.is_active', 1)  //ganti model yang aktif
            ->pluck('variables.id', 'variables.name');

        $first_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['North Natuna Defense and Security'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', $time)
            ->first();

        $second_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['National Defense and Security Infrastructure'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', $time)
            ->first();

        $third_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Marine Resource Utilization'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', $time)
            ->first();

        $fourth_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['National Sea Threat Risk'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', $time)
            ->first();

        $scenarios = DB::table('scenarios')
            ->join('sfd', 'sfd.id', '=', 'scenarios.sfd_id')
            ->join('models', 'models.id', '=', 'sfd.model_id')
            ->where('models.is_active', 1)
            ->get(
                "scenarios.*"
            );

        if ($first_var == null) {
            $first_var = 0;
        } else {
            $first_var = $first_var->value;
        }

        if ($first_var < 50) {
            $flag_first_var = 'LOW';
        } elseif ($first_var >= 50 && $first_var < 70) {
            $flag_first_var = 'MEDIUM';
        } else {
            $flag_first_var = 'HIGH';
        }

        if ($second_var == null) {
            $second_var = 0;
        } else {
            $second_var = $second_var->value;
        }

        if ($second_var < 50) {
            $flag_second_var = 'LOW';
        } elseif ($second_var >= 50 && $second_var < 70) {
            $flag_second_var = 'MEDIUM';
        } else {
            $flag_second_var = 'HIGH';
        }

        # if len naval_capabilities == 0, then naval_capabilities = 0
        if ($third_var == null) {
            $third_var = 0;
        } else {
            $third_var = $third_var->value;
        }

        if ($third_var < 50) {
            $flag_third_var = 'LOW';
        } elseif ($third_var >= 50 && $third_var < 70) {
            $flag_third_var = 'MEDIUM';
        } else {
            $flag_third_var = 'HIGH';
        }

        if ($fourth_var == null) {
            $fourth_var = 0;
        } else {
            $fourth_var = $fourth_var->value;
        }

        if ($fourth_var < 50) {
            $flag_fourth_var = 'LOW';
        } elseif ($fourth_var >= 50 && $fourth_var < 70) {
            $flag_fourth_var = 'MEDIUM';
        } else {
            $flag_fourth_var = 'HIGH';
        }

        # LOGIC PENENTUAN REKOMENDASI, TP KERJAAIN NASINYA DULU AJA baru ambil lauknya (81 Kombinasi)
        if ($flag_first_var == 'LOW' && $flag_second_var == 'LOW' && $flag_third_var == 'LOW' && $flag_fourth_var == 'LOW') {
            $all_indicator_local = 'VERY LOW';
        } elseif ($first_var == 'MEDIUM' && $second_var == 'MEDIUM' && $flag_third_var == 'MEDIUM' && $flag_fourth_var == 'MEDIUM') {
            $all_indicator_local = 'HIGH';
        } elseif ($first_var == 'HIGH' && $second_var == 'HIGH' && $flag_third_var == 'HIGH' && $flag_fourth_var == 'HIGH') {
            $all_indicator_local = 'VERY LOW';
        } else {
            $all_indicator_local = 'UNKNOWN';
        }


        # forecast
        // 1. scenario id 
        // 2. variable id
        $scenarioId = $request->scenarioId;

        $forecast_first_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->join('scenarios', 'scenarios.id', '=', 'scenario_data.scenario_id')
            ->where('variables.id', $variableIds['North Natuna Defense and Security'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', '>', $time)
            ->where('scenarios.id', $scenarioId)
            ->avg('scenario_data.value');

        $forecast_second_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->join('scenarios', 'scenarios.id', '=', 'scenario_data.scenario_id')
            ->where('variables.id', $variableIds['National Defense and Security Infrastructure'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', '>', $time)
            ->where('scenarios.id', $scenarioId)
            ->avg('scenario_data.value');

        $forecast_third_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->join('scenarios', 'scenarios.id', '=', 'scenario_data.scenario_id')
            ->where('variables.id', $variableIds['Marine Resource Utilizatio'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', '>', $time)
            ->where('scenarios.id', $scenarioId)
            ->avg('scenario_data.value');

        $forecast_fourth_var = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->join('scenarios', 'scenarios.id', '=', 'scenario_data.scenario_id')
            ->where('variables.id', $variableIds['National Sea Threat Risk'] ?? null)  //nama disesuaikan
            ->where('scenario_data.node_point', '>', $time)
            ->where('scenarios.id', $scenarioId)
            ->avg('scenario_data.value');

        if ($forecast_first_var == null) {
            $forecast_first_var = 0;
        }

        if ($forecast_first_var < 50) {
            $flag_forecast_first_var = 'LOW';
        } elseif ($forecast_first_var >= 50 && $forecast_first_var < 70) {
            $flag_forecast_first_var = 'MEDIUM';
        } else {
            $flag_forecast_first_var = 'HIGH';
        }

        if ($forecast_second_var == null) {
            $forecast_second_var = 0;
        }

        if ($forecast_second_var < 50) {
            $flag_forecast_second_var = 'LOW';
        } elseif ($forecast_second_var >= 50 && $forecast_second_var < 70) {
            $flag_forecast_second_var = 'MEDIUM';
        } else {
            $flag_forecast_second_var = 'HIGH';
        }

        if ($forecast_third_var == null) {
            $forecast_third_var = 0;
        }

        if ($forecast_third_var < 50) {
            $flag_forecast_third_var = 'LOW';
        } elseif ($forecast_third_var >= 50 && $forecast_third_var < 70) {
            $flag_forecast_third_var = 'MEDIUM';
        } else {
            $flag_forecast_third_var = 'HIGH';
        }

        if ($forecast_fourth_var == null) {
            $forecast_fourth_var = 0;
        }

        if ($forecast_fourth_var < 50) {
            $flag_forecast_fourth_var = 'LOW';
        } elseif ($forecast_fourth_var >= 50 && $forecast_fourth_var < 70) {
            $flag_forecast_fourth_var = 'MEDIUM';
        } else {
            $flag_forecast_fourth_var = 'HIGH';
        }

        // dd($flag_forecast_first_var, $flag_forecast_second_var, $flag_forecast_third_var, $flag_forecast_fourth_var);

        # LOGIC PENENTUAN REKOMENDASI, TP KERJAAIN NASINYA DULU AJA baru ambil lauknya (81 Kombinasi)
        if ($flag_forecast_first_var == 'MEDIUM' && $flag_forecast_second_var == 'LOW' && $flag_forecast_third_var == 'LOW' && $flag_forecast_fourth_var == 'LOW') {
            $all_indicator = 'VERY LOW';
        } elseif ($flag_forecast_first_var == 'MEDIUM' && $flag_forecast_second_var == 'MEDIUM' && $flag_forecast_third_var == 'MEDIUM' && $flag_forecast_fourth_var == 'MEDIUM') {
            $all_indicator = 'VERY LOW';
        } elseif ($flag_forecast_first_var == 'HIGH' && $flag_forecast_second_var == 'HIGH' && $flag_forecast_third_var == 'HIGH' && $flag_forecast_fourth_var == 'HIGH') {
            $all_indicator = 'VERY LOW';
        } elseif ($flag_forecast_first_var == 'HIGH' && $flag_forecast_second_var == 'HIGH' && $flag_forecast_third_var == 'HIGH' && $flag_forecast_fourth_var == 'HIGH') {
            $all_indicator = 'VERY LOW';
        } elseif ($flag_forecast_first_var == 'MEDIUM' && $flag_forecast_second_var == 'MEDIUM' && $flag_forecast_third_var == 'MEDIUM' && $flag_forecast_fourth_var == 'MEDIUM') {
            $all_indicator = 'HIGH';
        } else {
            $all_indicator = 'UNKNOWN';
        }

        $ancaman_id = DB::table('ancaman')
            ->where('flag', substr($flag_forecast_first_var, 0, 1))
            ->get();


        $recommendationId = DB::table('recommendation')
            ->where('defence_severity', $flag_forecast_first_var)
            ->where('infra_defence_severity', $flag_forecast_second_var)
            ->where('marine_resource', $flag_forecast_third_var)
            ->where('threat_severity', $flag_forecast_fourth_var)
            ->first();

        if ($flag_first_var == 'LOW'):
            $solution_first_var = DB::table('scenario_alternative')
                ->where('variable', 'North Natuna Defense and Security')
                ->where('severity', 'LOW')
                ->first();
        elseif ($flag_first_var == 'MEDIUM'):
            $solution_first_var = DB::table('scenario_alternative')
                ->where('variable', 'North Natuna Defense and Security')
                ->where('severity', 'MEDIUM')
                ->first();
        else:
            $solution_first_var = DB::table('scenario_alternative')
                ->where('variable', 'North Natuna Defense and Security')
                ->where('severity', 'HIGH')
                ->first();
        endif;

        if ($flag_second_var == 'LOW'):
            $solution_second_var = DB::table('scenario_alternative')
                ->where('variable', 'National Defense and Security Infrastructure')
                ->where('severity', 'LOW')
                ->first();

        elseif ($flag_second_var == 'MEDIUM'):
            $solution_second_var = DB::table('scenario_alternative')
                ->where('variable', 'National Defense and Security Infrastructure')
                ->where('severity', 'MEDIUM')
                ->first();
        else:
            $solution_second_var = DB::table('scenario_alternative')
                ->where('variable', 'National Defense and Security Infrastructure')
                ->where('severity', 'HIGH')
                ->first();
        endif;

        if ($flag_third_var == 'LOW'):
            $solution_third_var = DB::table('scenario_alternative')
                ->where('variable', 'Marine Resource Utilizatio')
                ->where('severity', 'LOW')
                ->first();
        elseif ($flag_third_var == 'MEDIUM'):
            $solution_third_var = DB::table('scenario_alternative')
                ->where('variable', 'Marine Resource Utilizatio')
                ->where('severity', 'MEDIUM')
                ->first();
        else:
            $solution_third_var = DB::table('scenario_alternative')
                ->where('variable', 'Marine Resource Utilizatio')
                ->where('severity', 'HIGH')
                ->first();
        endif;

        if ($flag_fourth_var == 'LOW'):
            $solution_fourth_var = DB::table('scenario_alternative')
                ->where('variable', 'National Sea Threat Risk')
                ->where('severity', 'LOW')
                ->first()->solusi;
        elseif ($flag_fourth_var == 'MEDIUM'):
            $solution_fourth_var = DB::table('scenario_alternative')
                ->where('variable', 'National Sea Threat Risk')
                ->where('severity', 'MEDIUM')
                ->first()->solusi;
        else:
            $solution_fourth_var = DB::table('scenario_alternative')
                ->where('variable', 'National Sea Threat Risk')
                ->where('severity', 'HIGH')
                ->first()->solusi;
        endif;


        $data = [
            'title' => 'Dashboard | Executive Summary',
            'head_title' => 'Executive Summary',
            'breadcrumb_item' => 'Dashboard',
            'first_var' => $first_var ?? 0,
            'second_var' => $second_var ?? 0,
            'third_var' => $third_var ?? 0,
            'fourth_var' => $fourth_var ?? 0,
            'all_indicator_local' => $all_indicator_local,
            'all_indicator' => $all_indicator,
            'scenarios' => $scenarios,
            'forecast_first_var' => $forecast_first_var ?? 0,
            'forecast_second_var' => $forecast_second_var ?? 0,
            'forecast_third_var' => $forecast_third_var ?? 0,
            'forecast_fourth_var' => $forecast_fourth_var ?? 0,
            'ancaman_id' => $ancaman_id,
            'recommendation_id' => $recommendationId,
            'solution_first_var' => $solution_first_var,
            'solution_second_var' => $solution_second_var,
            'solution_third_var' => $solution_third_var,
            'solution_fourth_var' => $solution_fourth_var,
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
