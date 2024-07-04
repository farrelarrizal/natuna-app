<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sfd extends Model
{
    use HasFactory;
    protected $fillable = ['model_id', 'name', 'desc'];

    public function modelSD()
    {
        return $this->belongsTo(ModelSD::class, 'model_id');
    }

    public function scenarios()
    {
        return $this->hasMany(Scenario::class);
    }
}
