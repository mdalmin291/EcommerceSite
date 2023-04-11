<?php

namespace App\Http\Livewire\Backend\ProductInfo;

use App\Models\Backend\ProductInfo\Unit as UnitInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Unit extends Component
{
    public $code;
    public $name;
    public $rate;
    public $QueryUpdate;
    public $is_active = 1;
    public $UnitId;

    public function unitEdit($id)
    {
        $this->QueryUpdate = UnitInfo::find($id);
        $this->UnitId = $this->QueryUpdate->id;
        $this->code = $this->QueryUpdate->code;
        $this->name = $this->QueryUpdate->name;
        $this->rate = $this->QueryUpdate->rate;
        $this->is_active = $this->QueryUpdate->is_active;

        $this->emit('modal', 'productUnitInfoModal');
    }

    public function unitDelete($id)
    {
        UnitInfo::find($id)->delete();

        $this->emit('success', [
            'text' => 'Unit Deleted Successfully',
        ]);
    }

    public function saveUnit()
    {
        $this->validate([
            'code' => 'required',
            'name' => 'required',
            'rate' => 'required',
            'is_active' => 'required',
        ]);

        if ($this->UnitId) {
            $Query = UnitInfo::find($this->UnitId);
        } else {
            $Query = new UnitInfo();
            $Query->created_by = Auth::user()->id;
        }
        $Query->code = $this->code;
        $Query->name = $this->name;
        $Query->rate = $this->rate;
        $Query->is_active = $this->is_active;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->save();
        $this->reset();
        $this->productUnitInfoModal();
        $this->emit('success', [
            'text' => 'Unit C/U Successfully',
        ]);
    }

    public function productUnitInfoModal()
    {
        $this->reset();
        $this->code = 'C'.floor(time() - 999999999);
        $this->emit('modal', 'productUnitInfoModal');
    }

    public function render()
    {
        return view('livewire.backend.product-info.unit');
    }
}
