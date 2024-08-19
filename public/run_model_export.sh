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

# Activate the virtual environment
source ../venv/bin/activate

# Change directory to python
cd python
# print pwd
pwd
# Run the Python script with the specified arguments
python model-export.py -f=$INPUT_FILE -e=$EXPORT_FILE -t=$TIME -s=$SCENARIO_ID

# Deactivate the virtual environment
deactivate
