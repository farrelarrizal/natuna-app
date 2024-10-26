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
                        @foreach($groupedResponses as $response)
                            <li class="list-group-item">
                                <strong>Question:</strong> {{ $response['question'] }} <br>
                                <strong>Key Variable:</strong> {{ $response['variable'] }}
                                
                                <ul class="mt-2">
                                    @if(isset($response['max_value']) && $response['max_value'])
                                        @foreach ($response['answers'] as $answer)
                                            <li>{{ $answer }} / {{ $response['max_value'] }}</li>
                                        @endforeach
                                    @else
                                        @foreach ($response['answers'] as $answer)
                                            <li>{{ $answer }}</li>
                                        @endforeach
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
