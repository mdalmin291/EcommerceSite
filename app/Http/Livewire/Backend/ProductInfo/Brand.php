<?php

namespace App\Http\Livewire\Backend\ProductInfo;

use App\Models\Backend\ProductInfo\Brand as BrandInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Brand extends Component
{
    use WithFileUploads;

    public $code;
    public $name;
    public $image;
    public $description;
    public $is_active = 1;
    public $brand_id;
    public $QueryUpdate;

    public function brandInfoSave()
    {
        $this->validate([
           'name' => 'required',
        //    'image'  => 'required',
            // 'description' => 'required',
            'is_active' => 'required',
        ]);

        if ($this->brand_id) {
            $Query = BrandInfo::find($this->brand_id);
        } else {
            $Query = new BrandInfo();
            $Query->created_by = Auth::user()->id;
        }
        $Query->code = $this->code;
        $Query->name = $this->name;
        if ($this->image) {
            $path = $this->image->store('/public/photo');
            $Query->image = basename($path);
        }
        $Query->description = $this->description;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->is_active = $this->is_active;
        $Query->save();
        $this->reset();
        $this->BrandAInfoModal();
        $this->emit('success', [
          'text' => 'brand saved successfully',
       ]);
    }

    public function brandEdit($id)
    {
        $this->QueryUpdate = BrandInfo::find($id);
        $this->brand_id = $this->QueryUpdate->id;
        $this->code = $this->QueryUpdate->code;
        $this->name = $this->QueryUpdate->name;
        $this->description = $this->QueryUpdate->description;
        $this->is_active = $this->QueryUpdate->is_active;
        // $this->BrandAInfoModal();
        $this->emit('modal', 'BrandAInfoModal');
    }

    public function brandDelete($id)
    {
        BrandInfo::find($id)->delete();
        $this->emit('success', [
           'text' => 'Brand deleted successfully',
        ]);
    }

    public function BrandAInfoModal()
    {
        $this->reset();
        $this->code = 'C'.floor(time() - 999999);
        $this->emit('modal', 'BrandAInfoModal');
    }

    public function render()
    {
        return view('livewire.backend.product-info.brand');
    }
}
