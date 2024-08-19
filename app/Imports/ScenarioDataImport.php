<?php

namespace App\Imports;

use App\Models\ScenarioData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScenarioDataImport implements ToModel, WithHeadingRow
{
    private $variable_id;
    private $scenario_id;

    public function __construct($variable_id, $scenario_id)
    {
        $this->variable_id = $variable_id;
        $this->scenario_id = $scenario_id;
    }

    public function model(array $row)
    {
        return new ScenarioData([
            'scenario_id' => $this->scenario_id,
            'variable_id' => $this->variable_id,
            'node_point' => $row['time'],
            'value' => $row['value'],
        ]);
    }
}
