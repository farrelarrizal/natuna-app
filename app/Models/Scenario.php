<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int|null $sfd_id
 * @property string $name
 * @property string|null $desc
 * @property int|null $timestep
 */
class Scenario extends Model
{
    use HasFactory;

    protected $table = 'scenarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'sfd_id',
        'name',
        'desc',
        'timestep',
    ];

    protected $casts = [
        'id' => 'integer',
        'sfd_id' => 'integer',
        'name' => 'string',
        'desc' => 'string',
        'timestep' => 'integer',
    ];

    public function sfd()
    {
        return $this->belongsTo(Sfd::class, 'sfd_id');
    }

    public function scenarioData()
    {
        return $this->hasMany(ScenarioData::class);
    }
}
