<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\District;
use App\Models\FrontEnd\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Contact(){
      return $this->belongsTo(Contact::class);
    }
    public function District(){
        return $this->belongsTo(District::class);
      }
    public function OrderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
}
