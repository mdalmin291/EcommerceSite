<?php

namespace App\Http\Livewire\UserProfile;
use App\Actions\Fortify\UpdateUserPassword;
use Livewire\Component;

class ChangePassword extends Component
{
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];
    public function changePassword(UpdateUserPassword $updater)
    {
        $this->resetErrorBag();

        $updater->update(auth()->user(), $this->state);

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        // session()->flash('status', 'Password successfully changed');
        $this->emit('success', ['text' => 'Password successfully changed']);
    }
    public function render()
    {
        return view('livewire.user-profile.change-password');
    }
}
