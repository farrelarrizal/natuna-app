#!/bin/bash

# Function to display usage information
usage() {
    echo "Usage: $0 -f <input_file> -e <export_file> -t <time> -s <scenario_id>"
    exit 1
}

# Parse command-line arguments
while getopts "f:e:t:s:" opt; do
    case $opt in
        f) INPUT_FILE=$OPTARG ;;
        e) EXPORT_FILE=$OPTARG ;;
        t) TIME=$OPTARG ;;
        s) SCENARIO_ID=$OPTARG ;;
        *) usage ;;
    esac
done

# Check if all arguments are provided
if [ -z "$INPUT_FILE" ] || [ -z "$EXPORT_FILE" ] || [ -z "$TIME" ] || [ -z "$SCENARIO_ID" ]; then
    usage
fi
echo "Input file: $INPUT_FILE"
echo "Export file: $EXPORT_FILE"
echo "Time: $TIME"
echo "Scenario ID: $SCENARIO_ID"

# Activate the virtual environment
if [ -f "../venv/bin/activate" ]; then
    source ../venv/bin/activate
else
    echo "Virtual environment not found!"
    exit 1
fi

# Change directory to python folder
if [ -d "python" ]; then
    cd python
else
    echo "Directory 'python' not found!"
    exit 1
fi

# Print current directory for debug purposes
pwd

# Run the Python script with the specified arguments
echo "Running model-export.py with:"
echo "Input file: $INPUT_FILE"
echo "Export file: $EXPORT_FILE"
echo "Time: $TIME"
echo "Scenario ID: $SCENARIO_ID"

python model-export.py -f=$INPUT_FILE -e=$EXPORT_FILE -t=$TIME -s=$SCENARIO_ID
if [ $? -ne 0 ]; then
    echo "Python script failed!"
    exit 1
fi

# Deactivate the virtual environment if it was activated
if [ -n "$VIRTUAL_ENV" ]; then
    deactivate
fi
