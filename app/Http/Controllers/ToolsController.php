<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToolsController extends Controller
{
    public function index()
    {
        $model_id = DB::table('models')->where('is_active', 1)->first()->id;
        $variables = Variable::where('model_id', $model_id)->get();
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

    public function recommendation()
    {
        $data = [
            'title' => 'Tools | Recommendation',
            'head_title' => 'Recommendation',
            'breadcrumb_item' => 'Tools',
        ];
        return view('tools.recommendation.index', $data);
    }

    public function createRecommendation()
    {
        $data = [
            'title' => 'Tools | Recommendation',
            'head_title' => 'Add Recommendation',
            'breadcrumb_item' => 'Tools',
        ];
        return view('tools.recommendation.create', $data);
    }

    public function editRecommendation($id)
    {
        $data = [
            'title' => 'Tools | Recommendation',
            'head_title' => 'Edit Recommendation',
            'breadcrumb_item' => 'Tools',
        ];
        return view('tools.recommendation.edit', $data);
    }

    public function showRecommendation($id)
    {
        $data = [
            'title' => 'Tools | Recommendation',
            'head_title' => 'Recommendation',
            'breadcrumb_item' => 'Tools',
        ];
        return view('tools.recommendation.show', $data);
    }
}
