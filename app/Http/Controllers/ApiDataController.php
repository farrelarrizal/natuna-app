<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;
use App\Models\ScenarioData;
use App\Models\Scenario;
use Illuminate\Support\Facades\DB;
class ApiDataController extends Controller
{
    public function getVariables(){
        $data = Variable::all();
        return response()->json($data);
    }

    public function baseModelGraph(Request $request){
        $idVariable = $request->query('variableId');
        $data = DB::table('scenario_data')
            ->join('scenarios', 'scenarios.id', '=', 'scenario_data.scenario_id')
            ->join('variables', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $idVariable)
            ->select(
                'variables.id as variable_id',
                'scenarios.id as scenario_id',
                'scenarios.name as scenario_name',
                'scenario_data.node_point',
                'scenario_data.value',
            )
            ->get();

        
        $finalData = [];
        $groupedData = $data->groupBy('scenario_id');

        foreach ($groupedData as $scenarioId => $items) {
            $nodePoints = [];
            $values = [];

            foreach ($items as $item) {
                $nodePoints[] = $item->node_point;
                $values[] = $item->value;
            }
            $scenarioName = $items->first()->scenario_name;
            
            $finalData[] = [
                'scenario_id' => $scenarioId,
                'scenario_name' => $scenarioName,
                'node_points' => $nodePoints,
                'values' => $values,
            ];
        }
        $response = [
                'data' => $finalData,
            ];
        return response()->json($response);
}}
