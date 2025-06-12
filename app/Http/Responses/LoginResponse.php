<?php

namespace App\Http\Responses;

use App\Filament\Resources\OrderResource;
use Filament\Pages\Dashboard;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Here, you can define which resource and which page you want to redirect to
        return redirect()->to(Dashboard::getUrl())
            ->with('success', 'Selamat datang di dashboard!'); // Optional: Add a success message
    }
}
