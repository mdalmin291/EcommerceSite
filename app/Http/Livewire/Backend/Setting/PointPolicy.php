<?php

namespace App\Http\Livewire\Backend\Setting;

use App\Models\Backend\Setting\PointPolicy as PointPolicyM;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PointPolicy extends Component
{
    public $name;
    public $amount;
    public $point_value;
    public $point_amount;
    public $description;
    public $is_active=1;
    public $PointPolicy;

    public function mount()
    {
        $this->PointPolicy = PointPolicyM::first();
        if ($this->PointPolicy) {
            $this->name = $this->PointPolicy->name;
            $this->amount = $this->PointPolicy->amount;
            $this->point_value = $this->PointPolicy->point_value;
            $this->point_amount = $this->PointPolicy->point_amount;
            $this->description = $this->PointPolicy->description;
            $this->is_active = $this->PointPolicy->is_active;
        }
    }

    public function ProfileSave()
    {
        // dd(true);
        $this->validate([
            'name' => 'required',
            'amount' => 'required',
            'point_value' => 'required',
            'point_amount' => 'required',
            'is_active' => 'required',
        ]);
        $this->PointPolicy = PointPolicyM::first();
        if ($this->PointPolicy) {
            $Query = $this->PointPolicy;
        } else {
            $Query = new PointPolicyM();
            $Query->created_by = Auth::user()->id;
        }
        $Query->name = $this->name;
        $Query->amount = $this->amount;
        $Query->point_value = $this->point_value;
        $Query->point_amount = $this->point_amount;
        $Query->description = $this->description;
        $Query->is_active = $this->is_active;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->save();
        $this->emit('success', ['text' => 'Point Policy Updated Successfully']);
    }

    public function render()
    {
        return view('livewire.backend.setting.point-policy');
    }
}


