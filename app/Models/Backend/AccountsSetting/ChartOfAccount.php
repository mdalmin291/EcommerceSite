<?php

namespace App\Models\Backend\AccountsSetting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\AccountsSetting\ChartOfGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChartOfAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function ChartOfGroup()
    {
        return $this->belongsTo(ChartOfGroup::class);
    }
    public function TransactionTotal($from_date,$to_date)
    {
        return $this->hasMany(Transaction::class)->whereDate('date','>=',$from_date)->whereDate('date','<=',$to_date)->sum('amount');
    }
}
