<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Form extends Component
{
    public $userId = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
        ];

        if ($this->userId) {
            // Updating existing user - password is optional
            if (!empty($this->password)) {
                $rules['password'] = 'required|string|min:8|same:passwordConfirmation';
            }
        } else {
            // Creating new user - password is required
            $rules['password'] = 'required|string|min:8|same:passwordConfirmation';
        }

        return $rules;
    }

    public function mount($id = null)
    {
        if ($id) {
            $user = User::findOrFail($id);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        // Only update password if provided
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update($data);
            session()->flash('message', 'User updated successfully.');
        } else {
            User::create($data);
            session()->flash('message', 'User created successfully.');
        }

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.users.form');
    }
}
