<?php

namespace App\Models\Backend\Inventory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\StockManager;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function StockManager(){
        return $this->hasMany(StockManager::class);
    }

    public function ContactName(){
        return $this->hasOne(Contact::class);
    }


}
