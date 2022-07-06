<?php

namespace Fnsc\Presenters\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Fnsc\Application\Home\OutputBoundary;
use Fnsc\Application\Home\Service;
use Fnsc\Presenters\Transformers\SocialMedia as SocialMediaTransformer;
use Fnsc\Presenters\Transformers\User as UserTransformer;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View as ViewFactory;

class HomeController extends Controller
{
    public function __construct(
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

        return ViewFactory::make('home.index')
            ->with(array_merge($result->getBaseViewVars(), compact('user', 'socialMedia')));
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
