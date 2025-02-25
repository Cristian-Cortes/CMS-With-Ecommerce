<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coverage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'coverage';
    protected $hidden = ['created_at', 'updated_at'];

    public function getState()
    {
        return $this->hasOne(Coverage::class, 'id', 'state_id');
    }
}
