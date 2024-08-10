<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;
use App\Models\Models;
use App\Models\Sfd;
use App\Models\Scenario;
use App\Models\ScenarioData;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Imports\ScenarioDataImport;
use Maatwebsite\Excel\Facades\Excel;

class HankamController extends Controller
{
    //
    public function summary()
    {
        $data = [
            'title' => 'Defence and Security | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Defence and Security',
        ];
        return view('hankam.summary', $data);
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

        $dataVariable = Variable::select('name', 'value', 'level', 'key_variable')->where('model_id', $get_active_model_id->id)->get();
        $data = [
            'title' => 'Defence and Security | Simulation Base Model',
            'head_title' => 'Base Model',
            'breadcrumb_item' => 'Simulation',
            'variable' => $dataVariable
        ];
        return view('hankam.simulation.base-model.index', $data);
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
            'image' => ['file', 'required']
        ]);

        $file = $request->file('file');
        $fileName = $file->hashName();
        $path = $file->storeAs('uploads', $fileName);

        $fileImage = $request->file('image');
        $imageName = $fileImage->hashName();
        $pathImage = $fileImage->storeAs('imageModels', $imageName);

        $new_id = DB::table('models')->insertGetId([
            'name' => $request->name,
            'desc' => $request->desc,
            'pathfile' => $path,
            'image' => $pathImage,
            'is_active' => 1
        ]);

        DB::table('models')->where('is_active', 1)->where('id', '!=', $new_id)->update(['is_active' => 0]);

        $scriptPath = public_path('run_model_convert_insert.sh');
        $sourceFile = '../../storage/app/' . $path;
        $model_id = $new_id;
        // dd($scriptPath, $sourceFile, $model_id);
        $command = "sh $scriptPath $sourceFile $model_id";

        // Construct the command string
        $command = escapeshellcmd("sh $scriptPath '$sourceFile' $model_id");

        // Execute the shell script
        shell_exec($command);

        return redirect()->route('hankam.simulation.base-model.index')->with('success', 'Model uploaded successfully!');
    }

    public function simulationScenarioModel()
    {
        $scenarios = Scenario::join('sfd', 'scenarios.sfd_id', '=', 'sfd.id')
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
    public function detailScenarioModel()
    {
        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
        ];
        return view('hankam.simulation.scenario-model.detail', $data);
    }

    public function simulationOutcomeScenario()
    {
        $scenarios = Scenario::with('sfd')->get();
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
  
    public function createOutcome($id){
        $get_active_model_id = DB::table('models')->where('is_active', 1)->first();

        $dataVariable = Variable::select('id','name', 'value', 'level', 'key_variable')->where('model_id', $get_active_model_id->id)->get();

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

    public function storeOutcome(Request $request) {
        
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
