<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;
use App\Models\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HankamController extends Controller
{
    //
    public function summary(){
        $data = [
            'title' => 'Defence and Security | Summary',
            'head_title' => 'Summary',
            'breadcrumb_item' => 'Defence and Security',
        ];
        return view('hankam.summary', $data);
    }
    public function details(){
        $data = [
            'title' => 'Defence and Security | Details',
            'head_title' => 'Details',
            'breadcrumb_item' => 'Defence and Security',
        ];
        return view('hankam.details', $data);
    }
    // public function maps(){
    //     $data = [
    //         'title' => 'Defence and Security | Maps',
    //         'head_title' => 'Maps',
    //         'breadcrumb_item' => 'Defence and Security ',
    //     ];
    //     return view('hankam.maps', $data);
    // }
    public function threatsMilitary(){
        $data = [
            'title' => 'Defence and Security | Military',
            'head_title' => 'Threats Military',
            'breadcrumb_item' => 'Defence and Security ',
        ];
        return view('hankam.threats.military', $data);
    }
    public function threatsNonMilitary(){
        $data = [
            'title' => 'Defence and Security | Non Military',
            'head_title' => 'Threats Non Military',
            'breadcrumb_item' => 'Defence and Security ',
        ];
        return view('hankam.threats.non-military', $data);
    }
    public function threatsHybridMilitary(){
        $data = [
            'title' => 'Defence and Security | Hybrid Military',
            'head_title' => 'Threats Hybrid Military',
            'breadcrumb_item' => 'Defence and Security ',
        ];
        return view('hankam.threats.hybrid-military', $data);
    }
    public function simulationBaseModel(){
        $dataVariable = Variable::select('name', 'value', 'level', 'key_variable')->get();
        $data = [
            'title' => 'Defence and Security | Simulation Base Model',
            'head_title' => 'Base Model',
            'breadcrumb_item' => 'Simulation',
            'variable' => $dataVariable
        ];
        return view('hankam.simulation.base-model.index', $data);
    }
    public function editParameterBaseModel(){
        $dataVariable = Variable::select('id','name', 'value', 'level', 'key_variable')->get();
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
            'values.*' => 'numeric',
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

    public function uploadModelBaseModel(){
        $dataModel = DB::table('models')->select('id','name', 'desc', 'pathfile')->get();
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
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'file' => 'required|file|mimes:txt',
        ]);

        $file = $request->file('file');
        $fileName = $file->hashName();
        $path = $file->storeAs('uploads', $fileName);  

        DB::table('models')->insert([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'pathfile' => $path,
            'is_active' => $request->has('is_active'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('hankam.simulation.base-model.index')->with('success', 'Model uploaded successfully!');       
    }




    public function simulationScenarioModel(){
        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
        ];
        return view('hankam.simulation.scenario-model.index', $data);
    }
    public function detailScenarioModel(){
        $data = [
            'title' => 'Defence and Security | Simulation Scenario Model',
            'head_title' => 'Scenario Model',
            'breadcrumb_item' => 'Simulation',
        ];
        return view('hankam.simulation.scenario-model.detail', $data);
    }
    public function simulationOutcomeScenario(){
        $data = [
            'title' => 'Defence and Security | Simulation Outcome Scenario',
            'head_title' => 'Outcome Scenario',
            'breadcrumb_item' => 'Simulation ',
        ];
        return view('hankam.simulation.outcome-scenario.index', $data);
    }
    public function detailOutcomeScenario(){
        $data = [
            'title' => 'Defence and Security | Simulation Outcome Scenario',
            'head_title' => 'Outcome Scenario',
            'breadcrumb_item' => 'Simulation ',
        ];
        return view('hankam.simulation.outcome-scenario.detail', $data);
    }
}
