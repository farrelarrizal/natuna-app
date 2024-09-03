@extends('layouts.app')

@section('content')
    @include('partials/breadcrumb')

    <!-- Display the Form -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $form->name }}</h4>
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="form_id" value="{{ $form->id }}">

                        @foreach($form->questions as $index => $question)
                            <div class="mb-3">

                                <p>Question {{ $index + 1 }}</p>
                                <label for="question_{{ $index }}" class="form-label">{{ $question->text }}</label>
                                
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
                </div>
            </div>
        </div>
    </div>
@endsection
