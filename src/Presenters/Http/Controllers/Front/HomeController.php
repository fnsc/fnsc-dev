<?php

namespace Fnsc\Presenters\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Config\Repository as Config;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View as ViewFactory;

class HomeController extends Controller
{
    /**
     * @param Config $config
     */
    public function __construct(private readonly Config $config)
    {
    }

    /**
     * @return ViewContract
     */
    public function index(): ViewContract
    {
        return ViewFactory::make('home.index')
            ->with([
                'title' => $this->config->get('view.variables.home.title'),
                'themeColor' => $this->config->get('view.variables.home.themeColor'),
                'description' => $this->config->get('view.variables.home.description'),
                'author' => $this->config->get('view.variables.home.author'),
                'keywords' => $this->config->get('view.variables.home.keywords'),
            ]);
    }
}
