@extends('layouts.app')

@section('content')
    @include('partials/breadcrumb')

    <!-- Display the Form -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                {{-- <div class="card-body">
                    @foreach ($forms as $form)
                    <h4>{{ $form->name }}</h4>
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="form_id" value="{{ $form->id }}">

                        @foreach ($form->questions as $question)
                            <div class="mb-3">

                                <p>Question {{ $index + 1 }}</p>
                                <label for="question_{{ $index }}" class="form-label">{{ $question->question }}</label>
                                
                                @if($question->is_scalar)
                                    <div class="d-flex flex-wrap">
                                        @for($i = 1; $i <= $question->max_value; $i++)
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="responses[{{ $index }}]" id="question_{{ $index }}_option_{{ $i }}" value="{{ $i }}" required>
                                                <label class="form-check-label" for="question_{{ $index }}_option_{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                @else
                                    <textarea class="form-control" id="question_{{ $index }}" name="responses[{{ $index }}]" rows="3" required></textarea>
                                @endif
                                <br>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Submit Responses</button>
                    </form>
                    @foreach ($forms as $form)
                </div> --}}
                <div class="card-body">
                    @foreach ($forms as $form)
                        <h4>{{ $form->name }}</h4>
                        <form action="{{route('forms.storeAnswer')}}" method="POST">
                            @csrf
                            <input type="hidden" name="form_id" value="{{ $form->id }}">
                        
                            @foreach ($form->questions as $index => $question)
                                <div class="mb-3">
                                    <p>Question {{ $index + 1 }}</p>
                                    <label for="question_{{ $index }}" class="form-label">{{ $question->question }}</label>
                        
                                    {{-- Include the question ID with the input name --}}
                                    @if($question->max_value)
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
