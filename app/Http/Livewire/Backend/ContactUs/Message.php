<?php

namespace App\Http\Livewire\Backend\ContactUs;
use App\Models\Backend\ContactUs\Message as CustomerMessage;
use Livewire\Component;

class Message extends Component
{
    public function deleteMessage($id){
        CustomerMessage::find($id)->delete();
        $this->emit('success', [
            'text' => 'Product Deleted Successfully',
        ]);
    }


    public function render()
    {
        // dd(CustomerMessage::get());
        return view('livewire.backend.contact-us.message',[
            'CustomerMessages'=>CustomerMessage::get()
        ]);
    }
}
