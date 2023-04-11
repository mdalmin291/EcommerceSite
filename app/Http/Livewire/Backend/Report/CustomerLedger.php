<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Models\Backend\Inventory\Invoice;

class CustomerLedger extends Component
{
    public function render()
    {
        return view('livewire.backend.report.customer-ledger', [
            'Customers' => Invoice::get(),
        ]);
    }
}
