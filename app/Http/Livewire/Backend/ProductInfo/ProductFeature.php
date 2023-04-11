<?php

namespace App\Http\Livewire\Backend\ProductInfo;
use App\Models\Backend\ProductInfo\ProductFeature as ProductFeatureInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductFeature extends Component
{
    public $code;
    public $name;
    public $position;
    public $branch_id;
    public $QueryUpdate;
    public $is_active = 1;
    public $featureProduct_id;

    public function FeautureProductSave()
    {
        $this->validate([
            'code' => 'required',
            'name' => 'required',
            'position' => 'required',
            'is_active' => 'required',
        ]);

        if ($this->featureProduct_id) {
            $Query = ProductFeatureInfo::find($this->featureProduct_id);
        } else {
            $Query = new ProductFeatureInfo();
        }
        $Query->code = $this->code;
        $Query->name = $this->name;
        $Query->position = $this->position;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->is_active = $this->is_active;
        $Query->save();
        $this->reset();
        $this->featureProductInfoModal();
        $this->emit('success', [
            'text' => 'Unit C/U Successfully',
        ]);
    }



    public function FeatureProductEdit($id)
    {
        $this->QueryUpdate = ProductFeatureInfo::find($id);
        $this->featureProduct_id = $this->QueryUpdate->id;
        $this->code = $this->QueryUpdate->code;
        $this->name = $this->QueryUpdate->name;
        $this->position = $this->QueryUpdate->position;
        $this->is_active = $this->QueryUpdate->is_active;

        $this->emit('modal', 'featureProductInfoModal');
    }

    public function FeatureProductDelete($id)
    {
        ProductFeatureInfo::find($id)->delete();

        $this->emit('success', [
            'text' => 'Feature Product Deleted Successfully',
        ]);
    }


    public function featureProductInfoModal()
    {
        $this->reset();
        $this->code = 'FP'.floor(time() - 999999999);
        $this->emit('modal', 'featureProductInfoModal');
    }

    public function render()
    {
        return view('livewire.backend.product-info.product-feature');
    }
}
