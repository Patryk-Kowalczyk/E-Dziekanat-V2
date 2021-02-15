<?php

declare(strict_types=1);

namespace App\MyApp\Message\Services;

use App\MyApp\Message\Repositories\MessageRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class ShowMessageService
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

    public function execute($data): JsonResponse
    {
        try {
            $messageDetailsTransform = new Item($this->messageRepository->showMessage($data['id']), $this->tranformsUtil->getTransformer(8));
            $messageDetailsTransformResponse = $this->fractal->createData($messageDetailsTransform);
            return Response::build($messageDetailsTransformResponse, 200, 'msg/success.show');
        } catch (\Exception $e) {
            Log::error("There was problem with ShowMessageService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.show');
        }
    }
}
