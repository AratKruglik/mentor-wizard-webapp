<?php

namespace App\Actions\Pages;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsController;

class DashboardPage
{
    use AsController;

    public function handle(): Response
    {
        return Inertia::render('Dashboard');
    }
}
