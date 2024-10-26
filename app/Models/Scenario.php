<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    use HasFactory;
    protected $table = 'scenarios';
    protected $fillable = ['sfd_id', 'name', 'desc', 'timestep'];

    public function sfd()
    {
        return $this->belongsTo(Sfd::class, 'sfd_id');
    }

    public function scenarioData()
    {
        return $this->hasMany(ScenarioData::class);
    }
}
