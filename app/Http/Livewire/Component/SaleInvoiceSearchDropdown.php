<?php

namespace App\Http\Livewire\Component;

use App\Models\Backend\Inventory\SaleInvoice;
use Livewire\Component;

class SaleInvoiceSearchDropdown extends Component
{
    public $search;
    public $invoiceId;
    public $selected = false;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->selected = true;
    }

    public function searchSelect($selected)
    {
        if ($this->invoiceId) {
            $selected = SaleInvoice::find($this->invoiceId);
        }
        $this->emit('search', $selected);
        $this->search = $selected['code'];
        $this->selected = false;
    }

    public function render()
    {
        // dd($SaleInvoice);
        return view('livewire.component.sale-invoice-search-dropdown',
        [
            'search_list' => SaleInvoice::where('code', 'like', '%'.$this->search.'%')->get(),
        ]
    );
    }
}
