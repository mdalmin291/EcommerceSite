<?php

namespace App\Http\Livewire\Backend\Setting;
use App\Models\Backend\Setting\Language as LanguageInfo;
use Livewire\Component;

class Language extends Component
{
    public $language;
    public $is_default;
    public $LanguageId;

    public function languageEdit($id){
        $QueryUpdate=LanguageInfo::find($id);
        $this->LanguageId=$QueryUpdate->id;
        $this->language=$QueryUpdate->language;
        $this->is_default=$QueryUpdate->is_default;
        $this->emit('modal','languageModal');
    }

    public function languageDelete($id){
        LanguageInfo::find($id)->delete();
        $this->emit('success', [
            'text' => 'Language Deleted Successfully',
        ]);
    }
    public function languageSave(){
        $this->validate([
            'language' => 'required',
        ]);
       if($this->LanguageId){
         $Query=LanguageInfo::find($this->LanguageId);
       }else{
         $Query=new LanguageInfo();
       }
       $Query->language=$this->language;
       if($this->is_default){
           $Query->is_default=1;
       }else{
           $Query->is_default=0;
       }
       $Query->save();
       $this->reset();

       $this->languageModal();
       $this->emit('success', [
        'text' => 'Language C/U Successfully',
    ]);
    }
    public function languageModal(){
        $this->reset();
        $this->emit('modal','languageModal');
    }
    public function render()
    {
        return view('livewire.backend.setting.language');
    }
}
