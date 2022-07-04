<?php

namespace Fnsc\Presenters\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Fnsc\Application\Home\OutputBoundary;
use Fnsc\Application\Home\Service;
use Fnsc\Presenters\Transformers\SocialMedia as SocialMediaTransformer;
use Fnsc\Presenters\Transformers\User as UserTransformer;
use Illuminate\Config\Repository as Config;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View as ViewFactory;

class HomeController extends Controller
{
    public function __construct(
        private readonly Config $config,
        private readonly Service $service,
        private readonly SocialMediaTransformer $socialMediaTransformer,
        private readonly UserTransformer $userTransformer
    ) {
    }

    /**
     * @return ViewContract
     */
    public function index(): ViewContract
    {
        $result = $this->service->handle();

        $user = $this->userTransformer->transform($result->getUser());
        $socialMedia = $this->getSocialMedia($result);
        $baseVars = $this->getViewVars();

        return ViewFactory::make('home.index')
            ->with(array_merge($baseVars, compact('user', 'socialMedia')));
    }

    /**
     * @return array<string, string>
     */
    private function getViewVars(): array
    {
        return [
            'location' => 'Home',
            'title' => $this->config->get('view.variables.home.title'),
            'themeColor' => $this->config->get('view.variables.home.themeColor'),
            'description' => $this->config->get('view.variables.home.description'),
            'author' => $this->config->get('view.variables.home.author'),
            'keywords' => $this->config->get('view.variables.home.keywords'),
        ];
    }

    /**
     * @param OutputBoundary $result
     * @return array<int, array<string, string>>
     */
    private function getSocialMedia(OutputBoundary $result): array
    {
        $socialMedia = [];

        foreach ($result->getSocialMedia() as $socialNetwork) {
            $socialMedia[] = $this->socialMediaTransformer->transform($socialNetwork);
        }

        return $socialMedia;
    }
}
