<?php

namespace App\Models\Backend\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\Inventory\PurchaseInvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasePayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function Branch(){
        return $this->belongsTo(Branch::class);
    }
    public function PaymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function PurchaseInvoice(){
        return $this->belongsTo(PurchaseInvoice::class);
    }
}
