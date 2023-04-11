<?php

namespace App\Http\Livewire\Component;

use App\Models\Backend\ProductInfo\Product;
use Livewire\Component;

class ProductSearchDropdown extends Component
{
    public $search;

    protected $queryString = ['search'];

    public function searchSelect($selected)
    {
        $this->emit('product_search', $selected);
        $this->reset('search');
    }

    public function render()
    {

        $Product = Product::where('name', 'like', '%'.$this->search.'%');
        $Product = $Product->get();

        return view('livewire.component.product-search-dropdown',
        [
            'search_list' => $Product,
        ]
    );
    }
}
