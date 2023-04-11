<?php

namespace App\Http\Livewire\Backend\Setting;

use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Setting\Vat as VatInfo;
use Livewire\Component;

class Vat extends Component
{

    public $code;
    public $name;
    public $rate_percent;
    public $rate_fixed;
    public $is_active = 1;
    public $vat_id;
    public $QueryUpdate;


    public function VatInfoSave()
    {

        $this->validate([
            'code'=> 'required',
            'name'=> 'required',
            'rate_percent'=> 'required',
            'rate_fixed'=> 'required',
            'is_active'=> 'required',
        ]);

        if ($this->vat_id) {
            $Query  = VatInfo::find($this->vat_id);
        } else {
            $Query = new VatInfo();
            $Query->created_by = Auth::user()->id;
        }

        $Query->code = $this->code;
        $Query->name = $this->name;
        $Query->rate_percent = $this->rate_percent;
        $Query->rate_fixed = $this->rate_fixed;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->is_active = $this->is_active;
        $Query->save();
        $this->reset();
        $this->VatModal();
        $this->emit('success', [
            'text' => 'Vat C/U Successfully',
        ]);
    }


    public function vatEdit($id)
    {
        $this->QueryUpdate = VatInfo::find($id);
        $this->vat_id = $this->QueryUpdate->id;
        $this->code = $this->QueryUpdate->code;
        $this->name = $this->QueryUpdate->name;
        $this->rate_percent = $this->QueryUpdate->rate_percent;
        $this->rate_fixed = $this->QueryUpdate->rate_fixed;
        $this->is_active = $this->QueryUpdate->is_active;
        $this->emit('modal', 'VatModal');
    }

    public function vatDelete($id)
    {
        VatInfo::find($id)->delete();
        $this->emit('success', [
            'text' => 'Vat Deleted Successfully',
        ]);
    }


    public function VatModal()
    {
        $this->reset();
        $this->code = 'V' . floor(time() - 999999);
        $this->emit('modal', 'VatModal');
    }
    public function render()
    {
        return view('livewire.backend.setting.vat');
    }
}
