<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Models\Backend\Inventory\Invoice;

class SalesReturnReport extends Component
{
    public function render()
    {
        return view('livewire.backend.report.sales-return-report', [
            'Customers' => invoice::get(),
        ]);
    }
}
