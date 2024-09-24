<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;
use App\Models\ModelSD;
use App\Models\Sfd;
use App\Models\Scenario;
use App\Models\ScenarioData;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Imports\ScenarioDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class HankamController extends Controller
{
    //
    public function summary()
    {
        $variables = ['North Natuna Defense and Security', 'National Sea Threat Risk', 'Naval Defense Posture', 'Naval Strength', 'Naval Deployment', 'Naval Capabilities'];

        $variableIds = DB::table('variables')
            ->join('models', 'models.id', '=', 'variables.model_id')
            ->whereIn('variables.name', $variables)
            ->where('models.is_active', 1)  //ganti model yang aktif
            ->pluck('variables.id', 'variables.name');

        $var_1 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['North Natuna Defense and Security'] ?? null)  //nama disesuaikan
            ->first();

        if ($var_1 == null) {
            $var_1 = 0;
        } else {
            $var_1 = $var_1->value;
        }

        $var_2 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['National Sea Threat Risk'] ?? null)  //nama disesuaikan
            ->first();

        if ($var_2 == null) {
            $var_2 = 0;
        } else {
            $var_2 = $var_2->value;
        }

        $var_3 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Naval Defense Posture'] ?? null)  //nama disesuaikan
            ->first();

        # if len naval_capabilities == 0, then naval_capabilities = 0
        if ($var_3 == null) {
            $var_3 = 0;
        }

        $naval_strength = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Naval Strength'] ?? null)  //nama disesuaikan
            ->first();

        if ($naval_strength == null) {
            $naval_strength = 0;
        } else {
            $naval_strength = $naval_strength->value;
        }

        $naval_deployment = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Naval Deployment'] ?? null)  //nama disesuaikan
            ->first();

        if ($naval_deployment == null) {
            $naval_deployment = 0;
        } else {
            $naval_deployment = $naval_deployment->value;
        }

        $naval_capabilities = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Naval Capabilities'] ?? null)  //nama disesuaikan
            ->first();

        # if len naval_capabilities == 0, then naval_capabilities = 0
        if ($naval_capabilities == null) {
            $naval_capabilities = 0;
        }

        $data = [
            'title' => 'Defence and Security | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Defence and Security',
            'first_var' => $var_1,
            'second_var' => $var_2,
            'third_var' => $var_3,
            'naval_strength' => $naval_strength,
            'naval_deployment' => $naval_deployment,
            'naval_capabilities' => $naval_capabilities
        ];

        return view('summary.hankam', $data);
    }

    public function infraSummary()
    {
        // diganti dengan nama variable
        $variables = ['National Defense and Security Infrastructure', 'Defense and Security Regulation', 'Priority Program'];

        $variableIds = DB::table('variables')
            ->join('models', 'models.id', '=', 'variables.model_id')
            ->whereIn('variables.name', $variables)
            ->where('models.id', 97)  //ganti model yang aktif
            ->pluck('variables.id', 'variables.name');

        $var_1 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['National Defense and Security Infrastructure'] ?? null)  //nama disesuaikan
            ->first();

        if ($var_1 == null) {
            $var_1 = 0;
        } else {
            $var_1 = $var_1->value;
        }

        $var_2 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Defense and Security Regulation'] ?? null)  //nama disesuaikan
            ->first();

        if ($var_2 == null) {
            $var_2 = 0;
        } else {
            $var_2 = $var_2->value;
        }

        $var_3 = DB::table('variables')
            ->join('scenario_data', 'variables.id', '=', 'scenario_data.variable_id')
            ->where('variables.id', $variableIds['Priority Program'] ?? null)  //nama disesuaikan
            ->first();

        # if len naval_capabilities == 0, then naval_capabilities = 0
        if ($var_3 == null) {
            $var_3 = 0;
        }

        $data = [
            'title' => 'Defence and Security | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Defence and Security',
            'first_variable' => $var_1,
            'second_variable' => $var_2,
            'third_variable' => $var_3
        ];
        return view('summary.defence-infrastructure', $data);
    }

    public function details()
    {
        $data = [
            'title' => 'Defence and Security | Details',
            'head_title' => 'Details',
            'breadcrumb_item' => 'Defence and Security',
        ];
        return view('hankam.details', $data);
    }
    public function maps()
    {
        $data = [
            'title' => 'Defence and Security | Maps',
            'head_title' => 'Maps',
            'breadcrumb_item' => 'Defence and Security ',
        ];
        return view('hankam.maps', $data);
    }
    public function threatsMilitary()
    {
        $data = [
            'title' => 'Defence and Security | Military',
            'head_title' => 'Threats Military',
            'breadcrumb_item' => 'Defence and Security ',
        ];
        return view('hankam.threats.military', $data);
    }
    public function threatsNonMilitary()
    {
        $data = [
            'title' => 'Defence and Security | Non Military',
            'head_title' => 'Threats Non Military',
            'breadcrumb_item' => 'Defence and Security ',
        ];
        return view('hankam.threats.non-military', $data);
    }
    public function threatsHybridMilitary()
    {
        $data = [
            'title' => 'Defence and Security | Hybrid Military',
            'head_title' => 'Threats Hybrid Military',
            'breadcrumb_item' => 'Defence and Security ',
        ];
        return view('hankam.threats.hybrid-military', $data);
    }
    public function getSfdVariables($sfdId = null)
    {
        $get_active_model_id = DB::table('models')->where('is_active', 1)->first();

        if ($sfdId) {
            $variables = DB::table('sfd_variable')
                ->join('variables', 'sfd_variable.variable_id', '=', 'variables.id')
                ->select('variables.id', 'variables.name', 'variables.value', 'variables.level', 'variables.key_variable')
                ->where('sfd_variable.sfd_id', $sfdId)
                ->get();
        } else {
            $variables = DB::table('variables')
                ->where('model_id', $get_active_model_id->id)
                ->select('id', 'name', 'value', 'level', 'key_variable')
                ->get();
        }

        return response()->json([
            'variables' => $variables
        ]);
    }

    public function simulationBaseModel()
    {
        $get_active_model = DB::table('models')->where('is_active', 1)->first();
        $image = $get_active_model->image;
        $sfdimage = $get_active_model->sfd;

        // Fetch the list of SFDs for the active model
        $sfdList = DB::table('sfd')->where('model_id', $get_active_model->id)->get();

        $data = [
            'title' => 'Defence and Security | Simulation Base Model',
            'head_title' => 'Base Model',
            'breadcrumb_item' => 'Simulation',
            'sfdList' => $sfdList,
            'image' => $image,
            'sfds' => $sfdimage
        ];

        return view('hankam.simulation.base-model.index', $data);
    }

    public function uploadSfdImage(Request $request)
    {
        $request->validate([
            'sfd' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sfd_id' => 'required|integer|exists:sfd,id',
        ]);

        $sfdId = $request->input('sfd_id');

        $imageName = time() . '.' . $request->sfd->extension();

        try {
            $request->sfd->move(public_path('assets/imageSfd'), $imageName);

            if (!file_exists(public_path('assets/imageSfd/' . $imageName))) {
                return redirect()->back()->with('error', 'File not found after upload.');
            }

            DB::table('sfd')
                ->where('id', $sfdId)
                ->update(['image_path' => 'assets/imageSfd/' . $imageName]);

            return redirect()->back()->with('success', 'SFD image uploaded successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to upload the image. Please try again.');
        }
    }




    public function uploadCldImage(Request $request)
    {
        // Validate the image input
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the active model
        $get_active_model = DB::table('models')->where('is_active', 1)->first();

        if ($get_active_model) {
            // Generate a unique name for the image
            $imageName = time() . '.' . $request->image->extension();

            try {
                // Move the uploaded image to the public directory
                $request->image->move(public_path('assets/imageModels'), $imageName);

                // Save the image path in the 'sfd' column of the active model
                DB::table('models')
                    ->where('id', $get_active_model->id)
                    ->update(['image' => 'assets/imageModels/' . $imageName]);

                return redirect()->back()->with('success', 'SFD image uploaded successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to upload the image. Please try again.');
            }
        }

        return redirect()->back()->with('error', 'No active model found.');
    }

    public function editParameterBaseModel()
    {
        $get_active_model_id = DB::table('models')->where('is_active', 1)->first();

        $dataVariable = Variable::select('id', 'name', 'value', 'level', 'key_variable')->where('model_id', $get_active_model_id->id)->get();
        $data = [
            'title' => 'Defence and Security | Simulation Base Model',
            'head_title' => 'Base Model',
            'breadcrumb_item' => 'Simulation',
            'variable' => $dataVariable
        ];
        return view('hankam.simulation.base-model.edit-parameter', $data);
    }
    public function updateVariableBaseModel(Request $request)
    {
        $validated = $request->validate([
            'values' => 'required|array',
        ]);
        foreach ($validated['values'] as $id => $value) {
            $variable = Variable::find($id);
            if ($variable) {
                $variable->value = $value;
                $variable->save();
            }
        }
        return redirect()->back()->with('success', 'Variables updated successfully.');
    }

    public function uploadModelBaseModel()
    {
        $dataModel = DB::table('models')->select('id', 'name', 'desc', 'pathfile')->get();
        $data = [
            'title' => 'Defence and Security | Simulation Base Model',
            'head_title' => 'Base Model',
            'breadcrumb_item' => 'Simulation',
            'variable' => $dataModel
        ];
        return view('hankam.simulation.base-model.upload-model', $data);
    }

    public function uploadModel(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg']
        ]);

        $file = $request->file('file');
        $fileName = $file->hashName();
        $path = $file->storeAs('uploads', $fileName);

        $fileImage = $request->file('image');
        $imageName = $fileImage->hashName();

        # store to assets/imageModels

        $pathImage = $fileImage->move(public_path('assets/imageModels'), $imageName);


        // $pathImage = $fileImage->storeAs('imageModels', $imageName);

        $new_id = DB::table('models')->insertGetId([
            'name' => $request->name,
            'desc' => $request->desc,
            'pathfile' => $path,
            'image' => 'assets/imageModels/' . $imageName,
            'is_active' => 1
        ]);

        DB::table('models')->where('is_active', 1)->where('id', '!=', $new_id)->update(['is_active' => 0]);

        $scriptPath = public_path('run_model_convert_insert.sh');
        $sourceFile = '../../storage/app/' . $path;
        $model_id = $new_id;
        $command = "./run_model_convert_insert.sh $sourceFile $model_id";
        shell_exec($command);

        return redirect()->route('hankam.simulation.base-model.index')->with('success', 'Model uploaded successfully!');
    }

    public function simulationScenarioModel()
    {
        # join scenarios, sfd, and models
        $scenarios = DB::table('scenarios')
            ->join('sfd', 'scenarios.sfd_id', '=', 'sfd.id')
            ->join('models', 'sfd.model_id', '=', 'models.id')
            ->where('models.is_active', 1)
            ->select('scenarios.id', 'scenarios.name', 'scenarios.desc', 'sfd.name as sfd_name', 'scenarios.timestep', 'scenarios.created_at')
            ->get();

        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
            'scenarios' => $scenarios
        ];
        return view('hankam.simulation.scenario-model.index', $data);
    }
    public function createScenario()
    {
        $model_id = DB::table('models')->where('is_active', 1)->first()->id;
        $rowSfd = Sfd::select('id', 'name')->where('model_id', $model_id)->get();

        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
            'rowSfd' => $rowSfd
        ];
        return view('hankam.simulation.scenario-model.create', $data);
    }


    public function storeScenario(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'sfd_id' => 'required|exists:sfd,id',
            'timestep' => 'required|integer'
        ]);

        try {
            # insert get scenario id
            $scenario_id = DB::table('scenarios')->insertGetId([
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'sfd_id' => $request->input('sfd_id'),
                'timestep' => $request->input('timestep')
            ]);

            # get the variables of the active model
            $dataVariable = DB::table('sfd_variable')
                ->join('variables', 'sfd_variable.variable_id', '=', 'variables.id')
                ->where('sfd_id', $request->input('sfd_id'))
                ->get();

            # insert the variables to scenario_variables
            foreach ($dataVariable as $variable) {
                DB::table('scenario_variables')->insert([
                    'scenario_id' => $scenario_id,
                    'sfd_id' => $request->input('sfd_id'),
                    'variable_id' => $variable->variable_id,
                    'value' => $variable->value,
                    'level' => $variable->level,
                    'unit' => $variable->unit
                ]);
            }

            return redirect()->route('hankam.simulation.scenario-model.index')->with('success', 'Scenario created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('hankam.simulation.scenario-model.createScenario')->with('error', 'Failed to create scenario. Please try again.');
        }
    }
    public function detailScenarioModel($id)
    {
        $scenario = Scenario::findOrFail($id);
        $sfd_id = $scenario->sfd_id;
        $rowSfd = Sfd::select('id', 'name')->where('model_id', 1)->get();

        $dataVariable = DB::table('scenario_variables')
            ->join('variables', 'scenario_variables.variable_id', '=', 'variables.id')
            ->where('scenario_variables.scenario_id', $id)
            ->where('scenario_variables.sfd_id', $sfd_id)
            ->get(['scenario_variables.id', 'variables.name', 'scenario_variables.value', 'scenario_variables.level', 'scenario_variables.unit', 'variables.key_variable']);

        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
            'rowSfd' => $rowSfd,
            'scenario' => $scenario,
            'dataVariable' => $dataVariable,
        ];
        return view('hankam.simulation.scenario-model.detail', $data);
    }


    public function editVariableScenarioModel($id)
    {
        $scenario = Scenario::findOrFail($id);
        $sfd_id = $scenario->sfd_id;
        $rowSfd = Sfd::select('id', 'name')->where('model_id', 1)->get();

        $dataVariable = DB::table('scenario_variables')
            ->join('variables', 'scenario_variables.variable_id', '=', 'variables.id')
            ->where('scenario_variables.scenario_id', $id)
            ->where('scenario_variables.sfd_id', $sfd_id)
            ->get(['scenario_variables.id', 'variables.name', 'scenario_variables.value', 'scenario_variables.level', 'scenario_variables.unit', 'variables.key_variable']);

        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
            'rowSfd' => $rowSfd,
            'scenario' => $scenario,
            'dataVariable' => $dataVariable
        ];

        return view('hankam.simulation.scenario-model.edit', $data);
    }

    public function updateVariableScenarioModel(Request $request, $id)
    {
        try {

            // for each value, get the key as the variable id and the value as the variable value
            $values = $request->input('values');

            // for each value, get the key as the variable id and the value as the variable value
            foreach ($values as $variable_id => $value) {
                // update
                try {
                    DB::table('scenario_variables')
                        ->where('id', $variable_id)
                        ->update(['value' => $value]);
                } catch (\Exception $e) {
                    dd($e);
                }
            }

            return redirect()->route('hankam.simulation.scenario-model.detail', ['id' => $id])
                ->with('success', 'Variables updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update variables. Please try again.');
        }
    }



    public function simulationOutcomeScenario()
    {
        $scenarios = DB::table('scenarios')
            ->join('sfd', 'scenarios.sfd_id', '=', 'sfd.id')
            ->join('models', 'sfd.model_id', '=', 'models.id')
            ->where('models.is_active', 1)
            ->select('scenarios.id', 'scenarios.name', 'scenarios.desc', 'sfd.name as sfd_name', 'scenarios.timestep', 'scenarios.created_at')
            ->get();

        $data = [
            'title' => 'Defence and Security | Simulation Outcome Scenario',
            'head_title' => 'Outcome Scenario',
            'breadcrumb_item' => 'Simulation ',
            'scenarios' => $scenarios
        ];
        return view('hankam.simulation.outcome-scenario.index', $data);
    }
    public function detailOutcomeScenario($id)
    {
        $scenario = Scenario::findOrFail($id);
        $scenarioData = ScenarioData::where('scenario_id', $id)->with('variable')->limit(10)->get();
        $data = [
            'title' => 'Defence and Security | Simulation Outcome Scenario',
            'head_title' => 'Outcome Scenario',
            'breadcrumb_item' => 'Simulation',
            'scenario' => $scenario,
            'scenarioData' => $scenarioData
        ];
        return view('hankam.simulation.outcome-scenario.detail', $data);
    }

    public function createOutcome($id)
    {
        $get_active_model_id = DB::table('models')->where('is_active', 1)->first();

        $dataVariable = Variable::select('id', 'name', 'value', 'level', 'key_variable')->where('model_id', $get_active_model_id->id)
            ->where('key_variable', 1)
            ->get();

        $scenario = Scenario::findOrFail($id);
        $scenarioData = ScenarioData::where('scenario_id', $id)
            ->with('variable')
            ->get()
            ->unique('variable_id');


        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
            'scenario' => $scenario,
            'dataVariable' => $dataVariable,
            'scenarioData' => $scenarioData
        ];
        return view('hankam.simulation.outcome-scenario.create', $data);
    }

    public function storeOutcome(Request $request)
    {

        // Validate the request
        $request->validate([
            'variable_id' => 'required|exists:variables,id',
            'file' => 'required|mimes:xlsx',
            'scenario_id' => 'required|exists:scenarios,id', // Ensure scenario_id is validated
        ]);

        // Retrieve inputs
        $variable_id = $request->input('variable_id');
        $scenario_id = $request->input('scenario_id');

        // Import the file using Laravel Excel
        Excel::import(new ScenarioDataImport($variable_id, $scenario_id), $request->file('file'));

        // Redirect with a success message
        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
