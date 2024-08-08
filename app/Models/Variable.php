<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    use HasFactory;
    protected $fillable = ['model_id','name', 'value', 'level', 'unit', 'key_variable'];

    public function modelSD()
    {
        return $this->belongsTo(ModelSD::class, 'model_id');
    }

    public function scenarioData()
    {
        return $this->hasMany(ScenarioData::class);
    }
    public function scenarioVariables()
    {
        return $this->hasMany(ScenarioVariable::class);
    }
    public function sfdVariables()
    {
        return $this->hasMany(SfdVariable::class);
    }
}
