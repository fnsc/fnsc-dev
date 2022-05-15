<?php

namespace Fnsc\Presenters\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(): ViewContract
    {
        return View::make('home.index')
            ->with([
                'themeColor' => '#0D1117',
                'description' => 'I am a backend developer with almost 5 years of experience, working with laravel and PHP.',
                'author' => 'Gabriel Fonseca',
                'keywords' => 'developer, backend, php, laravel',
            ]);
    }
}
