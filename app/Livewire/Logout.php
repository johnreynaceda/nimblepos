<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public $modal = false;

    public function confirmLogout(){
        sleep(1);
        Auth::logout();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.logout');
    }
}
