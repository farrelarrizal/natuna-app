<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;
use App\Models\ScenarioData;
use App\Models\Scenario;
use Illuminate\Support\Facades\DB;
class ApiDataController extends Controller
{
    public function getScenarios(){
        $data = Scenario::all();
        return response()->json($data);
    }

    public function baseModelGraph(Request $request){
        $idScenario = $request->query('scenarioId');
        $data = DB::table('scenario_data')
            ->join('scenarios', 'scenarios.id', '=', 'scenario_data.scenario_id')
            ->join('variables', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('scenarios.id', $idScenario)
            ->select(
                'variables.id as variable_id',
                'variables.name as variable_name',
                'scenario_data.node_point',
                'scenario_data.value',
            )
            ->get();

        
        $finalData = [];
        $groupedData = $data->groupBy('variable_id');

        foreach ($groupedData as $variableId => $items) {
            $nodePoints = [];
            $values = [];

            foreach ($items as $item) {
                $nodePoints[] = $item->node_point;
                $values[] = $item->value;
            }
            $variableName = $items->first()->variable_name;
            
            $finalData[] = [
                'variable_id' => $variableId,
                'variable_name' => $variableName,
                'node_points' => $nodePoints,
                'values' => $values,
            ];
        }
        $response = [
                'data' => $finalData,
            ];
        return response()->json($response);
}}
