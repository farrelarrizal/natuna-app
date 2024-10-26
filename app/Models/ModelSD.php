<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelSD extends Model
{
    use HasFactory;
    protected $table = 'models';
    protected $fillable = ['name', 'desc', 'pathfile', 'is_active', 'image'];

    public function variables()
    {
        return $this->hasMany(Variable::class);
    }
}
