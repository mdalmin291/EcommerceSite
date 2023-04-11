<?php

namespace App\Http\Livewire\Backend\Setting;
use App\Models\Backend\Setting\Branch as BranchInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Branch extends Component
{
    public $code;
    public $name;
    public $mobile;
    public $address;
    public $is_active=1;
    public $BranchId;
    public $QueryUpdate;

    public function branchEdit($id)
    {
        $Query = BranchInfo::find($id);
        $this->BranchId = $Query->id;
        $this->code = $Query->code;
        $this->name = $Query->name;
        $this->mobile = $Query->mobile;
        $this->address = $Query->address;
        $this->is_active = $Query->is_active;
		$this->emit('modal', 'branchInfoModal');
    }
    public function branchDelete($id)
    {
        BranchInfo::find($id)->delete();

        $this->emit('success', [
            'text' => 'Branch Deleted Successfully',
        ]);
    }
    public function branchSave()
    {
        $this->validate([
            'code' => 'required',
            'name' => 'required',
            'is_active' => 'required',
        ]);
        if ($this->BranchId) {
            $Query = BranchInfo::find($this->BranchId);
        } else {
            $Query = new BranchInfo();
            $Query->created_by = Auth::id();
        }
        $Query->code = $this->code;
        $Query->name = $this->name;
        $Query->mobile = $this->mobile;
        $Query->address = $this->address;
        $Query->is_active = $this->is_active;
        $Query->save();
        $this->reset();
        $this->branchInfoModal();
        $this->emit('success', [
            'text' => 'Branch C/U Successfully',
        ]);
    }

    public function branchInfoModal(){
        $this->reset();
        $this->code = 'B'.floor(time() - 999999999);
        $this->emit('modal','branchInfoModal');
    }
    public function render()
    {
        return view('livewire.backend.setting.branch');
    }
}
