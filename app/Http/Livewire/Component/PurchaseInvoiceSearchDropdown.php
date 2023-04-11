<?php

namespace App\Http\Livewire\Component;

use App\Models\Backend\Inventory\PurchaseInvoice;
use Livewire\Component;

class PurchaseInvoiceSearchDropdown extends Component
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
            $selected = PurchaseInvoice::find($this->invoiceId);
        }
        $this->emit('search', $selected);
        $this->search = $selected['code'];
        $this->selected = false;
    }

    public function render()
    {
        // dd($PurchaseInvoice);
        return view('livewire.component.purchase-invoice-search-dropdown',
        [
            'search_list' => PurchaseInvoice::where('code', 'like', '%'.$this->search.'%')->get(),
        ]
    );
    }
}
