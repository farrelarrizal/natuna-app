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

# Display the provided arguments
echo "Input file: $INPUT_FILE"
echo "Export file: $EXPORT_FILE"
echo "Time: $TIME"
echo "Scenario ID: $SCENARIO_ID"

# Activate the virtual environment
VENV_PATH="../venv/bin/activate"
if [ -f "$VENV_PATH" ]; then
    echo "Activating virtual environment..."
    source "$VENV_PATH"
else
    echo "Error: Virtual environment not found at $VENV_PATH"
    exit 1
fi

# Change to the 'python' directory
PYTHON_DIR="python"
if [ -d "$PYTHON_DIR" ]; then
    echo "Changing directory to $PYTHON_DIR..."
    cd "$PYTHON_DIR" || exit 1
else
    echo "Error: Directory '$PYTHON_DIR' not found!"
    exit 1
fi

# Print the current directory for debugging purposes
echo "Current directory: $(pwd)"

# Run the Python script with the specified arguments
PYTHON_SCRIPT="model-export.py"
if [ -f "$PYTHON_SCRIPT" ]; then
    echo "Running $PYTHON_SCRIPT with arguments:"
    echo "- Input file: $INPUT_FILE"
    echo "- Export file: $EXPORT_FILE"
    echo "- Time: $TIME"
    echo "- Scenario ID: $SCENARIO_ID"
    
    python3 "$PYTHON_SCRIPT" -f="$INPUT_FILE" -e="$EXPORT_FILE" -t="$TIME" -s="$SCENARIO_ID"
    if [ $? -ne 0 ]; then
        echo "Error: Python script execution failed!"
        exit 1
    fi
else
    echo "Error: Python script '$PYTHON_SCRIPT' not found in $(pwd)!"
    exit 1
fi

# Deactivate the virtual environment if it was activated
if [ -n "$VIRTUAL_ENV" ]; then
    echo "Deactivating virtual environment..."
    deactivate
fi

echo "Script execution completed successfully!"
