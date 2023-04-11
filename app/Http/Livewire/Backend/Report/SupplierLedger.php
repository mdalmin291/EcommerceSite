<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Models\Backend\Inventory\Invoice;

class SupplierLedger extends Component
{
    public function render()
    {
        return view('livewire.backend.report.supplier-ledger', [
            'Suppliers' => Invoice::get(),
        ]);
    }
}
