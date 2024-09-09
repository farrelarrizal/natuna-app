<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormsController extends Controller
{
    // index
    public function index()
    {
        $forms = DB::table('forms')->where('is_active', 1)->get();

        $data = [
            'title' => 'Forms',
            'head_title' => 'Expert Survey - Forms',
            'breadcrumb_item' => 'Forms',
            'survey' => $forms,
        ];

        return view('forms.index', $data);
    }

    // create
    public function create()
    {
        $data = [
            'title' => 'Create Form',
            'head_title' => 'Expert Survey - Create Form',
            'breadcrumb_item' => 'Create Form',
        ];

        return view('forms.create', $data);
    }
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sfd_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.key' => 'required',
            'questions.*.max_value' => 'nullable',
            'questions.*.min_label' => 'string|max:255',
            'questions.*.max_label' => 'string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $formId = DB::table('forms')->insertGetId([
                'name' => $validatedData['name'],
                'sfd_name' => $validatedData['sfd_name'],
                'description' => $validatedData['description'],
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $questionsData = [];
            foreach ($validatedData['questions'] as $questionData) {
                $questionsData[] = [
                    'form_id' => $formId,
                    'question' => $questionData['question'], // Sesuaikan field ini
                    'max_value' => $questionData['max_value'] ?? 5, // Set max_value sebagai null jika tidak ada
                    'has_realational_to_variable' => $questionData['key'], // Sesuaikan field ini
                    'min_label' => $questionData['min_label'] ?? 'Minimal', // Set min_label sebagai null jika tidak ada
                    'max_label' => $questionData['max_label'] ?? 'Maximal', // Set max_label sebagai null jika tidak ada
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('question')->insert($questionsData);
            DB::commit();

            return redirect()->route('forms.index')->with('suceess', 'Data has been created');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create form and questions',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function show($id)
    {
        $questions = DB::table('question')
            ->join('forms', 'forms.id', '=', 'question.form_id')
            ->join('variables', 'variables.id', '=', 'question.has_realational_to_variable')
            ->leftJoin('answers', 'answers.question_id', '=', 'question.id')
            ->where('question.form_id', $id)
            ->select(
                'question.id as question_id',
                'question.question as name_question',
                'variables.name as name_variable',
                'question.max_value',
                'answers.value as answer_value',
                'question.min_label as min_label',
                'question.max_label as max_label',
                'forms.description'
            )
            ->get();

        $groupedResponses = [];
        foreach ($questions as $question) {
            $groupedResponses[$question->question_id]['question'] = $question->name_question;
            $groupedResponses[$question->question_id]['variable'] = $question->name_variable;
            $groupedResponses[$question->question_id]['max_value'] = $question->max_value;
            $groupedResponses[$question->question_id]['answers'][] = $question->answer_value;
            $groupedResponses[$question->question_id]['min_label'] = $question->min_label;
            $groupedResponses[$question->question_id]['max_label'] = $question->max_label;
        }

        $data = [
            'title' => 'Forms',
            'head_title' => 'Expert Survey - Forms',
            'breadcrumb_item' => 'Forms',
            'questions' => $question,  
            'groupedResponses' => $groupedResponses,  
        ];

        return view('forms.show', $data);
    }

    public function showForm($id)
    {

        $forms = DB::table('forms')->where('id', $id)->get();

        foreach ($forms as $form) {
            $form->questions = DB::table('question')
                ->where('form_id', $form->id)
                ->get();
        }
        // return $forms;
        // $form = new \stdClass();
        // $form->id = $id;
        // $form->name = $form ;
        // Dummy questions
        // return $form;

        // $form->questions = collect([
        //     (object)[
        //         'text' => 'How satisfied are you with our service?',
        //         'is_scalar' => true,
        //         'max_value' => 5
        //     ],
        //     (object)[
        //         'text' => 'What did you like most about our service?',
        //         'is_scalar' => false
        //     ]
        // ]);

        return view('forms.form', [
            'title' => 'Fill Form',
            'head_title' => 'Fill Out Form',
            'breadcrumb_item' => 'Fill Form',
            'forms' => $forms
        ]);
    }
    public function storeAnswer(Request $request)
    {
        $form_id = $request->input('form_id');
        $answers = $request->input('answers');

        foreach ($answers as $question_id => $value) {
            DB::table('answers')->insert([
                'question_id' => $question_id,
                'user_id' => Auth::id(),
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        return redirect()->route('forms.index')->with('success', 'Answers submitted successfully.');

    }
    public function edit($id)
    {
        $forms = DB::table('forms')
        ->join('question', 'question.form_id', '=', 'forms.id')
        ->select(
            'forms.id as form_id',
            'forms.name',
            'forms.sfd_name',
            'forms.description',
            'question.question',
            'question.max_value',
            'question.has_realational_to_variable',
            'question.max_label'
        )
        ->where('forms.id', $id)
        ->get();
        
        $forms;
        $response = [];

        foreach ($forms as $form) {
            if (!isset($response[$form->form_id])) {
                $response[$form->form_id] = [
                    'id' => $form->form_id,
                    'name' => $form->name,
                    'sfd_name' => $form->sfd_name,
                ];
            }

            $response[$form->form_id]['question'][] = [
                'form_id' => $form->form_id,
                'question' => $form->question,
                'max_value' => $form->max_value,
                'has_realational_to_variable' => $form->has_realational_to_variable,
                'max_label' => $form->max_label
            ];
        }

        $response = array_values($response);
        // return $response;
        $data = [
            'title' => 'Forms',
            'head_title' => 'Expert Survey - Forms',
            'breadcrumb_item' => 'Forms',
            'survey' => $response,
        ];

        return view('forms.edit', $data);
    }
  }
