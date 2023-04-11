<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Models\Backend\Inventory\Invoice;

class ProfitLoss extends Component
{
    public function render()
    {
        return view('livewire.backend.report.profit-loss', [
            'Customers' => invoice::get(),
        ]);
    }
}
