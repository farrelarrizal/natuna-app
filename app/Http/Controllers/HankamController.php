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
            'title' => 'Defence and Security | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Defence and Security',
            'naval_strength' => $naval_strength,
            'naval_deployment' => $naval_deployment,
            'naval_capabilities' => $naval_capabilities
        ];

        return view('summary.hankam', $data);
    }
    public function infraSummary()
    {
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
            'title' => 'Defence Infrastructure | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Defence Infrastructure',
            'naval_strength' => $naval_strength,
            'naval_deployment' => $naval_deployment,
            'naval_capabilities' => $naval_capabilities
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
    public function simulationBaseModel()
    {
        $get_active_model_id = DB::table('models')->where('is_active', 1)->first();
        $image = $get_active_model_id->image;
        $sfdimage = $get_active_model_id->sfd;

        if (Auth::user()->role == 'SUPERADMIN') {
            $dataVariable = Variable::select('id', 'name', 'value', 'level', 'key_variable')->where('model_id', $get_active_model_id->id)->get();
        } else {
            $dataVariable = Variable::select('name', 'value', 'level', 'key_variable')->where('model_id', $get_active_model_id->id)->where('key_variable', 1)->get();
        }
        $data = [
            'title' => 'Defence and Security | Simulation Base Model',
            'head_title' => 'Base Model',
            'breadcrumb_item' => 'Simulation',
            'variable' => $dataVariable,
            'image' => $image,
            'sfd' => $sfdimage
        ];
        return view('hankam.simulation.base-model.index', $data);
    }
    public function uploadSfdImage(Request $request)
    {
        // Validate the image input
        $request->validate([
            'sfd' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Get the active model
        $get_active_model = DB::table('models')->where('is_active', 1)->first();
    
        if ($get_active_model) {
            // Generate a unique name for the image
            $imageName = time() . '.' . $request->sfd->extension();
    
            try {
                // Move the uploaded image to the public directory
                $request->sfd->move(public_path('assets/imageSfd'), $imageName);
    
                // Save the image path in the 'sfd' column of the active model
                DB::table('models')
                    ->where('id', $get_active_model->id)
                    ->update(['sfd' => 'assets/imageSfd/' . $imageName]);
    
                return redirect()->back()->with('success', 'SFD image uploaded successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to upload the image. Please try again.');
            }
        }
    
        return redirect()->back()->with('error', 'No active model found.');
    }

    // public function getVariablesBySFD(Request $request)
    // {
    //     $sfdId = $request->sfdId;

    //     $variables = DB::table('sfd_variables')
    //             ->join('variables', 'sfd_variables.variable_id', '=', 'variables.id') 
    //             ->where('sfd_variables.sfd_id', $sfdId)
    //             ->select('variables.*') 
    //             ->get();

    //     $html = view('partials.variables', compact('variables'))->render();

    //     return response()->json(['html' => $html]);
    // }


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
        // dd($scriptPath, $sourceFile, $model_id);
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
            Scenario::create([
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'sfd_id' => $request->input('sfd_id'),
                'timestep' => $request->input('timestep')
            ]);

            return redirect()->route('hankam.simulation.scenario-model.createScenario')->with('success', 'Scenario created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('hankam.simulation.scenario-model.createScenario')->with('error', 'Failed to create scenario. Please try again.');
        }
    }
    public function detailScenarioModel($id)
    {
        $model_id = DB::table('models')->where('is_active', 1)->first()->id;
        $rowSfd = Sfd::select('id', 'name')->where('model_id', $model_id)->get();
        $scenario = Scenario::findOrFail($id);
        $get_active_model_id = DB::table('models')->where('is_active', 1)->first();
        $dataVariable = Variable::select('id', 'name', 'value', 'level', 'key_variable')->where('model_id', $get_active_model_id->id)->get();

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
        $model_id = DB::table('models')->where('is_active', 1)->first()->id;
        $rowSfd = Sfd::select('id', 'name')->where('model_id', $model_id)->get();
        $scenario = Scenario::findOrFail($id);
        $get_active_model_id = DB::table('models')->where('is_active', 1)->first();

        $dataVariable = Variable::select('id', 'name', 'value', 'level', 'key_variable')
            ->where('model_id', $get_active_model_id->id)
            ->get();

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
            $validatedScenario = $request->validate([
                'name' => 'required|string|max:255',
                'desc' => 'required|string',
                'sfd_id' => 'required|exists:sfd,id',
                'timestep' => 'required|integer',
            ]);
            $model_id = DB::table('models')->where('is_active', 1)->first()->id;

            $scenario = Scenario::findOrFail($id);
            $scenario->update($validatedScenario);

            foreach ($request->input('values', []) as $variableId => $value) {
                $variable = Variable::where('model_id', $model_id)->find($variableId);

                if ($variable) {
                    $variable->value = $value;
                    $variable->save();
                } else {
                    return redirect()->back()->withErrors(['error' => 'Invalid variable ID: ' . $variableId]);
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
        $scenarioData = ScenarioData::where('scenario_id', $id)->with('variable')->get();
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
