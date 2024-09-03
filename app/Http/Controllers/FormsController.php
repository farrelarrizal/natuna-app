<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormsController extends Controller
{
    // index
    public function index()
    {
        $data = [
            'title' => 'Forms',
            'head_title' => 'Expert Survey - Forms',
            'breadcrumb_item' => 'Forms',
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

    public function show($id)
    {
        // Example questions and responses data, typically retrieved from the database
        $questions = [
            ['id' => 1, 'text' => 'Seberapa sering Probability of Social Media Threats di Laut Natuna Utara Indonesia?', 'key' => 'Probability of Social Media Threats'],
            ['id' => 2, 'text' => 'What is your birth year?', 'key' => 'birth_year'],
        ];

        $responses = [
            ['question_id' => 1, 'answer' => 'Blue'],
            ['question_id' => 1, 'answer' => 'Red'],
            ['question_id' => 2, 'answer' => '1990'],
        ];

        // Group responses by question ID
        $groupedResponses = [];
        foreach ($responses as $response) {
            $groupedResponses[$response['question_id']][] = $response['answer'];
        }

        // Additional data for the view
        $data = [
            'title' => 'Forms',
            'head_title' => 'Expert Survey - Forms',
            'breadcrumb_item' => 'Forms',
            'questions' => $questions,  // Add questions to the data array
            'groupedResponses' => $groupedResponses,  // Add grouped responses to the data array
        ];

        // Pass the data array to the view
        return view('forms.show', $data);
    }

    public function showForm($id)
    {
        // Dummy form data
        $form = new \stdClass();
        $form->id = $id;
        $form->name = 'Sample Form';

        // Dummy questions
        $form->questions = collect([
            (object)[
                'text' => 'How satisfied are you with our service?',
                'is_scalar' => true,
                'max_value' => 5
            ],
            (object)[
                'text' => 'What did you like most about our service?',
                'is_scalar' => false
            ]
        ]);

        return view('forms.form', [
            'title' => 'Fill Form',
            'head_title' => 'Fill Out Form',
            'breadcrumb_item' => 'Fill Form',
            'form' => $form
        ]);
    }
}
