<?php

namespace App\Actions\Pages;

use Illuminate\View\View;
use Lorisleiva\Actions\Concerns\AsController;

class WelcomePage
{
    use AsController;

    public function handle(): View
    {
        return view('welcome');
    }
}
