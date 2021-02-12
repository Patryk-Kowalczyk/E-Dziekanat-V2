<?php

namespace App\MyApp\Message\Services;

use App\MyApp\Message\Repositories\MessageRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class MessageService
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

    public function getMessages(): JsonResponse
    {
        try {
            $allMessagesTransform = new Collection($this->messageRepository->getAll(), $this->tranformsUtil->getTransformer(7));
            $allMessagesTransformResponse = $this->fractal->createData($allMessagesTransform);
            return Response::build($allMessagesTransformResponse, 200, __('msg/success.list'));
        } catch (\Exception $e) {
            Log::error("There was problem with MessageService.getMessages(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

    public function getMessageDetails($data): JsonResponse
    {
        try {
            $messageDetailsTransform = new Item($this->messageRepository->showMessage($data['id']), $this->tranformsUtil->getTransformer(8));
            $messageDetailsTransformResponse=$this->fractal->createData($messageDetailsTransform);
            return Response::build($messageDetailsTransformResponse, 200,__('msg/success.show'));
        } catch (\Exception $e) {
            Log::error("There was problem with MessageService.getMessageDetails(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.show'));
        }
    }


}
