@extends('layouts.app')

@section('content')
    @include('partials/breadcrumb')

    <!-- Display the Form -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $forms[0]->name }}</h4>
                    <!-- HTML Parsing -->
                    <p>{!! $forms[0]->description !!}</p>
                </div>
                <div class="card-body">
                    @foreach ($forms as $form)
                        <form action="{{route('forms.storeAnswer')}}" method="POST">
                            @csrf
                            <input type="hidden" name="form_id" value="{{ $form->id }}">
                        
                            @foreach ($form->questions as $index => $question)
                                <div class="mb-3 text-black">
                                    <p>Question {{ $index + 1 }}</p>
                                    <label for="question_{{ $index }}" class="form-label text-lg">{{ $question->question }}</label>
                        
                                    {{-- Include the question ID with the input name --}}
                                    @if($question->max_value)
                                    <div class="d-flex flex-wrap align-items-center">
                                        {{-- Min label --}}
                                        <div class="me-2">
                                            <label>{{ $question->min_label ?? 'Min' }}</label>
                                        </div>
                                        
                                        {{-- Radio buttons for scalar question --}}
                                        <div class="d-flex flex-wrap">
                                            @for($i = 1; $i <= $question->max_value; $i++)
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="question_{{ $index }}_option_{{ $i }}" value="{{ $i }}" required>
                                                    <label class="form-check-label" for="question_{{ $index }}_option_{{ $i }}">
                                                        {{ $i }}
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>

                                        {{-- Max label --}}
                                        <div class="ms-2">
                                            <label>{{ $question->max_label ?? 'Max' }}</label>
                                        </div>
                                    </div>
                                    @else
                                    {{-- If the question is not scalar (uses textarea) --}}
                                    <textarea class="form-control" id="question_{{ $index }}" name="answers[{{ $question->id }}]" rows="3" required></textarea>
                                    @endif

                                    <br>
                                </div>
                            @endforeach
                        
                            <button type="submit" class="btn btn-primary">Submit Responses</button>
                        </form>
                        
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
@endsection
