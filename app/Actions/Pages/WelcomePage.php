<?php

namespace App\Actions\Pages;

use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsController;

class WelcomePage
{
    use AsController;

    public function handle(): Response
    {
        return Inertia::render('Welcome');
    }
}
