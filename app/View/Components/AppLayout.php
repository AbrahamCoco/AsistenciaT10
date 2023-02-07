<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('dashboard', ['user' => $user]);
    }
}
