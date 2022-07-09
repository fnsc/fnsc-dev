<?php

namespace Fnsc\Presenters\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Fnsc\Application\Home\Service;
use Fnsc\Presenters\Transformers\Home\Transformer;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View as ViewFactory;

class HomeController extends Controller
{
    public function __construct(
        private readonly Service $service,
        private readonly Transformer $transformer
    ) {
    }

    /**
     * @return ViewContract
     */
    public function index(): ViewContract
    {
        $result = $this->service->handle();
        $transformedOutput = $this->transformer->transform($result);

        return ViewFactory::make('home.index')
            ->with($transformedOutput);
    }
}
