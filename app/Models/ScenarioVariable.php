<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScenarioVariable extends Model
{
    use HasFactory;
    protected $table = 'scenario_variables';
    protected $fillable = ['scenario_id','sfd_id', 'variable_id', 'value', 'level', 'unit'];
    
    public function scenario()
    {
        return $this->belongsTo(Scenario::class, 'scenario_id');
    }

    public function variable()
    {
        return $this->belongsTo(Variable::class, 'variable_id');
    }

    public function sfd()
    {
        return $this->belongsTo(Variable::class, 'sfd_id');
    }
}
