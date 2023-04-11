<?php

namespace App\Models\Backend\Inventory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function ContactName(){
        return $this->hasOne(Contact::class);
    }

    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function SaleInvoiceDetail(){
        return $this->hasMany(SaleInvoiceDetail::class);
    }
    public function SalePayment(){
        return $this->hasMany(SalePayment::class);
    }
}
