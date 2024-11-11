@echo off

REM Check if the correct number of arguments are provided
IF "%~2"=="" (
    echo Usage: %~nx0 ^<source_file^> ^<model_id^>
    exit /b 1
)

REM Assign arguments to variables
SET "SOURCE_FILE=%~1"
SET "MODEL_ID=%~2"

REM Activate the virtual environment
echo Activating virtual environment...
call ..\venv\Scripts\activate
echo Virtual environment activated.

REM Change to the python directory
cd python

REM Run the Python script with the specified arguments
python model-convert.py -f "%SOURCE_FILE%" -m "%MODEL_ID%"

REM Deactivate the virtual environment
echo Deactivating virtual environment...
deactivate
echo Virtual environment deactivated.

pause
