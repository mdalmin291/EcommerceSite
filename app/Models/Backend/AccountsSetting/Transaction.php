<?php

namespace App\Models\Backend\AccountsSetting;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\AccountsSetting\ChartOfAccount;
use App\Models\Backend\Setting\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
    public function ChartOfAccount(){
        return $this->belongsTo(ChartOfAccount::class);
    }

    public function Branch(){
        return $this->belongsTo(Branch::class);
    }

    public function PaymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
}
