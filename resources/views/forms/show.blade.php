@extends('layouts.app')

@section('content')
    @include('partials/breadcrumb')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- Section 1: List of Questions and Grouped Responses -->
                    <h4 class="mb-3">Survey Questions & Responses</h4>
                    <ul class="list-group mb-4">
                        @foreach($questions as $question)
                            <li class="list-group-item">
                                <strong>Question:</strong> {{ $question['text'] }} <br>
                                <strong>Key Variable:</strong> {{ $question['key'] }}

                                <!-- Section 2: Responses Grouped by Question -->
                                <ul class="mt-2">
                                    @if(isset($groupedResponses[$question['id']]))
                                        @foreach($groupedResponses[$question['id']] as $answer)
                                            <li>{{ $answer }}</li>
                                        @endforeach
                                    @else
                                        <li>No responses for this question</li>
                                    @endif
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
