<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;
use App\Models\ScenarioData;
use App\Models\Scenario;
use Illuminate\Support\Facades\DB;

class ApiDataController extends Controller
{
    public function getVariables()
    {
        // $data = Variable::all();
        $active_model_id = DB::table('models')->where('is_active', 1)->first()->id;
        $data = DB::table('variables')
            ->where('model_id', $active_model_id)
            ->get();

        return response()->json($data);
    }
    public function getKeyVariableActive()
    {
        $model_id = DB::table('models')->where('is_active', 1)->first()->id;
        $data = DB::table('variables')
            ->where('key_variable', 1)
            ->where('model_id', $model_id)
            ->get();

        return response()->json($data);
    }
    public function baseModelGraph(Request $request)
    {
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
    }

    public function variabelStaticGraph($var)
    {
        
        $data = DB::table('scenario_data')
            ->join('scenarios', 'scenarios.id', '=', 'scenario_data.scenario_id')
            ->join('variables', 'variables.id', '=', 'scenario_data.variable_id')
            ->join('models', 'models.id', '=', 'variables.model_id')
            ->where('models.is_active', 1)
            ->where('variables.name', $var)
            ->select(
                'scenarios.id as scenario_id',
                'scenarios.name as scenario_name',
                'variables.name as variable_name',
                'scenario_data.node_point',
                'scenario_data.value'
            )
            ->get();
            

        $finalData = [];
        $groupedData = $data->groupBy('variable_name');

        foreach ($groupedData as $variableName => $items) {
            $scenarioData = $items->groupBy('scenario_id');

            foreach ($scenarioData as $scenarioId => $scenarioItems) {
                $nodePoints = [];
                $values = [];

                foreach ($scenarioItems as $item) {
                    $nodePoints[] = $item->node_point;
                    $values[] = $item->value;
                }
                $scenarioName = $scenarioItems->first()->scenario_name;

                $finalData[] = [
                    'variable_name' => $variableName,
                    'scenario_id' => $scenarioId,
                    'scenario_name' => $scenarioName,
                    'node_points' => $nodePoints,
                    'values' => $values,
                ];
            }
        }

        // Mengembalikan data sebagai JSON
        $response = [
            'data' => $finalData,
        ];
        return response()->json($response);
    }



    public function downloadScenarioModel($id)
    {
        $scenario = DB::table('scenarios')->where('id', $id)->first();
        $scenario_name = $scenario->name;

        $final_time = $scenario->timestep;


        $base_model = DB::table('models')->where('is_active', 1)->first();
        $base_model_name = $base_model->name;

        # lower case and replace space with underscore
        $base_model_name = str_replace(' ', '', strtolower($base_model_name));
        $scenario_name = str_replace(' ', '', strtolower($scenario_name));

        $scenario_filename = $base_model_name . '_' . $scenario_name . '_' . $final_time . '.mdl';

        # call the shell script to generate the model
        // ./run_model_export.sh -f ../../storage/app/uploads/Q029J5Z56q6tKbGmsm62wH0RGZCmrOSTlAilcQqx.bin -e ../../storage/app/scenarioModels/export-model-final.mdl -t 125 -s 10
        $command = './run_model_export.sh -f ' . storage_path('app/' . $base_model->pathfile) . ' -e ' . storage_path('app/scenarioModels/' . $scenario_filename) . ' -t ' . $final_time . ' -s ' . $scenario->id;
        $output = shell_exec($command);

        $scenario->export_path = 'scenarioModels/' . $scenario_filename;

        # update the db first
        DB::table('scenarios')->where('id', $id)->update(['export_path' => $scenario->export_path]);

        if (!$scenario) {
            return response()->json([
                'message' => 'Scenario not found',
            ], 404);
        }

        $filepath = storage_path('app/' . $scenario->export_path);
        return response()->download($filepath);
    }
    
    public function searchVariables(Request $request)
    {
        $query = $request->input('query');
        $active_model_id = DB::table('models')->where('is_active', 1)->first()->id;
        
        $results = DB::table('variables')
            ->where('model_id', $active_model_id)
            ->where('name', 'like', "%{$query}%")
            ->get();

        $formattedResults = $results->map(function ($variable) {
            return [
                'label' => $variable->name,
                'value' => $variable->id,
            ];
        });

        return response()->json($formattedResults);
    }
    public function searchSFD(Request $request)
    {
        $query = $request->input('query');
        $active_model_id = DB::table('models')->where('is_active', 1)->first()->id;
        
        $results = DB::table('sfd')
            ->where('model_id', $active_model_id)
            ->where('name', 'like', "%{$query}%")
            ->get();

        $formattedResults = $results->map(function ($sfd) {
            return [
                'label' => $sfd->name,
                'value' => $sfd->name,
            ];
        });

        return response()->json($formattedResults);
    }
}
