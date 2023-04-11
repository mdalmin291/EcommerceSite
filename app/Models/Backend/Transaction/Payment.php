<?php

namespace App\Models\Backend\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function PaymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
    public function Branch(){
        return $this->belongsTo(Branch::class);
    }
}
