<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;

    public function District()
    {
        return $this->belongsTo('App\Districts', 'district_id', 'id');
    }
}
