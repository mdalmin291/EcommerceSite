<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserList extends Component
{
    public $name;
    public $mobile;
    public $password;
    public $type;
    public $user_id = null;

    public function UserSave()
    {
        // validation
        $this->validate([
            'name' => 'required',
            'mobile' => 'required',
            'type' => 'required',
            'password' => 'required'
        ]);
        if ($this->user_id) {
            $Query = User::find($this->user_id);
        } else {
            $Query = new User();
            $Query->current_team_id = Auth::id();
        }
        $Query->name = $this->name;
        $Query->mobile = $this->mobile;
        $Query->password = Hash::make($this->password);
        $Query->type = $this->type;
        $Query->save();
        $Query->assignRole($this->type);

        $this->UserModal();

        $this->emit('success', [
            'text' => 'User C/U Successfully',
        ]);
    }

    public function UserEdit($id)
    {
        $Query = User::find($id);
        $this->user_id = $Query->id;
        $this->name = $Query->name;
        // $this->email = $Query->email;
        $this->mobile   = $Query->mobile;
        if (!empty($this->password)) {
            $this->password = Hash::make($Query->password);
        }
        $this->type = $Query->type;
        // $this->password = $Query->password;
        // $this->password = Hash::make('$Query->password');
        $this->emit('modal', 'UserModal');
    }

    public function UserDelete($id)
    {
        User::find($id)->delete();

        $this->emit('success', [
            'text' => 'User Delete Successfully',
        ]);
    }

    public function UserModal()
    {
        $this->reset();
        $this->emit('modal', 'UserModal');
    }

    public function UserPermission()
    {
        $this->reset();
        $this->emit('modal', 'UserPermission');
    }

    public function render()
    {
        return view('livewire.user-management.user-list');
    }
}
