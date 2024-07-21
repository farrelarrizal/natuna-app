<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function index()
    {
        $variables = Variable::all();
        $data = [
            'title' => 'Tools | Key Variable',
            'head_title' => 'Key Variable',
            'breadcrumb_item' => 'Tools',
        ];
        return view('tools.key-variable.index', compact('variables'), $data);
    }
    public function show(Variable $variable)
    {
        $data = [
            'title' => 'Tools | Key Variable',
            'head_title' => 'Key Variable',
            'breadcrumb_item' => 'Tools',
        ];
        return view('tools.key-variable.show', compact('variable'), $data);
    }


    public function edit($id)
    {
        $variable = Variable::find($id);
        $data = [
            'title' => 'Tools | Key Variable',
            'head_title' => 'Key Variable',
            'breadcrumb_item' => 'Tools',
            'variable' => $variable,
        ];
    
        return view('tools.key-variable.edit')->with($data);
    }
    
    public function update(Request $request, Variable $variable)
    {
        $request->validate([
            'model_id' => 'required|integer',
            'name' => 'required|string',
            'key_variable' => 'boolean',
        ]);

        $data = $request->only(['model_id', 'name', 'key_variable']);
        if (!isset($data['key_variable'])) {
            $data['key_variable'] = false;
        }

        $variable->update($data);

        return redirect()->route('tools.key-variable.index')->with('success', 'Variable updated successfully.');
    }

}
