<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Models\Backend\Inventory\Invoice;

class PurchaseReturnReport extends Component
{
    public function render()
    {
        return view('livewire.backend.report.purchase-return-report', [
            'Suppliers' => Invoice::get(),
        ]);
    }
}
