@extends('layouts.app')

@section('content')
    @include('partials/breadcrumb')

    <!-- form -->
    <div class="row">
        <div class="col-sm-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('forms.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Survey Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <!-- drop down -->
                        <div class="mb-3">
                            <label for="choices-sfd" class="form-label">SFD Name</label>
                            <select class="form-control" name="sfd_name" id="choices-sfd">
                                <option value="">SFD record</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="4"></textarea>
                        </div>
                        <!-- add separator line -->
                        <hr>
                        <br>

                        <!-- Dynamic Questions Section -->
                        <div id="dynamic-question-container">
                            <div class="mb-3 question-item">
                                <label for="question_1" class="form-label">Question 1</label>
                                <textarea class="form-control" id="question_1" name="questions[1][question]" rows="3"></textarea>

                                <label for="choices-single-remove-1" class="form-label mt-2">Question 1 has relation with variable key:</label>
                                <select class="form-control" name="questions[1][key]" id="choices-single-remove-1">
                                    <option value="">Variable's record</option>
                                </select>
                              
                                <div class="form-check mt-2">
                                    <input class="form-check-input scalar-checkbox" type="checkbox" id="is_scalar_1" name="questions[1][is_scalar]">
                                    <label class="form-check-label" for="is_scalar_1">
                                        Is this a scalar question?
                                    </label>
                                </div>
                               
                                <div class="scalar-options mt-2" style="display:none;">
                                    <label for="max_value_1" class="form-label">Set maximum value:</label>
                                    <input type="number" class="form-control" id="max_value_1" name="questions[1][max_value]" min="2">
                                </div>
                                <button type="button" class="btn btn-danger remove-question mt-2">Remove</button>
                            </div>
                        </div>
                        <div>

                            <button type="button" class="btn btn-secondary" id="add-question">Add Question</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= asset('assets/js/plugins/choices.min.js') ?>"></script>
    <script>
       // In your Javascript (external .js resource or <script> tag)
        
        document.addEventListener('DOMContentLoaded', function () {
            let questionCounter = 1;

            // Function to show or hide scalar options
            function toggleScalarOptions(questionId, isScalar) {
                const scalarOptionsContainer = document.querySelector(`#is_scalar_${questionId}`).closest('.question-item').querySelector('.scalar-options');
                scalarOptionsContainer.style.display = isScalar ? 'block' : 'none';
                if (!isScalar) {
                    document.getElementById(`max_value_${questionId}`).value = ''; // Reset max value
                }
            }

            // Function to initialize Choices.js for a specific select element
            function initializeChoices(questionCounter) {
                new Choices(`#choices-single-remove-${questionCounter}`, {
                    removeItemButton: true,
                    searchPlaceholderValue: "Search for a variable",
                }).setChoices(function () {
                    return fetch('http://127.0.0.1:8000/api/search-variables')
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (data) {
                            return data.map(function (item) {
                                return {
                                    label: item.label,  // Displayed label
                                    value: item.value,  // Value to be submitted
                                };
                            });
                        })
                        .catch(function (error) {
                            console.error('Error fetching data:', error);
                        });
                });
            }

            // Add new question
            document.getElementById('add-question').addEventListener('click', function () {
                questionCounter++;
                const questionContainer = document.getElementById('dynamic-question-container');
                const newQuestionDiv = document.createElement('div');
                newQuestionDiv.classList.add('mb-3', 'question-item');
                newQuestionDiv.innerHTML = `
                    <label for="question_${questionCounter}" class="form-label">Question ${questionCounter}</label>
                    <textarea class="form-control" id="question_${questionCounter}" name="questions[${questionCounter}][question]" rows="3"></textarea>
                    
                    <label for="choices-single-remove-${questionCounter}" class="form-label mt-2">Question ${questionCounter} has relation with variable key:</label>
                    <select class="form-control" name="questions[${questionCounter}][key]" id="choices-single-remove-${questionCounter}">
                        <option value="">Variable's record</option>
                    </select>

                    <div class="form-check mt-2">
                        <input class="form-check-input scalar-checkbox" type="checkbox" id="is_scalar_${questionCounter}" name="questions[${questionCounter}][is_scalar]">
                        <label class="form-check-label" for="is_scalar_${questionCounter}">
                            Is this a scalar question?
                        </label>
                    </div>

                    <div class="scalar-options mt-2" style="display:none;">
                        <label for="max_value_${questionCounter}" class="form-label">Set maximum value:</label>
                        <input type="number" class="form-control" id="max_value_${questionCounter}" name="questions[${questionCounter}][max_value]" min="2">
                    </div>

                    <button type="button" class="btn btn-danger remove-question mt-2">Remove</button>
                `;
                questionContainer.appendChild(newQuestionDiv);

                // Initialize Choices.js for the new select element
                initializeChoices(questionCounter);

                // Add event listener for scalar checkbox toggle
                document.getElementById(`is_scalar_${questionCounter}`).addEventListener('change', function () {
                    toggleScalarOptions(questionCounter, this.checked);
                });
            });

            // Remove a question
            document.getElementById('dynamic-question-container').addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-question')) {
                    e.target.closest('.question-item').remove();
                }
            });

            // Handle existing scalar checkbox toggle
            document.querySelectorAll('.scalar-checkbox').forEach(function (element) {
                element.addEventListener('change', function () {
                    const questionId = this.id.split('_')[2];
                    toggleScalarOptions(questionId, this.checked);
                });
            });

            // Initialize Choices.js for the existing select element
            initializeChoices(questionCounter);

            var sfdSearch = new Choices('#choices-sfd', {
                removeItemButton: true,
                searchPlaceholderValue: "Search for a SFD",
            }).setChoices(function () {
                return fetch('http://127.0.0.1:8000/api/search-sfd')
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        return data.map(function (item) {
                            return {
                                label: item.label,  // Displayed label
                                value: item.value,  // Value to be submitted
                            };
                        });
                    })
                    .catch(function (error) {
                        console.error('Error fetching data:', error);
                    });
            });

        });

    </script>
    
@endsection
