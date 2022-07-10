<?php

namespace Fnsc\Presenters\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Exception;
use Fnsc\Application\Home\Service;
use Fnsc\Domain\Exceptions\User as UserException;
use Fnsc\Presenters\Transformers\Home\Transformer;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View as ViewFactory;
use Psr\Log\LoggerInterface;

class HomeController extends Controller
{
    public function __construct(
        private readonly Service $service,
        private readonly Transformer $transformer,
        private readonly LoggerInterface $logger
    ) {
    }

    /**
     * @return ViewContract
     */
    public function index(): ViewContract
    {
        try {
            $result = $this->service->handle();
            $transformedOutput = $this->transformer->transform($result);

            return ViewFactory::make('home.index')
                ->with($transformedOutput);
        } catch (UserException $exception) {
            $this->logger->error(
                '[Home][User] Something went wrong while get user data.',
                compact('exception')
            );

            return abort(Response::HTTP_FORBIDDEN, 'Try again later');
        } catch (Exception $exception) {
            $this->logger->error(
                '[Home] Something unexpected happened.',
                compact('exception')
            );

            return abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
