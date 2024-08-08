#!/bin/bash

# Check if the correct number of arguments are provided
if [ "$#" -ne 2 ]; then
    echo "Usage: $0 <source_file> <model_id>"
    exit 1
fi

# Assign arguments to variables
SOURCE_FILE=$1
MODEL_ID=$2

# Activate the virtual environment
echo "Activating virtual environment..."
source ../venv/bin/activate
echo "Virtual environment activated."

# show pwd
cd python

# Run the Python script with the specified arguments
python model-convert.py -f "$SOURCE_FILE" -m "$MODEL_ID"

# Deactivate the virtual environment
echo "Deactivating virtual environment..."
deactivate
echo "Virtual environment deactivated."
