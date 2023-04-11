<?php

namespace App\Http\Livewire\Backend\Setting;
use App\Models\Inventory\Currency as CurrencyInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Currency extends Component
{
    public $code;
    public $title;
    public $symbol;
    public $symbol_position;
    public $in_word_prefix;
    public $in_word_surfix;
    public $in_word_prefix_position;
    public $in_word_surfix_position;
    public $is_active=1;
    public $CurrencyId=NULL;

    public function currencyEdit($id)
    {
        $Query = CurrencyInfo::find($id);
        $this->CurrencyId = $Query->id;
        $this->code = $Query->code;
        $this->title = $Query->title;
        $this->symbol = $Query->symbol;
        $this->symbol_position = $Query->symbol_position;
        $this->in_word_prefix = $Query->in_word_prefix;
        $this->in_word_surfix = $Query->in_word_suffix;
        $this->in_word_prefix_position = $Query->in_word_prefix_position;
        $this->in_word_surfix_position = $Query->in_word_suffix_position;
        $this->is_active = $Query->is_active;
		$this->emit('modal', 'currencyInfoModal');
    }
    public function currencyDelete($id)
    {
        CurrencyInfo::find($id)->delete();

        $this->emit('success', [
            'text' => 'Currency Deleted Successfully',
        ]);
    }
    public function currencySave()
    {
        $this->validate([
            'code' => 'required',
            'title' => 'required',
            'symbol' => 'required',
            'symbol_position' => 'required',
            'is_active' => 'required',
        ]);

        if ($this->CurrencyId) {
            $Query = CurrencyInfo::find($this->CurrencyId);
        } else {
            $Query = new CurrencyInfo();
            $Query->created_by = Auth::id();
        }
        $Query->code = $this->code;
        $Query->title = $this->title;
        $Query->symbol = $this->symbol;
        $Query->symbol_position = $this->symbol_position;
        $Query->in_word_prefix = $this->in_word_prefix;
        $Query->in_word_suffix = $this->in_word_surfix;
        $Query->in_word_prefix_position = $this->in_word_prefix_position;
        $Query->in_word_suffix_position = $this->in_word_surfix_position;
        $Query->is_active = $this->is_active;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->save();

        $this->currencyInfoModal();
        $this->reset();
        $this->emit('success', [
            'text' => 'Currency C/U Successfully',
        ]);
    }
    public function currencyInfoModal(){
        $this->reset();
        $this->code = 'C'.floor(time() - 999999999);
        $this->emit('modal','currencyInfoModal');
    }
    public function render()
    {
        return view('livewire.backend.setting.currency');
    }
}
