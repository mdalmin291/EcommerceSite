<?php

namespace App\Http\Livewire\Backend\AccountsSetting;
use App\Models\Backend\AccountsSetting\ChartOfGroup as ChartOfGroupModal;
use Livewire\Component;

class ChartOfGroup extends Component
{
    public $code;
    public $name;
    public $chart_of_group_id;
    public $QueryUpdate;
    public $is_active = 1;

    public function ChartOfGroupSave()
    {
        $this->validate([
            'code'=> 'required',
            'name'=> 'required',
        ]);


        if ($this->chart_of_group_id) {
            $Query = ChartOfGroupModal::find($this->chart_of_group_id);
        } else {
            $Query = new ChartOfGroupModal();
        }

        $Query->code = $this->code;
        $Query->name = $this->name;
        $Query->is_active = $this->is_active;
        $Query->save();
        $this->reset();
        $this->ChartOfGroupModal();
        $this->emit('success', [
            'text' => 'Payment Method Saved Successfully',
        ]);
    }

    public function chartOfGroupEdit($id)
    {
        $this->QueryUpdate = ChartOfGroupModal::find($id);
        $this->chart_of_group_id = $this->QueryUpdate->id;
        $this->code = $this->QueryUpdate->code;
        $this->name = $this->QueryUpdate->name;
        $this->is_active = $this->QueryUpdate->is_active;
        $this->emit('modal', 'ChartOfGroupModal');
    }

    public function chartOfGroupDelete($id)
    {
        ChartOfGroupModal::find($id)->delete();
        $this->emit('success', [
            'text' => 'Payment Method Deleted Successfully',
        ]);
    }

    public function ChartOfGroupModal()
    {
        $this->reset();
        $this->code = 'P' . floor(time() - 99999);
        $this->emit('modal', 'ChartOfGroupModal');
    }




    public function render()
    {
        return view('livewire.backend.accounts-setting.chart-of-group');
    }
}
