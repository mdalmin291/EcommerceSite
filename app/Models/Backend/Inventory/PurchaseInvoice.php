<?php

namespace App\Models\Backend\Inventory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\purchaseInvoiceDetail;
use App\Models\Backend\Inventory\PurchasePayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function ContactName(){
        return $this->hasOne(Contact::class);
    }

    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function PurchaseInvoiceDetail(){
        return $this->hasMany(purchaseInvoiceDetail::class);
    }
    public function PurchasePayment(){
        return $this->hasMany(PurchasePayment::class);
    }
}
