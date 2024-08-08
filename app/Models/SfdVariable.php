<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SfdVariable extends Model
{
    use HasFactory;
    protected $table = 'sfd_variable';
    protected $fillable = ['sfd_id', 'variable_id'];
    
    public function variable()
    {
        return $this->belongsTo(Variable::class, 'variable_id');
    }

    public function sfd()
    {
        return $this->belongsTo(Variable::class, 'sfd_id');
    }
}
