<?php

namespace App\Models\Backend\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Inventory\Category;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\Setting\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockAdjustment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
    public function FromBranch(){
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }
    public function toBranch(){
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }
    public function FromWarehouse(){
        return $this->belongsTo(Warehouse::class, 'from_warehouse_id');
    }
    public function ToWarehouse(){
        return $this->belongsTo(Warehouse::class, 'to_warehouse_id');
    }
}
