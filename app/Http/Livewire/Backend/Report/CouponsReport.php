<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Models\Backend\Inventory\Invoice;

class CouponsReport extends Component
{
    public function render()
    {
        return view('livewire.backend.report.coupons-report', [
            'orders' => Invoice::get(),
        ]);
    }
}
