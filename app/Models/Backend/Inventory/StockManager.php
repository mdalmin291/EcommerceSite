<?php

namespace App\Models\Backend\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockManager extends Model
{
    use HasFactory;
    use SoftDeletes;
}
