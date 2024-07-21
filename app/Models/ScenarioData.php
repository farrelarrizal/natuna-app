<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScenarioData extends Model
{
    use HasFactory;
    protected $fillable = ['scenario_id', 'variable_id', 'node_point', 'value'];

    public function scenario()
    {
        return $this->belongsTo(Scenario::class, 'scenario_id');
    }

    public function variable()
    {
        return $this->belongsTo(Variable::class, 'variable_id');
    }
}
