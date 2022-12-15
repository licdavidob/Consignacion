<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsersIndex extends Component
{

    use WithPagination;
    public $search;

    // Lo que inicie con updating mas propiedad se va a activar cuando se modifique la propiedad
    // Va a resetear la info de la pag
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name','LIKE','%'.$this->search.'%')
        ->orWhere('email','LIKE','%'.$this->search.'%')
        ->paginate(5);
        return view('livewire.admin.users-index', compact('users'));
    }
}
