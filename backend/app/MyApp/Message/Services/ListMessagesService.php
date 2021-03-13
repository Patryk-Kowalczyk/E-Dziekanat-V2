<?php

declare(strict_types=1);

namespace App\MyApp\Message\Services;

use App\MyApp\Message\Repositories\MessageRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class ListMessagesService
{
    protected $fractal;
    protected $tranformsUtil;
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository,
                                Manager $fractal,
                                TranformsUtil $tranformsUtil)
    {
        $this->messageRepository = $messageRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function execute(): JsonResponse
    {
        try {
            $allMessagesTransform = new Collection($this->messageRepository->getAll(), $this->tranformsUtil->getTransformer(7));
            $allMessagesTransformResponse = $this->fractal->createData($allMessagesTransform);
            return Response::build($allMessagesTransformResponse, 200, 'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with ListMessagesService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }
}
