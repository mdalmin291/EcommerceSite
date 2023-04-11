<?php

namespace App\Http\Livewire\Backend\AccountsSetting;
use App\Models\Backend\AccountsSetting\ChartOfAccount as ChartOfAccountModal;
use App\Models\Backend\AccountsSetting\ChartOfGroup;
use Livewire\Component;

class ChartOfAccount extends Component
{

    public $code;
    public $name;
    public $chart_of_account_id;
    public $balance_type;
    public $opening_balance;
    public $chart_of_group_id;
    public $QueryUpdate;
    public $is_active = 1;

    public function ChartOfAccountSave()
    {
        $this->validate([
            'code'=> 'required',
            'name'=> 'required',
        ]);


        if ($this->chart_of_account_id) {
            $Query = ChartOfAccountModal::find($this->chart_of_account_id);
        } else {
            $Query = new ChartOfAccountModal();
        }
        $Query->code = $this->code;
        $Query->name = $this->name;
        $Query->chart_of_group_id = $this->chart_of_group_id;
        $Query->balance_type = $this->balance_type;
        $Query->opening_balance = $this->opening_balance;
        $Query->is_active = $this->is_active;
        $Query->save();
        $this->reset();
        $this->ChartOfAccountModal();
        $this->emit('success', [
            'text' => 'Payment Method Saved Successfully',
        ]);
    }

    public function chartOfAccountEdit($id)
    {
        $this->QueryUpdate = ChartOfAccountModal::find($id);
        $this->chart_of_account_id = $this->QueryUpdate->id;
        $this->code = $this->QueryUpdate->code;
        $this->name = $this->QueryUpdate->name;
        $this->chart_of_group_id = $this->QueryUpdate->chart_of_group_id;
        $this->opening_balance = $this->QueryUpdate->opening_balance;
        $this->is_active = $this->QueryUpdate->is_active;
        $this->emit('modal', 'ChartOfAccountModal');
    }

    public function chartOfAccountDelete($id)
    {
        ChartOfAccountModal::find($id)->delete();
        $this->emit('success', [
            'text' => 'Payment Method Deleted Successfully',
        ]);
    }

    public function ChartOfAccountModal()
    {
        $this->reset();
        $this->code = 'P' . floor(time() - 99999);
        $this->emit('modal', 'ChartOfAccountModal');
    }

    public function render()
    {
        return view('livewire.backend.accounts-setting.chart-of-account',[
            'chartofgroup' => ChartOfGroup::get(),
        ]);
    }
}
